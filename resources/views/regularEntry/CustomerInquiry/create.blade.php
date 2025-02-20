@extends('layout.app')
@section('main')
<style>
    .table-fixed {
        table-layout: fixed;
        width: 100%;
        padding: 0%;
    }
</style>
<div class="container ">
    <h4 class="text-center">Customer Inquiry</h4>
    <div class="card shadow-sm">
        <div class="card-body">
            <form id="createForm" class="row g-3 mt-4" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <label for="inquiry_date" class="form-label">Inquiry Date</label>
                        <input type="date" class="form-control" id="inquiry_date" name="inquiry_date" required
                            max="{{ date('Y-m-d') }}">
                    </div>

                    {{-- <div class="col-md-6">
                        <label for="system_generated_inquiry_number" class="form-label">System Generated Inquiry
                            Number</label>
                        <input type="text" class="form-control" id="system_generated_inquiry_number"
                            name="system_generated_inquiry_number" readonly required>
                    </div> --}}
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="customer_id" class="form-label">Customer</label>
                        <select class="form-control select2" id="customer_id" name="customer_id" required>
                            <option value="">Select Customer</option>
                        </select>
                    </div>


                    <div class="col-md-6">
                        <label for="inquiry_account_manager" class="form-label">Account Manager</label>
                        <input type="text" class="form-control" id="inquiry_account_manager"
                            name="inquiry_account_manager">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="shipment_mode_id" class="form-label">Shipment Mode</label>
                        <select class="form-control select2" id="shipment_mode_id" name="shipment_mode_id" required>
                            <option value="">Select Shipment Mode</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="expected_arrival_date" class="form-label">Expected Arrival Date</label>
                        <input type="date" class="form-control" id="expected_arrival_date" name="expected_arrival_date">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="payment_term" class="form-label">Payment Term</label>
                        <input type="text" class="form-control" id="payment_term" name="payment_term">
                    </div>

                    <div class="col-md-6">
                        <label for="inquiry_validity" class="form-label">Inquiry Validity</label>
                        <input type="number" class="form-control" id="inquiry_validity" name="inquiry_validity"
                            placeholder="Enter the number of days">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="remarks" class="form-label">Remarks</label>
                        <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="sample_needed" class="form-label">Sample Needed?</label>
                        <select class="form-select" id="sample_needed" name="sample_needed">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    {{-- <div class="col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div> --}}
                </div>

                <div class="col-12">
                    <label class="form-label">Product Details</label>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center align-middle table-fixed"
                            id="productDetailsTable">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 200px;">Product Name</th>
                                    <th class="text-center" style="width: 200px;">Color</th>
                                    <th class="text-center" style="width: 200px;">Import HS Code</th>
                                    <th class="text-center" style="width: 200px;">Export HS Code</th>
                                    <th class="text-center" style="width: 200px;">Specification</th>
                                    <th class="text-center" style="width: 200px;">Unit Mode</th>
                                    <th class="text-center" style="width: 200px;">Manufacturer</th>
                                    <th class="text-center" style="width: 200px;">Country of Origin</th>
                                    <th class="text-center" style="width: 200px;">Packing Size</th>
                                    <th class="text-center" style="width: 200px;">Currency</th>
                                    <th class="text-center" style="width: 200px;">Quantity</th>
                                    <th class="text-center" style="width: 200px;">Product Image</th>
                                    <th class="text-center" style="width: 200px;">Actions</th>


                                </tr>
                            </thead>

                            <tbody>
                                <tr class="product-detail-row">
                                    <td>
                                        <select name="product_name[]" class="form-control form-select product-select">
                                            <option value="">Select Product Name</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="color[]" class="form-select color-select">
                                            <option value="">Select Color</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="import_country_hs_code[]" class="form-control"
                                            placeholder="Import HS Code" />
                                    </td>
                                    <td>
                                        <input type="text" name="export_country_hs_code[]" class="form-control"
                                            placeholder="Export HS Code" />
                                    </td>
                                    <td>
                                        <input type="text" name="item_spec[]" class="form-control"
                                            placeholder="Specification" />
                                    </td>
                                    <td>
                                        <select name="mode_of_unit_id[]" class="form-select">
                                            <option value="">Select Mode of Unit</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="manufacturer[]" class="form-select manufacturer-select ">
                                            <option value="">Select Manufacturer</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="country_of_origin[]" class="form-select country-of-origin">
                                            <option value="">Select Country</option>
                                        </select>
                                    </td>

                                    <td>
                                        <input type="text" name="packing_size[]" class="form-control"
                                            placeholder="Packing Size" />
                                    </td>
                                    <td>
                                        <select name="currency_id[]" class="form-select currency">
                                            <option value="">Select Currency</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="item_quantity[]" class="form-control"
                                            placeholder="Quantity" />
                                    </td>
                                    <td>
                                        <input type="file" name="image_path[]" class="form-control"
                                            onchange="previewImage(event)" />
                                        <img class="preview mt-2" style="width: 40%; height: 40%; display: none;" />
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger removeRow"><i
                                                class="bx bx-trash-alt"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" id="addRow" class="btn btn-success mt-2">Add New Row</button>
                </div>


                <div class="text-center mt-4">
                    <button type="button" class="btn btn-primary" onclick="save()">Submit</button>
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
        let url = "{{ url('customer_inquiry') }}"; 
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
                        window.location.href = "{{ url('customer_inquiry') }}";  
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
    $(document).ready(function() {


        $.ajax({
            url: "{{ url('/getcustomer ') }}",  
            type: "GET",
            success: function(response) {
                if (response && response.data) {
                    var customer_idSelect = $('#customer_id');
                    customer_idSelect.empty(); 
                    customer_idSelect.append('<option value="">Select Customer</option>');  

                    $.each(response.data, function(index, item) {
                        customer_idSelect.append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                } else {
                    alert('No Customer  available.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching Customer:', error);
                alert('Error fetching Customer.');
            }
        });




        $.ajax({
            url: "{{ url('/getshipmentmode') }}",  
            type: "GET",
            success: function(response) {
                if (response && response.data) {
                    var shipmentModeSelect = $('#shipment_mode_id');
                    shipmentModeSelect.empty();  
                    shipmentModeSelect.append('<option value="">Select Shipment Mode</option>');  

                    $.each(response.data, function(index, item) {
                        shipmentModeSelect.append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                } else {
                    alert('No Shipment Mode available.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching Shipment Mode:', error);
                alert('Error fetching product categories.');
            }
        });



        $.ajax({
                url: "{{ url('/modeofunit') }}", 
                type: "GET",
                success: function(response) {
                if (response && response.data) {
                    console.log(response.data);

                    var modeOfUnitOptions = '<option value="">Select Mode of Unit</option>';

                    $.each(response.data, function(index, item) {
                        modeOfUnitOptions += '<option value="' + item.id + '">' + item.unit_name + '</option>';
                    });

                    $('select[name="mode_of_unit_id[]"]').html(modeOfUnitOptions);
                }
            },
                error: function(xhr, status, error) {
                    console.error("Error fetching mode of unit data:", error);
        }
        });


            $.ajax({
                url: "{{ url('/getcurrency') }}",
                type: "GET",
                success: function (response) {
                    console.log(response);

                    if (response && response.data) {
                        var currencyOptions = '<option value="">Select Currency</option>';

                        $.each(response.data, function (index, item) {
                            currencyOptions += '<option value="' + item.id + '">' + item.name + '</option>';
                        });

                        $(".currency").html(currencyOptions);
                    }
                }
            });


            let countryData = {}; 

            $.ajax({
                url: "{{ url('/getcountry') }}",
                type: "GET",
                success: function (response) {
                    if (response && response.data) {
                        console.log("Country Data:", response);

                        var countryOptions = '<option value="">Select Country</option>';

                        $.each(response.data, function (index, item) {
                            countryOptions += '<option value="' + item.id + '">' + item.name + '</option>';
                            countryData[item.id] = item.name; // Store country ID and name
                        });

                        $(".country-of-origin").html(countryOptions);
                    }
                }
            });

            $.ajax({
                url: "{{ url('/getproductname') }}",
                type: "GET",
                success: function (response) {
                    if (response && response.data) {
                        var productsOptions = '<option value="">Select Product Name</option>';

                        $.each(response.data, function (index, item) {
                            productsOptions += '<option value="' + item.id + '" data-import-hs="' + item.import_hs_code + '" data-export-hs="' + item.export_hs_code + '" data-mode="' + item.mode_of_unit + '">' + item.product_name + '</option>';
                        });

                        $('#productDetailsTable .product-detail-row .product-select').html(productsOptions);
                            }
                        }
            });

            $(document).on("change", ".product-select", function () {
                    var selectedOption = $(this).find(":selected");

                    var productId = selectedOption.val();
                    var importHsCode = selectedOption.data("import-hs") || '';
                    var exportHsCode = selectedOption.data("export-hs") || '';
                    var modeOfUnit = selectedOption.data("mode") || '';

                    var row = $(this).closest(".product-detail-row");

                    row.find('input[name="import_country_hs_code[]"]').val(importHsCode);
                    row.find('input[name="export_country_hs_code[]"]').val(exportHsCode);

                    var modeOfUnitDropdown = row.find('select[name="mode_of_unit_id[]"]');

                    if (modeOfUnit) {
                        modeOfUnitDropdown.val(modeOfUnit).trigger("change");
                    } else {
                        modeOfUnitDropdown.val("");
                    }

                    // Fetch colors based on selected product
                    if (productId) {
                        $.ajax({
                            url: "{{ url('/getcolorforcustomerinquiry') }}",
                            type: "GET",
                            data: { product_id: productId }, // Send the selected product ID
                            success: function (response) {
                                if (response && response.data) {
                                    var colorOptions = '<option value="">Select Color</option>';

                                    $.each(response.data, function (index, item) {
                                        colorOptions += '<option value="' + item.id + '">' + item.name + '</option>';
                                    });

                                    row.find('.color-select').html(colorOptions);
                                }
                            },
                            error: function () {
                                alert("Failed to fetch colors.");
                            }
                        });
                    }
                });




                $(document).on("change", ".color-select", function () {
                        var selectedColor = $(this).find(":selected").val();
                        var row = $(this).closest(".product-detail-row");
                        var selectedProduct = row.find(".product-select").val();

                        if (selectedProduct && selectedColor) {
                            $.ajax({
                                url: "{{ url('/getspecforcustomerinquiry') }}", 
                                type: "GET",
                                data: { product_id: selectedProduct, color_id: selectedColor }, 
                                success: function (response) {
                                    if (response && response.data) {
                                        row.find('input[name="item_spec[]"]').val(response.data.spec || '');
                                    }
                                },
                                error: function () {
                                    alert("Failed to fetch specifications.");
                                }
                            });
                        }
                    });


        $.ajax({
            url: "{{ url('/getmanufacturers') }}",
            type: "GET",
            success: function (response) {
                if (response && response.data) {
                    console.log("Manufacturer Data:", response);

                    var manufacturerOptions = '<option value="">Select Manufacturer</option>';

                    $.each(response.data, function (index, item) {
                        manufacturerOptions += '<option value="' + item.id + '" data-country-id="' + item.country_id + '">' + item.name + '</option>';
                    });

                    $(".manufacturer-select").html(manufacturerOptions);
                }
            }
        });

            $(document).on("change", ".manufacturer-select", function () {
                var selectedOption = $(this).find(":selected");
                var countryId = selectedOption.data("country-id");

                var row = $(this).closest("tr");
                var countryDropdown = row.find('select[name="country_of_origin[]"]');

                if (countryId) {
                    countryDropdown.val(countryId).trigger("change");
                } else {
                    countryDropdown.val(""); 
                }
            });
                    
 
        

        // $.ajax({
        //     url: "{{ url('/getcolorforprod') }}", 
        //     type: "GET",
        //     success: function(response) {
        //         if (response && response.data) {
        //             var colorOptions = '<option value="">Select Color</option>';
                    
        //             $.each(response.data, function(index, item) {
        //                 colorOptions += '<option value="' + item.id + '">' + item.name + '</option>';
        //             });

        //             $('#productDetailsTable .product-detail-row .color-select').html(colorOptions);
        //         }
        //     }
        // });



        $('#addRow').on('click', function() {
            var newRow = $('#productDetailsTable tbody tr:first').clone();
            newRow.find('input').val(''); 
            newRow.find('select').html(colorOptions);  
            $('#productDetailsTable tbody').append(newRow);
        });
    });


</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        function generateInquiryNumber() {
            let date = document.getElementById("inquiry_date").value.replace(/-/g, ""); 
            let customerId = document.getElementById("customer_id").value || "00"; 
            let shipmentMode = document.getElementById("shipment_mode_id").value || "0"; 
            let randomString = Math.random().toString(36).substring(2, 5).toUpperCase(); 
    
            if (date) {
                let inquiryNumber = `${date}-${customerId}-${shipmentMode}-${randomString}`;
                document.getElementById("system_generated_inquiry_number").value = inquiryNumber;
            } else {
                document.getElementById("system_generated_inquiry_number").value = "";
            }
        }
    
        document.getElementById("inquiry_date").addEventListener("change", generateInquiryNumber);
        document.getElementById("customer_id").addEventListener("change", generateInquiryNumber);
        document.getElementById("shipment_mode_id").addEventListener("change", generateInquiryNumber);
    });
</script>


@endsection