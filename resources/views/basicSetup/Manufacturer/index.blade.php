@extends('layout.app')
@section('main')

<h4 class="py-3 mb-2">Manufacturer</h4>

<nav class="navbar navbar-example navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="javascript:void(0)"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-3">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-ex-3">
            <div class="navbar-nav me-auto">
                <a class="nav-item nav-link active" href="javascript:void(0)">Manufacturer Setup</a>
            </div>

            <form onsubmit="return false">
                <button class="btn btn-outline-success" onclick="showModal()" type="button">Add New</button>
            </form>
        </div>
    </div>
</nav>

<div class="card">
    <h5 class="card-header">Manufacturer Table</h5>


    <div class="table-responsive text-nowrap">

        {{-- Button for filter column --}}
        <button id="filterColumnsBtn" class="btn btn-primary btn-sm m-4 mb-3">Filter Columns</button>
        <div id="columnToggleContainer" class="ml-3 mb-3 m-4" style="display: none;"></div>


        <table class="table" id="DataTable">
            <thead class="table-light">
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content p-2 p-md-3">
            <div class="modal-body">
                <div class="modal-header mb-4">
                    <h4 class="modal-title title">Add New Manufacturer</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createForm" class="row g-3" onsubmit="return false">@csrf
                    <div class="col-12 mb-4">
                        <input type="hidden" id="id" name="id" class="form-control" />
                    </div>
                    <div class="row">


                        <div class="col-12 mb-4">
                            <label class="form-label" for="manufacturer">Manufacturer</label>
                            <input type="text" id="manufacturer" name="manufacturer" class="form-control"
                                placeholder="Samsung,etc" />
                        </div>
                        <div class="col-12 mb-4">
                            <label class="form-label" for="country">Country</label>
                            <select id="country" name="country" class="form-select">
                                <option value="">Select Country</option>
                            </select>
                        </div>


                        <div class="col-12 mb-4">
                            <label class="form-label" for="status">Status</label>
                            <select id="status" name="status" class="form-select">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                    </div>


                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1" onclick="save()">Submit</button>
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
    var table1 = $('#DataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('all.manufacturers') !!}', 
        dom: 'Bfrtip',  // Enable buttons
        buttons: [
            {
                extend: 'colvis',
                text: 'Toggle Columns', 
                className: 'btn btn-primary'
            }
        ],
        columns: [
            { 
                data: 'id', 
                name: 'serial_number', 
                render: function (data, type, row, meta) {
                    return meta.row + 1;
                },
                orderable: false, 
                searchable: false
            },
            { data: 'name', name: 'name', title: 'Manufacturer' },
            { data: 'countries', name: 'countries', title: 'Countries' },
            { data: 'status', name: 'status', title: 'Status' },
            { data: 'action', name: 'action', orderable: false, searchable: false, title: 'Actions' }
        ]
    });

    function showModal() {
        $('.title').text('Add New Manufacturer '); 
        $('#createForm')[0].reset();  
        $('#id').val(''); 
        $('#createModal').modal('show');
    }

    $(document).ready(function() {
    $.ajax({
        url: "{{ url('/getcountrydata') }}", 
        type: 'GET',
        success: function(response) {
            console.log(response);
            
            var country = $('#country');
            country.empty();
            country.append('<option value="">Select Country</option>');
            response.data.forEach(function(countryt) {
                country.append('<option value="' + countryt.id + '">' + countryt.name + '</option>');
            });
        },
        error: function(xhr) {
            swal({ title: "Oops", text: xhr.responseJSON?.message || xhr.responseText, icon: "error", timer: 1500 });
        }
    });
    });

    function save() {
        let url = "{{ url('manufacturers') }}"; 
        let formData = new FormData($("#createForm")[0]);  

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.statusCode === 200) {
                    $('#createModal').modal('hide');
                    if ($('#DataTable').length) {
                        $('#DataTable').DataTable().ajax.reload();
                    }
                    swal("Success", response.statusMsg, "success");
                    $('#createForm')[0].reset();
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
                swal({ title: "Oops", text: errorMessage, icon: "error", timer: 1500 });
            }
        });

        return false;
    }

    function showData(id) {
        $.ajax({
            url: `{{ url('manufacturers') }}/${id}`,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#createForm')[0].reset();  
                $('.title').text('Update Manufacturer');
                $('#id').val(data.id);  
                $('#manufacturer').val(data.name);  
                $('#country').val(data.country_id);
                $('#status').val(data.status); 
                $('#createModal').modal('show');
            },
            error: function (xhr) {
                swal({ title: "Oops", text: "Error occurred", icon: "error", timer: 1500 });
            },
        });
    }

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
                    url: `{{ url('manufacturers') }}/${id}`,
                    type: "POST",
                    data: { '_method': 'DELETE', '_token': csrf_token },
                    success: function (response) {
                        if (response.statusCode === 200) {
                            table1.ajax.reload(null, false);
                            swal("Deleted!", "The record has been deleted!", "success");
                        } else {
                            swal("Error", response.statusMsg || "Failed to delete the record.", "error");
                        }
                    }
                });
            }
        });
    }
</script>

<script>
    $(document).ready(function () {
        let table = $("#DataTable");
        let columnToggleContainer = $("#columnToggleContainer");
        let headers = table.find("thead th");
        headers.each(function (index) {
            let columnName = $(this).text().trim();
            let checkbox = $(`
                <label class="me-2">
                    <input type="checkbox" class="toggle-column" data-column="${index}" checked> ${columnName}
                </label>
            `);

            columnToggleContainer.append(checkbox);
        });

        $(document).on("change", ".toggle-column", function () {
            let columnIndex = $(this).data("column");
            let isChecked = $(this).is(":checked");

            table.find("tr").each(function () {
                $(this).find("td, th").eq(columnIndex).toggle(isChecked);
            });
        });

        $("#filterColumnsBtn").click(function () {
            columnToggleContainer.toggle();
        });
    });
</script>

@endsection