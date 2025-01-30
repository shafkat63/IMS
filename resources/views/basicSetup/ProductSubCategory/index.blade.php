@extends('layout.app')
@section('main')

<h4 class="py-3 mb-2">Product Sub-Categories</h4>

<nav class="navbar navbar-example navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="javascript:void(0)"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-3">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-ex-3">
            <div class="navbar-nav me-auto">
                <a class="nav-item nav-link active" href="javascript:void(0)">Product Sub-Category Setup</a>
            </div>

            <form onsubmit="return false">
                <button class="btn btn-outline-success" onclick="showModal()" type="button">Add New</button>
            </form>
        </div>
    </div>
</nav>

<div class="card">
    <h5 class="card-header">Product Sub-Category Table</h5>
    

    <div class="table-responsive text-nowrap">

        {{-- Button for filter column --}}
        <button id="filterColumnsBtn" class="btn btn-primary btn-sm m-4 mb-3">Filter Columns</button>
        <div id="columnToggleContainer" class="ml-3 mb-3 m-4" style="display: none;"></div>


        <table class="table" id="productSubCategoryDataTable">
            <thead class="table-light">
                <tr>
                    <th>SL</th>
                    <th>Sub-Category Name</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="createProductSubCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <div class="modal-header mb-4">
                    <h4  class="modal-title  product-sub-category-title">Add New Product Sub-Category</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createProductSubCategoryForm" class="row g-3" onsubmit="return false">@csrf
                    <div class="col-12 mb-4">
                        <input type="hidden" id="id" name="id" class="form-control" />
                    </div>
                    <div class="row">
                        <div class="col-12 mb-4">
                            <label class="form-label" for="product_category_id">Product Category</label>
                            <select id="product_category_id" name="product_category_id" class="form-select">
                                <option value="">Select Category</option>

                            </select>
                        </div>
                        <div class="col-12 mb-4">
                            <label class="form-label" for="subcategory_name">Sub-Category Name</label>
                            <input type="text" id="subcategory_name" name="subcategory_name" class="form-control"
                                placeholder="Example: Laptops, T-Shirts, Sofas" />
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
                        <button type="submit" class="btn btn-primary me-sm-3 me-1"
                            onclick="save()">Submit</button>
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
  var table1 = $('#productSubCategoryDataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('all.product_sub_categories') !!}', 
        dom: 'Bfrtip',  // Enable buttons
        buttons: [
            {
                extend: 'colvis',
                text: 'Toggle Columns', // Button text
                className: 'btn btn-primary' // Bootstrap styling
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
            { data: 'name', name: 'name', title: 'Sub-Category Name' },
            { data: 'category_name', name: 'category_name', title: 'Category' },
            { data: 'status', name: 'status', title: 'Status' },
            { data: 'action', name: 'action', orderable: false, searchable: false, title: 'Actions' }
        ]
    });

    function showModal() {
        $('.product-sub-category-title').text('Add New Product Sub-Category'); 
        $('#createProductSubCategoryForm')[0].reset();  
        $('#id').val(''); 
        $('#createProductSubCategoryModal').modal('show');
    }


    
    $(document).ready(function() {
    $.ajax({
        url: "{{ url('/get_product_sub_categories') }}", 
        type: 'GET',
        success: function(response) {
            console.log(response);
            
            var product_category_id = $('#product_category_id');
            product_category_id.empty();
            product_category_id.append('<option value="">Select Category</option>');
            response.data.forEach(function(category) {
                product_category_id.append('<option value="' + category.id + '">' + category.name + '</option>');
            });
        },
        error: function(xhr) {
            swal({ title: "Oops", text: xhr.responseJSON?.message || xhr.responseText, icon: "error", timer: 1500 });
        }
    });
    });




    function save() {
        let url = "{{ url('product_sub_categories') }}"; 
        let formData = new FormData($("#createProductSubCategoryForm")[0]);  

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.statusCode === 200) {
                    $('#createProductSubCategoryModal').modal('hide');
                    if ($('#productSubCategoryDataTable').length) {
                        $('#productSubCategoryDataTable').DataTable().ajax.reload();
                    }
                    swal("Success", response.statusMsg, "success");
                    $('#createProductSubCategoryForm')[0].reset();
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
            url: `{{ url('product_sub_categories') }}/${id}`,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#createProductSubCategoryForm')[0].reset();  
                $('.product-sub-category-title').text('Update Product Sub-Category');
                $('#id').val(data.id);  
                $('#subcategory_name').val(data.name);  
                $('#product_category_id').val(data.product_categories_id);
                $('#status').val(data.status); 
                $('#createProductSubCategoryModal').modal('show');
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
                    url: `{{ url('product_sub_categories') }}/${id}`,
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
        let table = $("#productSubCategoryDataTable");
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