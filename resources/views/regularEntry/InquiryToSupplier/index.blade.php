@extends('layout.app')
@section('main')

<h4 class="py-3 mb-2">Supplier Inquiry</h4>

<nav class="navbar navbar-example navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="javascript:void(0)"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-3">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-ex-3">
            <div class="navbar-nav me-auto">
                <a class="nav-item nav-link active" href="javascript:void(0)">Supplier Inquiry</a>
            </div>

            <form onsubmit="return false">
                <a href="{{ url('inquiry_to_supplier/create') }}" class="btn btn-outline-success">Add New</a>
            </form>

        </div>
    </div>
</nav>

<div class="card">
    <h5 class="card-header">Supplier Inquiry Table</h5>


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
                    <th>Inquiry Date</th>
                    <th>System Generated Inquiry Number</th>
                    <th>Customer Name</th>
                    <th>Inquiry Account Manager</th>
                    <th>Shipment Mode</th>
                    <th>Expected Arrival Date</th>
                    <th>Payment Term</th>
                    <th>Inquiry Validity</th>
                    <th>Remarks</th>
                    <th>Authorization Status</th>
                    <th>Sample Needed</th>
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
                    <h4 class="modal-title title">Add New Product</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createForm" class="row g-3" onsubmit="return false">
                    @csrf
                    <div class="col-12 mb-4">
                        <input type="hidden" id="id" name="id" class="form-control" />
                    </div>

                    <div class="col-12 mb-4">
                        <label class="form-label" for="organization_logo">Organization Logo</label>
                        <input type="file" id="organization_logo" name="organization_logo" class="form-control" />
                    </div>

                    <div class="col-6 mb-4">
                        <label class="form-label" for="organization_name">Organization Name</label>
                        <input type="text" id="organization_name" name="organization_name" class="form-control"
                            placeholder="Bang Jin" />
                    </div>

                    <div class="col-6 mb-4">
                        <label class="form-label" for="tin_number">TIN Number</label>
                        <input type="text" id="tin_number" name="tin_number" class="form-control"
                            placeholder="8965XXXXXXXX" />
                    </div>

                    <div class="col-6 mb-4">
                        <label class="form-label" for="bin_number">BIN Number</label>
                        <input type="text" id="bin_number" name="bin_number" class="form-control"
                            placeholder="2547XXXXXXXX" />
                    </div>

                    <div class="col-6 mb-4">
                        <label class="form-label" for="vat_registration_number">VAT Registration Number</label>
                        <input type="text" id="vat_registration_number" name="vat_registration_number"
                            class="form-control" placeholder="4698XXXXXXXX" />
                    </div>

                    <div class="col-6 mb-4">
                        <label class="form-label" for="national_id">National ID</label>
                        <input type="text" id="national_id" name="national_id" class="form-control"
                            placeholder="5552091160" />
                    </div>

                    <div class="col-6 mb-4">
                        <label class="form-label" for="address_1">Address 1</label>
                        <input type="text" id="address_1" name="address_1" class="form-control" placeholder="Dhaka" />
                    </div>

                    <div class="col-6 mb-4">
                        <label class="form-label" for="address_2">Address 2</label>
                        <input type="text" id="address_2" name="address_2" class="form-control" placeholder="Khulna" />
                    </div>

                    <div class="col-6 mb-4">
                        <label class="form-label" for="contact_person_1">Contact Person 1</label>
                        <input type="text" id="contact_person_1" name="contact_person_1" class="form-control"
                            placeholder="Md.Kamal Hossain" />
                    </div>

                    <div class="col-6 mb-4">
                        <label class="form-label" for="contact_person_2">Contact Person 2</label>
                        <input type="text" id="contact_person_2" name="contact_person_2" class="form-control"
                            placeholder="Md.Jamal Hossain" />
                    </div>

                    <div class="col-6 mb-4">
                        <label class="form-label" for="contact_number_1">Contact Number 1</label>
                        <input type="text" id="contact_number_1" name="contact_number_1" class="form-control"
                            placeholder="017XXXXXXXX" />
                    </div>

                    <div class="col-6 mb-4">
                        <label class="form-label" for="contact_number_2">Contact Number 2</label>
                        <input type="text" id="contact_number_2" name="contact_number_2" class="form-control"
                            placeholder="017XXXXXXXX" />
                    </div>

                    <div class="col-6 mb-4">
                        <label class="form-label" for="email_address">Email Address</label>
                        <input type="email" id="email_address" name="email_address" class="form-control"
                            placeholder="abc@gmail.com" />
                    </div>

                    <div class="col-6 mb-4">
                        <label class="form-label" for="web_address">Web Address</label>
                        <input type="text" id="web_address" name="web_address" class="form-control"
                            placeholder="www.bangjin.com.bd" />
                    </div>

                    <div class="col-6 mb-4">
                        <label class="form-label" for="mobile_wallet_number">Mobile Wallet Number</label>
                        <input type="text" id="mobile_wallet_number" name="mobile_wallet_number" class="form-control"
                            placeholder="01XXXXXXXXX" />
                    </div>

                    <div class="col-6 mb-4">
                        <label class="form-label" for="erc_number">ERC Number</label>
                        <input type="text" id="erc_number" name="erc_number" class="form-control" />
                    </div>

                    <div class="col-6 mb-4">
                        <label class="form-label" for="status">Status</label>
                        <select id="status" name="status" class="form-select">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1" onclick="save()">Submit</button>
                        <button type="reset" class="btn btn-label-secondary">Cancel</button>
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
        ajax: '{!! route('all.customer_inquiry') !!}', 
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
            { data: 'inquiry_date', name: 'inquiry_date', title: 'Inquiry Date' },
            { data: 'system_generated_inquiry_number', name: 'system_generated_inquiry_number', title: 'System Generated Inquiry Number' },
            { data: 'customer_name', name: 'customer_name', title: 'Customer Name' },
            { data: 'inquiry_account_manager', name: 'inquiry_account_manager', title: 'Inquiry Account Manager ' },
            { data: 'shipment_mode', name: 'shipment_mode', title: 'Shipment Mode' },
            { data: 'expected_arrival_date', name: 'expected_arrival_date', title: '>Expected Arrival Date' },
            { data: 'payment_term', name: 'payment_term', title: 'Payment Term' },
            { data: 'inquiry_validity', name: 'inquiry_validity', title: 'Inquiry Validity' },
            { data: 'remarks', name: 'remarks', title: 'Remarks' },
            { data: 'authorization_status', name: 'authorization_status', title: 'Authorization Status' },
            { data: 'sample_needed', name: 'sample_needed', title: 'Sample Needed' },
            { data: 'status', name: 'status', title: 'Status' },
            { data: 'action', name: 'action', orderable: false, searchable: false, title: 'Actions' }
        ]
    });
    function showModal() {
        $('.title').text('Add Product'); 
        $('#createForm')[0].reset();  
        $('#id').val(''); 
        $('#createModal').modal('show');
    }


    function save() {
        let url = "{{ url('products') }}"; 
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
        url: `{{ url('products') }}/${id}`,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            $('#createForm')[0].reset(); 
            $('.title').text('Update Organization');  
            $('#id').val(data.id); 
            $('#organization_name').val(data.organization_name);  
            $('#tin_number').val(data.tin_number); 
            $('#bin_number').val(data.bin_number);  
            $('#vat_registration_number').val(data.vat_registration_number);  
            $('#national_id').val(data.national_id); 
            $('#address_1').val(data.address_1);  
            $('#address_2').val(data.address_2);  
            $('#contact_person_1').val(data.contact_person_1);  
            $('#contact_person_2').val(data.contact_person_2); 
            $('#contact_number_1').val(data.contact_number_1); 
            $('#contact_number_2').val(data.contact_number_2);  
            $('#email_address').val(data.email_address);  
            $('#web_address').val(data.web_address);  
            $('#mobile_wallet_number').val(data.mobile_wallet_number); 
            $('#erc_number').val(data.erc_number);
            $('#status').val(data.status);  
            if (data.organization_logo) {
                $('#logoPreview').remove();  
                $('#organization_logo').after(`<img src="{{ asset('') }}${data.organization_logo}" alt="Organization Logo" width="150" height="150" id="logoPreview">`);
            }
            $('#createModal').modal('show');  // Show the modal

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
                    url: `{{ url('customer_inquiry') }}/${id}`,
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
        var newWin = window.open("", "_blank");
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