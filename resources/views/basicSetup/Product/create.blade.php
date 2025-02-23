@extends('layout.app')
@section('title', '- Product Create')

@section('main')

<h4 class="py-3 mb-2">Product </h4>

<nav class="navbar navbar-example navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="javascript:void(0)"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-3">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-ex-3">
            <div class="navbar-nav me-auto">
                <a class="nav-item nav-link active" href="javascript:void(0)">Product Setup</a>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-4 ">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Add New Product </h4>
            <a href="{{ url('products') }}" class="btn btn-secondary">
                <i class='bx bx-arrow-back'></i> Back
            </a>

        </div>


        <div class="card-body">
            <form id="createForm" class="row g-3" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="id" name="id" class="form-control" />

                <div class="col-6 mb-4">
                    <label class="form-label" for="product_name">Product Name</label>
                    <input type="text" id="product_name" name="product_name" class="form-control"
                        placeholder="Product Name" required />
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="product_type">Product Type</label>
                    <select id="product_type" name="product_type" class="form-select" required>
                        <option value="">Select Product Type</option> <!-- Placeholder option -->
                    </select>
                </div>


                <div class="col-6 mb-4">
                    <label class="form-label" for="product_category_id">Product Category</label>
                    <select id="product_category_id" name="product_category_id" class="form-select" required>
                        <option value="">Select Product Category</option> <!-- Placeholder option -->
                    </select>
                </div>


                <div class="col-6 mb-4">
                    <label class="form-label" for="sub_category_id">Sub Category</label>
                    <select id="sub_category_id" name="sub_category_id" class="form-select" required>
                        <option value="">Select Sub Category</option>
                    </select>
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="mode_of_unit">Mode of Unit</label>
                    <select id="mode_of_unit" name="mode_of_unit" class="form-select" required>
                        <option value="">Select Mode of Unit</option>
                    </select>
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="part_number">Part Number</label>
                    <input type="text" id="part_number" name="part_number" class="form-control"
                        placeholder="Part Number" required />
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="import_hs_code">Import HS Code</label>
                    <input type="text" id="import_hs_code" name="import_hs_code" class="form-control"
                        placeholder="Import HS Code" />
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="export_hs_code">Export HS Code</label>
                    <input type="text" id="export_hs_code" name="export_hs_code" class="form-control"
                        placeholder="Export HS Code" />
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="product_grade">Product Grade</label>
                    <select id="product_grade" name="product_grade" class="form-select">
                        <option value="">Select Product Grade</option>
                    </select>
                </div>


                <div class="col-12 mb-4">
                    <label class="form-label" for="product_details">Product Details</label>
                    <table class="table" id="productDetailsTable">
                        <thead>
                            <tr>
                                <th>Color</th>
                                <th>Specification</th>
                                <th>Product Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="product-detail-row">
                                <td>
                                    <select name="color[]" class="form-select color-select">
                                        <option value="">Select Color</option>
                                        <!-- Colors will be populated here dynamically -->
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="spec[]" class="form-control" placeholder="Specification" />
                                </td>
                                <td>
                                    <input type="file" name="image_path[]" class="form-control"
                                        onchange="previewImage(event)" />
                                    <img class="preview" style="width: 40%; height: 40%; display: none;" />
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger removeRow"><i
                                            class="bx bx-trash-alt"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" id="addRow" class="btn btn-success">Add New Row</button>
                </div>

                <div class="col-12 text-center">
                    <button type="button" class="btn btn-primary me-sm-3 me-1" onclick="save()">Submit</button>
                    <button type="reset" class="btn btn-secondary">Clear</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection


@section('script')

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = $(event.target).closest('tr').find('.preview')[0];
            output.src = reader.result;
            $(output).show();  // Show the image
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // Add a new row
    $('#addRow').on('click', function() {
        var $newRow = $('#productDetailsTable tbody tr.product-detail-row:first').clone(); 

        $newRow.find('input').val('');
        $newRow.find('.preview').hide();
        $('#productDetailsTable tbody').append($newRow);
    });

    $('#productDetailsTable').on('click', '.removeRow', function() {
    let rowCount = $('#productDetailsTable tbody tr').length;
        if (rowCount > 1) {
        $(this).closest('tr').remove();
    } else {
        alert('At least one row must remain.');
    }
});

    function save() {
        let url = "{{ url('products') }}"; 
        let formData = new FormData($("#createForm")[0]);  
        let submitButton = $('#createProductSubCategoryForm button[type="submit"]');

      submitButton.prop('disabled', true);

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.statusCode === 200) {
                    swal("Success", response.statusMsg, "success").then(() => {
                        window.location.href = "{{ url('products') }}";  
                    });
                }else {
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
                swal({ title: "Oops", text: errorMessage, icon: "error", timer: 1500000 });
            },
        complete: function () {
            submitButton.prop('disabled', false);
        }
        });

        return false;
    }

