@extends('layout.app')
@section('main')

<h4 class="py-3 mb-2">Currencies</h4>

<nav class="navbar navbar-example navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="javascript:void(0)"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-3">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-ex-3">
            <div class="navbar-nav me-auto">
                <a class="nav-item nav-link active" href="javascript:void(0)">Currency Setup</a>
            </div>

            <form onsubmit="return false">
                <button class="btn btn-outline-success" onclick="showModal()" type="button">Add New</button>
            </form>
        </div>
    </div>
</nav>

<div class="card">
    <h5 class="card-header">Currency Table</h5>
    <div class="table-responsive text-nowrap">
        <table class="table" id="currencyDataTable">
            <thead class="table-light">
                <tr>
                    <th>SL</th>
                    <th>Currency Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="createCurrencyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="currency-title">Add New Currency</h3>
                    <p>Enter Currency Details</p>
                </div>
                <form id="createCurrencyForm" class="row g-3" onsubmit="return false">@csrf
                    <div class="col-12 mb-4">
                        <input type="hidden" id="id" name="id" class="form-control" />
                    </div>

                    <div class="col-12 mb-4">
                        <label class="form-label" for="currency_name">Currency Name</label>
                        <input type="text" id="currency_name" name="currency_name" class="form-control"
                            placeholder="Example: USD, EUR, BDT" />
                    </div>
                    <div class="col-12 mb-4">
                        <label class="form-label" for="status">Status</label>
                        <select id="status" name="status" class="form-select">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1" onclick="saveCurrency()">Submit</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    var table1 = $('#currencyDataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('all.currencies') !!}', // Ensure this route is defined in web.php
        columns: [
            { 
                data: null, 
                name: 'serial_number', 
                render: function (data, type, row, meta) {
                    return meta.row + 1; // Generates serial numbers (1-based index)
                },
                orderable: false, 
                searchable: false
            },
            { data: 'name', name: 'name' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    // Show Add Modal
    function showModal() {
        $('.currency-title').text('Add New Currency'); 
        $('#createCurrencyForm')[0].reset();  
        $('#id').val(''); 
        $('#createCurrencyModal').modal('show');
    }

    // Save or Update Currency
    function saveCurrency() {
        let url = "{{ url('currencies') }}"; 
        let formData = new FormData($("#createCurrencyForm")[0]);  

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.statusCode === 200) {
                    $('#createCurrencyModal').modal('hide');
                    if ($('#currencyDataTable').length) {
                        $('#currencyDataTable').DataTable().ajax.reload();
                    }
                    swal("Success", response.statusMsg, "success");
                    $('#createCurrencyForm')[0].reset();
                } else {
                    swal("Error", response.statusMsg || "An unknown error occurred.", "error");
                }
            },
            error: function (xhr) {
                let errorMessage = "Error occurred";

                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.responseText) {
                    errorMessage = xhr.responseText;
                }

                swal({
                    title: "Oops",
                    text: errorMessage,
                    icon: "error",
                    timer: 1500
                });
            }
        });

        return false;
    }

    // Fetch Data for Editing
    function showData(id) {
        $.ajax({
            url: `{{ url('currencies') }}/${id}`,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#createCurrencyForm')[0].reset();  
                $('.currency-title').text('Update Currency');
                $('#id').val(data.id);  
                $('#currency_name').val(data.name);  
                $('#status').val(data.status); 
                $('#createCurrencyModal').modal('show');
            },
            error: function (xhr) {
                let errorMessage = "Error occurred";
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.responseText) {
                    errorMessage = xhr.responseText;
                }
                swal({ title: "Oops", text: errorMessage, icon: "error", timer: 1500 });
            },
        });
    }

    // Delete Currency
    function deleteData(id) {
        let csrf_token = $('meta[name="csrf-token"]').attr('content');

        swal({
            title: "Are you sure?",
            text: "Once deleted, this cannot be recovered!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: `{{ url('currencies') }}/${id}`,
                    type: "POST",
                    data: { '_method': 'DELETE', '_token': csrf_token },
                    success: function (response) {
                        if (response.statusCode === 200) {
                            table1.ajax.reload(null, false);
                            swal("Deleted!", "The record has been deleted!", "success");
                        } else {
                            swal("Error", response.statusMsg || "Failed to delete the record.", "error");
                        }
                    },
                    error: function (xhr) {
                        let errorMessage = "Error occurred";
                        if (xhr.responseJSON && xhr.responseJSON.statusMsg) {
                            errorMessage = xhr.responseJSON.statusMsg;
                        } else if (xhr.responseText) {
                            errorMessage = xhr.responseText;
                        }
                        swal({ title: "Oops", text: errorMessage, icon: "error", timer: 1500 });
                    }
                });
            } else {
                swal("Your record is safe!");
            }
        });
    }
</script>
@endsection
