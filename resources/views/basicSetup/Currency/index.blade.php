@extends('layout.app')
@section('title', '- Currencies')

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
            @can('create_currencies')
            <form onsubmit="return false">
                <button class="btn btn-outline-success" onclick="showModal()" type="button">Add New</button>
            </form>
            @endcan
        </div>
    </div>
</nav>

<div class="card">
    <h5 class="card-header">Currency Table</h5>
    <div class="table-responsive text-nowrap">


        {{-- Button for filter column --}}
        <div class="col-lg-3 col-sm-6 col-12 d-flex ms-auto justify-content-end">
            <button class="btn btn-sm btn-info m-4 mb-3" onclick="printTable()">Print</button>

            <div class="btn-group" id="filterColumnsDropdown">
                <button type="button" id="filterColumnsBtn" class="btn btn-primary dropdown-toggle btn-sm m-4 mb-3"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bx bx-filter"></i> Filter Columns
                </button>
                <ul class="dropdown-menu p-3" id="columnToggleContainer" style="max-height: 250px; overflow-y: auto;">
                </ul>
            </div>
        </div>

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

                <div class="modal-header mb-4">
                    <h4 class="modal-title currency-title">Add New Currency</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <form id="createCurrencyForm" class="row g-3" onsubmit="return false">@csrf
                    <div class="row">
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
                            <button type="submit" class="btn btn-primary me-sm-3 me-1"
                                onclick="saveCurrency()">Submit</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                aria-label="Close">Cancel</button>
                        </div>
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
        autoWidth: false,

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
        let submitButton = $('#createCurrencyForm button[type="submit"]');

        // Disable the submit button to prevent multiple submissions
        submitButton.prop('disabled', true);

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            responsive: true,
            autoWidth: false,
            scrollY: "400px",
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
            },
            complete: function () {
            // Re-enable the submit button after the request is complete
            submitButton.prop('disabled', false);
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
<script>
    $(document).ready(function () {
    let table = $("#currencyDataTable");
    let columnToggleContainer = $("#columnToggleContainer");
    let headers = table.find("thead th");

    columnToggleContainer.empty(); // Clear existing content before populating dynamically

    headers.each(function (index) {
        let columnName = $(this).text().trim();
        let listItem = $(`
            <li class="dropdown-item">
                <label class="d-flex align-items-center">
                    <input type="checkbox" class="toggle-column me-2" data-column="${index}" checked> ${columnName}
                </label>
            </li>
        `);
        columnToggleContainer.append(listItem);
    });

    $(document).on("change", ".toggle-column", function () {
        let columnIndex = $(this).data("column");
        let isChecked = $(this).is(":checked");

        table.find("tr").each(function () {
            $(this).find("td, th").eq(columnIndex).toggle(isChecked);
        });
    });
});
</script>
<script>
    //For Printing 
    function printTable() {
        var printContents = document.getElementById("currencyDataTable").outerHTML;
        
        // Open a new blank window/tab
        var newWin = window.open("", "_blank");

        newWin.document.write(`
            <html>
                <head>
                    <title>Print Table</title>
                    <style>
                        body { font-family: Arial, sans-serif; }
                        table { width: 50%; border-collapse: collapse; }
                        th, td { border: 1px solid black; padding: 8px; text-align: left; }
                        th { background-color: #f2f2f2; }
                    </style>
                </head>
                <body>
                    ${printContents}
                  
                </body>
            </html>
        `);

        // Close the document to apply styles and ensure printing works
        newWin.document.close();
    }
</script>
@endsection