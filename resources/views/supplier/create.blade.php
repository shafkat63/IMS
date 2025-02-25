@extends('layout.app')
@section('title', '- Inquiry to Supplier Create')

@section('main')
<style>
    .table-fixed {
        table-layout: fixed;
        width: 100%;
        padding: 0%;
    }
</style>
<div class="container ">
    <h4 class="text-center"> Inquiry to Supplier</h4>
    <div class="card shadow-sm">
        <div class="card-body">
            <form id="createForm" class="row g-3 mt-4" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="supplier_id" class="form-label">Supplier</label>
                                <select class="form-control select2" id="supplier_id" name="supplier_id">
                                    <option value="">Select Supplier</option>
                                </select>
                            </div>
                
                            <div class="col-md-12">
                                <label for="customer_inquiry_number" class="form-label">Customer Inquiry Number</label>
                                <select class="form-control select2" id="customer_inquiry_number" name="customer_inquiry_number">
                                    <option value="">Select Inquiry</option>
                                </select>
                            </div>
                
                            <div class="col-md-12">
                                <label for="expected_arrival_date" class="form-label">Expected Arrival Date</label>
                                <input type="date" class="form-control" id="expected_arrival_date" name="expected_arrival_date">
                            </div>
                
                            <div class="col-md-12">
                                <label for="submission_date" class="form-label">Submission Date</label>
                                <input type="date" class="form-control" id="submission_date" name="submission_date" required max="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                
                    <!-- Right Column -->
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="customer_id" class="form-label">Customer</label>
                                <select class="form-control select2" id="customer_id" name="customer_id" readonly>
                                    <option value="">Select Customer</option>
                                </select>
                            </div>
                
                            <div class="col-md-12">
                                <label for="shipment_mode" class="form-label">Shipment Mode</label>
                                <select class="form-control select2" id="shipment_mode" name="shipment_mode" readonly>
                                    <option value="">Select Shipment Mode</option>
                                </select>
                            </div>
                
                            <div class="col-md-12">
                                <label for="payment_term" class="form-label">Payment Term</label>
                                <input type="text" class="form-control" id="payment_term" name="payment_term" readonly>
                            </div>
                
                            <div class="col-md-12">
                                <label for="inquiry_validity" class="form-label">Inquiry Validity</label>
                                <input type="text" class="form-control" id="inquiry_validity" name="inquiry_validity" placeholder="Enter the number of days" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                



                <div class="row">


                    <div class="col-md-6">
                        <label for="sample_need" class="form-label">Sample Needed?</label>
                        <select class="form-select" id="sample_need" name="sample_need">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label for="remarks" class="form-label">Remarks</label>
                        <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
                    </div>
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
                                    <th class="text-center" style="width: 200px;">Specification</th>
                                    <th class="text-center" style="width: 200px;">Import HS Code</th>
                                    <th class="text-center" style="width: 200px;">Export HS Code</th>
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
                                        <input type="text" name="item_spec[]" class="form-control"
                                           disabled placeholder="Specification" />
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
        let url = "{{ url('csuplier_inquiry_to_customer') }}"; 
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
                        window.location.href = "{{ url('csuplier_inquiry_to_customer') }}";  
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
                url: "{{ url('/get-customer-inquiries') }}",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $("#customer_inquiry_number").empty().append('<option value="">Select Inquiry</option>');
                    $.each(data, function (index, inquiry) {
                        $("#customer_inquiry_number").append(
                            '<option value="' + inquiry.id + '" ' +
                            'data-customer-id="' + inquiry.customer_id + '" ' +
                            'data-shipment-mode-id="' + inquiry.shipment_mode_id + '" ' +
                            'data-shipment-mode-name="' + inquiry.shipment_mode_name + '" ' +
                            'data-payment-term="' + inquiry.payment_term + '" ' +
                            'data-inquiry-validity="' + inquiry.inquiry_validity + '" ' +
                            'data-sample-needed="' + inquiry.sample_needed + '">' + // Sample Needed
                            inquiry.system_generated_inquiry_number +
                            '</option>'
                        );
                    });
                },
                error: function () {
                    $("#customer_inquiry_number").empty().append('<option value="">No Inquiries Found</option>');
                    console.error("Error fetching customer inquiries.");
    }
});

            $('#customer_inquiry_number').on('change', function () {
                var selectedOption = $(this).find(':selected');
                var inquiryId = selectedOption.val();
                var customerId = selectedOption.data('customer-id');
                var shipmentModeId = selectedOption.data('shipment-mode-id');
                var shipmentModeName = selectedOption.data('shipment-mode-name');
                var paymentTerm = selectedOption.data('payment-term');
                var inquiryValidity = selectedOption.data('inquiry-validity');
                var sampleNeeded = selectedOption.data('sample-needed'); // Get Sample Needed

                // Update Customer Dropdown
                if(inquiryId){

                    function getDeatilsData() {
    
                                var formData = new FormData(document.getElementById('addLaptopBrandForm'));
                                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                                

                                $.ajax({
                                    url: "{{ url('get_customer_inquiries_details') }}/" + inquiryId,
                                    type: "GET",
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    success: function (response) {
                                        console.log(response);

                                        response.forEach(function (data) {
                                            var newRow = $('.product-detail-row').clone().removeAttr('style').removeClass('product-detail-row');

                                            newRow.find('select[name="product_name[]"]').val(data.id).trigger('change');

                                            // showTypeSize(data.component, newRow);
                                            showTypeSize(data.component, newRow, data.type_size);


                                            newRow.find('select[name="brandss[]"]').val(data.brand);
                                            newRow.find('input[name="capacity_resolutionss[]"]').val(data.capacity_resolution);
                                            newRow.find('input[name="install_datess[]"]').val(data.install_date).change();
                                            newRow.find('input[name="expire_datess[]"]').val(data.expire_date).change();
                                            newRow.find('input[name="pricess[]"]').val(data.price); 
                                            newRow.find('select[name="active_statusess[]"]').val(data.active_status);
                                            newRow.find('input[name="item_idss[]"]').val(data.item_id);
                                            newRow.find('input[name="remarkss[]"]').val(data.remarks);

                                            newRow.find('select[name="type_sizess[]"]').val(data.type_size).change();
                                            initializeDatepicker(newRow);

                                            $('#details-tbody').append(newRow);
                                        });
                                        //Spinner
                                        const spinner = document.getElementById('loadingSpinner');
                                            if (spinner) {
                                            spinner.style.display = 'none'; // Hide the spinner once the rows are appended
                                            }
                                    
                                        showcomponents();
                                        
                                    },
                                    error: function () {
                                        swal({
                                            title: "Error",
                                            text: "Something went wrong!",
                                        });
                                    }
                                });
                                }

                   
                }
                if (inquiryId) {
                    $.ajax({
                        url: "{{ url('/get-customer') }}/" + inquiryId,
                        type: "GET",
                        dataType: "json",
                        success: function (response) {
                            var customerSelect = $('#customer_id');
                            customerSelect.empty();
                            if (response) {
                                customerSelect.append('<option value="' + response.id + '" selected>' + response.name + '</option>');
                            } else {
                                customerSelect.append('<option value="">No Customer Found</option>');
                            }
                        },
                        error: function () {
                            $('#customer_id').empty().append('<option value="">Error Fetching Customer</option>');
                            console.error("Error fetching customer.");
                        }
                    });

                    var shipmentSelect = $('#shipment_mode');
                    shipmentSelect.empty();
                    if (shipmentModeId) {
                        shipmentSelect.append('<option value="' + shipmentModeId + '" selected>' + shipmentModeName + '</option>');
                    } else {
                        shipmentSelect.append('<option value="">No Shipment Mode Found</option>');
                    }

                    $('#payment_term').val(paymentTerm ? paymentTerm : '');

                    $('#inquiry_validity').val(inquiryValidity ? inquiryValidity : '');

                    $('#sample_need').val(sampleNeeded ? sampleNeeded : 'No'); // Default to 'No'

                } else {
                    $('#customer_id').empty().append('<option value="">Select Customer</option>');
                    $('#shipment_mode').empty().append('<option value="">Select Shipment Mode</option>');
                    $('#payment_term').val('');
                    $('#inquiry_validity').val('');
                    $('#sample_need').val('No');
                }
            });




        $.ajax({
            url: "{{ route('get.suppliers') }}",
            type: "GET",
            dataType: "json",
            success: function (data) {
                var supplierSelect = $("#supplier_id");
                supplierSelect.empty();
                supplierSelect.append('<option value="">Select Supplier</option>');

                $.each(data, function (key, supplier) {
                    supplierSelect.append('<option value="' + supplier.id + '">' + supplier.supplier_name + '</option>');
                });
            },
            error: function (xhr, status, error) {
                console.error("Error fetching suppliers:", error);
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
                    



        $('#addRow').on('click', function() {
            var newRow = $('#productDetailsTable tbody tr:first').clone();
            newRow.find('input').val(''); 
            newRow.find('select').html(colorOptions);  
            $('#productDetailsTable tbody').append(newRow);
        });
    });


</script>

<script>
    document.getElementById('customer_id').addEventListener('mousedown', function (e) {
        e.preventDefault();
    });

    document.getElementById('shipment_mode').addEventListener('mousedown', function (e) {
        e.preventDefault();
    });
</script>


@endsection