@extends('layout.app')
@section('main')

<h4 class="py-3 mb-2">Product Categories</h4>

<nav class="navbar navbar-example navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="javascript:void(0)"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-3">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-ex-3">
            <div class="navbar-nav me-auto">
                <a class="nav-item nav-link active" href="javascript:void(0)">Product Category Setup</a>
            </div>

            <form onsubmit="return false">
                <button class="btn btn-outline-success" onclick="showModal()" type="button">Add New</button>
            </form>
        </div>
    </div>
</nav>

<div class="card">
    <h5 class="card-header">Product Category Table</h5>
    <div class="table-responsive text-nowrap">
                {{-- Button for filter column --}}
                <div class="col-lg-3 col-sm-6 col-12 d-flex ms-auto justify-content-end">
                    <div class="btn-group" id="filterColumnsDropdown">
                        <button type="button" id="filterColumnsBtn" class="btn btn-primary dropdown-toggle btn-sm m-4 mb-3"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-filter"></i> Filter Columns
                        </button>
                        <ul class="dropdown-menu p-3" id="columnToggleContainer" style="max-height: 250px; overflow-y: auto;">
                        </ul>
                    </div>
                </div>
                
        <table class="table" id="productCategoryDataTable">
            <thead class="table-light">
                <tr>
                    <th>SL</th>
                    <th>Category Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="createProductCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-dialog-centered">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="product-category-title">Add New Product Category</h3>
                    <p>Enter Product Category Details</p>
                </div>
                <form id="createProductCategoryForm" class="row g-3" onsubmit="return false">@csrf
                    <div class="col-12 mb-4">
                        <input type="hidden" id="id" name="id" class="form-control" />
                    </div>

                    <div class="col-12 mb-4">
                        <label class="form-label" for="category_name">Category Name</label>
                        <input type="text" id="category_name" name="category_name" class="form-control"
                            placeholder="Example: Electronics, Clothing, Furniture" />
                    </div>
                    <div class="col-12 mb-4">
                        <label class="form-label" for="status">Status</label>
                        <select id="status" name="status" class="form-select">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1" onclick="saveProductCategory()">Submit</button>
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
    var table1 = $('#productCategoryDataTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{!! route('all.productcategories') !!}', 
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
        { data: 'name', name: 'name' },
        { data: 'status', name: 'status' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
});

function showModal() {
    $('.product-category-title').text('Add New Product Category'); 
    $('#createProductCategoryForm')[0].reset();  
    $('#id').val(''); 
    $('#createProductCategoryModal').modal('show');
}

function saveProductCategory() {
    let url = "{{ url('productcategories') }}"; 
    let formData = new FormData($("#createProductCategoryForm")[0]);  
        let submitButton = $('#createProductCategoryForm button[type="submit"]');

        submitButton.prop('disabled', true);

    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.statusCode === 200) {
                $('#createProductCategoryModal').modal('hide');
                if ($('#productCategoryDataTable').length) {
                    $('#productCategoryDataTable').DataTable().ajax.reload();
                }
                swal("Success", response.statusMsg, "success");
                $('#createProductCategoryForm')[0].reset();
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
            submitButton.prop('disabled', false);
        }
    });

    return false;
}

function showData(id) {
    $.ajax({
        url: `{{ url('productcategories') }}/${id}`,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            $('#createProductCategoryForm')[0].reset();  
            $('.product-category-title').text('Update Product Category');
            $('#id').val(data.id);  
            $('#category_name').val(data.name);  
            $('#status').val(data.status); 
            $('#createProductCategoryModal').modal('show');
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
                url: `{{ url('productcategories') }}/${id}`,
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
    let table = $("#productCategoryDataTable");
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
@endsection
