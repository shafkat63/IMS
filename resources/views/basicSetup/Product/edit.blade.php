@extends('layout.app')
@section('main')

<h4 class="py-3 mb-2">Edit Product</h4>

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

<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Edit Product</h4>
            <a href="{{ url('products') }}" class="btn btn-secondary">
                <i class='bx bx-arrow-back'></i> Back
            </a>
        </div>

        <div class="card-body">
            <form id="editForm" class="row g-3" enctype="multipart/form-data">
                @csrf
                {{-- @method('PUT')
                <!-- Method spoofing for PUT request --> --}}
                <input type="hidden" id="id" name="id" class="form-control" />

                <div class="col-6 mb-4">
                    <label class="form-label" for="product_name">Product Name</label>
                    <input type="text" id="product_name" name="product_name" class="form-control"
                        placeholder="Product Name" required />
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="product_type">Product Type</label>
                    <select id="product_type" name="product_type" class="form-select" required>
                        <option value="">Select Product Type</option>
                    </select>
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label" for="product_category_id">Product Category</label>
                    <select id="product_category_id" name="product_category_id" class="form-select" required>
                        <option value="">Select Product Category</option>
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
                                <td><select class="form-select color-select">
                                        <option value="">Select Color</option>
                                    </select></td>
                                <td><input type="text" name="spec[]" class="form-control" placeholder="Specification" />
                                </td>
                                <td><input type="file" name="image_path[]" class="form-control"
                                        onchange="previewImage(event)" /><img class="preview"
                                        style="display: none; width: 50px; height: 50px;" /></td>
                                <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
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
    var colorOptions = '';

    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = $(event.target).closest('tr').find('.preview')[0];
            output.src = reader.result;
            $(output).show();  // Show the image
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    $('#addRow').on('click', function() {
        var newRow = $('#productDetailsTable tbody tr:first').clone(); 
        newRow.find('input').val(''); 
        newRow.find('.preview').hide(); 

        newRow.find('.color-select').html(colorOptions);  

        $('#productDetailsTable tbody').append(newRow); 
    });

    $('#productDetailsTable').on('click', '.remove-row', function() {
        $(this).closest('tr').remove();
    });

    function save() {
        let url = "{{ url('products') }}/" + $('#id').val();  
        let formData = new FormData($("#editForm")[0]); 

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.statusCode === 200) {
                    swal("Success", response.statusMsg, "success").then(() => {
                        window.location.href = "{{ url('products') }}";  // Redirect after success
                    });
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
                swal({ title: "Oops", text: errorMessage, icon: "error", timer: 1500000 });
            }
        });

        return false;
    }

    $(document).ready(function() {
        let productId = "{{ $product->id }}";   
        let url = "{{ url('getProducts') }}/" + productId;

        // Step 5: Fetch Product Details
        $.ajax({
            url: url,
            type: "GET",
            success: function (response) {
        if (response.data) {
            console.log(response.data.product);

            $('#id').val(response.data.product.id);
            $('#product_name').val(response.data.product.product_name);
            getProducttype(response.data.product.product_type);
            getProductcategory(response.data.product.product_category_id);
            loadSubCategories(response.data.product.product_category_id, response.data.product.sub_category_id);
            geModeOFUnit(response.data.product.mode_of_unit);
            $('#part_number').val(response.data.product.part_number);
            $('#import_hs_code').val(response.data.product.import_hs_code);
            $('#export_hs_code').val(response.data.product.export_hs_code);
            getProductGreade(response.data.product.product_grade);

            if (response.data.product_details && response.data.product_details.length > 0) {
                let promises = [];

                $.each(response.data.product_details, function (index, item) {
                    var row = $('#productDetailsTable tbody tr:first').clone();

                    row.find('input[name="spec[]"]').val(item.spec);
                    row.find('input[name="image_path[]"]').val(item.image_path);

                    // Show image preview if available
                    if (item.image_path) {
                        var imageUrl = "{{ asset('storage') }}" + '/' + item.image_path;
                        row.find('img.preview').attr('src', imageUrl).show();
                    }

                    // Call getColor() and push its promise to the array
                    let colorPromise = getColor(item.color, row);
                    promises.push(colorPromise);

                    // Append row later after colors are set
                    promises.push(colorPromise.then(() => {
                        $('#productDetailsTable tbody').append(row);
                    }));
                });

                // Wait for all colors to be loaded before continuing
                Promise.all(promises).then(() => {
                    console.log("All product rows updated with colors.");
                }).catch(error => {
                    console.error(error);
                });
            } else {
                console.log("No product details found.");
            }
        } else {
            alert('Product data not found.');
        }
    },
    error: function (xhr, status, error) {
        console.error('Error fetching product data:', error);
        alert('Error fetching product data.');
    }
});




        function getColor(id = null, row) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: "{{ url('/getcolorforprod') }}",
            type: "GET",
            success: function (response) {
                if (response && response.data) {
                    let colorOptions = '<option value="">Select Color</option>';
                    $.each(response.data, function (index, item) {
                        colorOptions += '<option value="' + item.id + '">' + item.name + '</option>';
                    });

                    row.find('.color-select').html(colorOptions);

                    if (id !== null) {
                        row.find('.color-select').val(id);
                    }

                    resolve(); // Resolve the promise when done
                } else {
                    reject('No color options available.');
                }
            },
            error: function (xhr, status, error) {
                reject('Error fetching color options: ' + error);
            }
        });
    });
}


        // Step 7: Populate Product Type
        function getProducttype(id=null){
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
                        productTypeSelect.val(id);
                    } else {
                        alert('No product types available.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching product types:', error);
                    alert('Error fetching product types.');
                }
            });
        }

        // Step 8: Populate Product Category
        function getProductcategory(id=null){
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
                        })

                        if (id) {
                            productCategorySelect.val(id);
                        }
                    } else {
                        alert('No product categories available.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching product categories:', error);
                    alert('Error fetching product categories.');
                }
            });
        }

        function loadSubCategories(categoryId, id=null) {
            if (categoryId) {
                $.ajax({
                    url: "{{ url('/productsubcategory') }}", 
                    type: "GET",
                    data: { category_id: categoryId },
                    success: function(response) {
                        var subCategorySelect = $('#sub_category_id');
                        subCategorySelect.empty();
                        subCategorySelect.append('<option value="">Select Sub Category</option>');

                        if (response && response.data) {
                            $.each(response.data, function(index, item) {
                                subCategorySelect.append('<option value="' + item.id + '">' + item.name + '</option>');
                            });
                            subCategorySelect.val(id);
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
                $('#sub_category_id').empty().append('<option value="">Select Sub Category</option>');
            }
        }

        function geModeOFUnit(id=null){
            $.ajax({
            url: "{{ url('/modeofunit') }}",  
            type: "GET",
            success: function(response) {
                if (response && response.data) {
                    var modeOfUnitSelect = $('#mode_of_unit');
                    modeOfUnitSelect.empty();
                    modeOfUnitSelect.append('<option value="">Select Mode of Unit</option>');

                    $.each(response.data, function(index, item) {
                        modeOfUnitSelect.append('<option value="' + item.id + '">' + item.unit_name + '</option>');
                    });
                    if (id) {
                        modeOfUnitSelect.val(id);
                        }
                } else {
                    alert('No modes of unit available.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching modes of unit:', error);
                alert('Error fetching modes of unit.');
            }
        });
        }
   

        // Step 11: Populate Product Grade
        function getProductGreade(id=null){
            $.ajax({
            url: "{{ url('/productgradeforprods') }}",  
            type: "GET",
            success: function(response) {
                if (response && response.data) {
                    var productGradeSelect = $('#product_grade');
                    productGradeSelect.empty();
                    productGradeSelect.append('<option value="">Select Product Grade</option>');

                    $.each(response.data, function(index, item) {
                        productGradeSelect.append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                    if(id){
                        productGradeSelect.val(id);
                    }
                } else {
                    alert('No product grades available.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching product grades:', error);
                alert('Error fetching product grades.');
            }
        });
        }
     
    });
</script>






@endsection