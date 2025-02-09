@extends('layout.app')
@section('main')

<h4 class="py-3 mb-2">Product Type</h4>

<nav class="navbar navbar-example navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="javascript:void(0)"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-3">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-ex-3">
            <div class="navbar-nav me-auto">
                <a class="nav-item nav-link active" href="javascript:void(0)">Product Type Setup</a>
            </div>

            <form onsubmit="return false">
                <button class="btn btn-outline-success" onclick="showModal()" type="button">Add New</button>
            </form>
        </div>
    </div>
</nav>

<div class="card">
    <h5 class="card-header">Product Type Table</h5>


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
                    <h4 class="modal-title title">Add New Product Type</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createForm" class="row g-3" onsubmit="return false">@csrf
                    <div class="row">
                        <div class="col-12 mb-4">
                            <input type="hidden" id="id" name="id" class="form-control" />
                        </div>
                        <div class="row">


                            <div class="col-12 mb-4">
                                <label class="form-label" for="name">Product Type</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Machineries,etc" />
                            </div>
                            <div class="col-12 mb-4">
                                <label class="form-label" for="alias">Product Type Alias</label>
                                <input type="text" id="alias" name="alias" class="form-control" placeholder="M,etc" />
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
        responsive: true,
        autoWidth: false,
        ajax: '{!! route('all.product_types') !!}', 
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
            { data: 'alias', name: 'alias', title: 'Alias' },
            {
                data: 'status',
                orderable: false,
                render: function(data, type, row) {
                    if(row.status=='active'){
                        return `<button onclick="changeStatus('${row.id}')" class="btn badge bg-label-success text-upercase">${row.status}</button>`;
                    }
                    else if(row.status=='inactive'){
                        return `<button onclick="changeStatus('${row.id}')" class="badge bg-label-warning text-upercase">${row.status}</button>`;
                    }
                }
            },
            { data: 'action', name: 'action', orderable: false, searchable: false, title: 'Actions' }

        ]
    });

    function showModal() {
        $('.title').text('Add New Product Type '); 
        $('#createForm')[0].reset();  
        $('#id').val(''); 
        $('#createModal').modal('show');
    }


    function save() {
        let url = "{{ url('product_types') }}"; 
        let formData = new FormData($("#createForm")[0]);  
        let submitButton = $('#createForm button[type="submit"]');

            submitButton.prop('disabled', true);
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
           
            scrollY: "400px",  // Set table height to 400px

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
            },
        complete: function () {
            submitButton.prop('disabled', false);
        }
        });

        return false;
    }

    function showData(id) {
        $.ajax({
            url: `{{ url('product_types') }}/${id}`,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#createForm')[0].reset();  
                $('.title').text('Update Product Type');
                $('#id').val(data.id);  
                $('#name').val(data.name);  
                $('#alias').val(data.alias);
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
                    url: `{{ url('product_types') }}/${id}`,
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
        var printContents = document.getElementById("DataTable").outerHTML;
        
        // Open a new blank window/tab
        var newWin = window.open("", "_blank");

        // Write the table content into the new window
        newWin.document.write(`
            <html>
                <head>
                    <title>Print Table</title>
                    <style>
                        body { font-family: Arial, sans-serif; }
                        table { width: 100%; border-collapse: collapse; }
                        th, td { border: 1px solid black; padding: 8px; text-align: left; }
                        th { background-color: #f2f2f2; }
                    </style>
                </head>
                <body>
                    ${printContents}
                  
                </body>
            </html>
        `);

        newWin.document.close();
    }
</script>
@endsection