</script>
<script>
    //Dynamic Ajax request

    $(document).ready(function() {
        $.ajax({
            url: "{{ url('/producttype') }}",  
            type: "GET",
            success: function(response) {
                if (response && response.data) {
                    var productTypeSelect = $('#product_type');
                    productTypeSelect.empty(); 
                    productTypeSelect.append('<option value="">Select Product Type</option>');  

                    $.each(response.data, function(index, item) {
                        productTypeSelect.append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                } else {
                    alert('No product types available.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching product types:', error);
                alert('Error fetching product types.');
            }
        });
        $.ajax({
            url: "{{ url('/productcategory') }}",  
            type: "GET",
            success: function(response) {
                if (response && response.data) {
                    var productCategorySelect = $('#product_category_id');
                    productCategorySelect.empty();  
                    productCategorySelect.append('<option value="">Select Product Category</option>');  

                    $.each(response.data, function(index, item) {
                        productCategorySelect.append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                } else {
                    alert('No product categories available.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching product categories:', error);
                alert('Error fetching product categories.');
            }
        });


        $('#product_category_id').change(function() {
            var categoryId = $(this).val();
            if (categoryId) {
                $.ajax({
                    url: "{{ url('/productsubcategory') }}", 
                    type: "GET",
                    data: { category_id: categoryId },
                    success: function(response) {
                        var subCategorySelect = $('#sub_category_id');
                        subCategorySelect.empty();  // Clear existing subcategory options
                        subCategorySelect.append('<option value="">Select Sub Category</option>');  // Default option

                        // Check if subcategories are available
                        if (response && response.data) {
                            $.each(response.data, function(index, item) {
                                subCategorySelect.append('<option value="' + item.id + '">' + item.name + '</option>');
                            });
                        } else {
                            subCategorySelect.append('<option value="">No subcategories found</option>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching subcategories:', error);
                        alert('Error fetching subcategories.');
                    }
                });
            } else {
                $('#sub_category_id').empty().append('<option value="">Select Sub Category</option>');  // Reset subcategory dropdown
            }
        });
        $.ajax({
            url: "{{ url('/modeofunit') }}",  // Adjust to your route
            type: "GET",
            success: function(response) {
                if (response && response.data) {
                    console.log(response.data);
                    
                    var modeOfUnitSelect = $('#mode_of_unit');
                    modeOfUnitSelect.empty();  // Clear any existing options
                    modeOfUnitSelect.append('<option value="">Select Mode of Unit</option>');
                    
                    $.each(response.data, function(index, item) {
                        modeOfUnitSelect.append('<option value="' + item.id + '">' + item.unit_name + '</option>');
                    });
                }
            }
        });

        $.ajax({
            url: "{{ url('/productgradeforprods') }}",  // Adjust to your route
            type: "GET",
            success: function(response) {
                if (response && response.data) {
                    var productGradeSelect = $('#product_grade');
                    productGradeSelect.empty();  // Clear any existing options
                    productGradeSelect.append('<option value="">Select Product Grade</option>');
                    
                    $.each(response.data, function(index, item) {
                        productGradeSelect.append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                }
            }
        });

        $.ajax({
            url: "{{ url('/getcolorforprod') }}", 
            type: "GET",
            success: function(response) {
                if (response && response.data) {
                    var colorOptions = '<option value="">Select Color</option>';
                    
                    $.each(response.data, function(index, item) {
                        colorOptions += '<option value="' + item.id + '">' + item.name + '</option>';
                    });

                    $('#productDetailsTable .product-detail-row .color-select').html(colorOptions);
                }
            }
        });

        // Add new row functionality
        $('#addRow').on('click', function() {
            var newRow = $('#productDetailsTable tbody tr:first').clone();
            newRow.find('input').val(''); 
            newRow.find('select').html(colorOptions);  
            $('#productDetailsTable tbody').append(newRow);
        });
    });
</script>


@endsection