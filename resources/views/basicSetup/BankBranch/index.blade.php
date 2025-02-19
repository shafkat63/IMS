@extends('layout.app')
@section('main')

<h4 class="py-3 mb-2">Bank Branch</h4>

<nav class="navbar navbar-example navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="javascript:void(0)"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-3">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-ex-3">
            <div class="navbar-nav me-auto">
                <a class="nav-item nav-link active" href="javascript:void(0)">Bank Branch Setup</a>
            </div>
            @can('create_bank_branches')
            <form onsubmit="return false">
                <button class="btn btn-outline-success" onclick="showModal()" type="button">Add New</button>
            </form>
            @endcan
        </div>
    </div>
</nav>

<div class="card">
    <h5 class="card-header">Bank Branch Table</h5>
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

        <table class="table" id="dataInfo-dataTable">
            <thead class="table-light">
                <tr>
                    <th>SL</th>
                    <th>Bank Name</th>
                    <th>Routing Number</th>
                    <th>SWIFT Code</th>
                    <th>Branch Name</th>
                    <th>Contact Person Name </th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="createBankBranchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-dialog-centered modal-add-new-bank-branch">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-header">
                <h4 class="modal-title bank-title">Add New Bank Branch</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="bank-title">Add New Bank Branch</h3>
                    <p>Enter bank branch details</p>
                </div>
                <!-- Add bank branch form -->
                <form id="createBankBranchForm" class="row g-3" onsubmit="return false">@csrf
                    <div class="row">
                    <input type="hidden" id="id" name="id" class="form-control" />

                    <div class="col-12 mb-4">
                        <label class="form-label" for="bankName">Bank Name</label>
                        <select id="bankName" name="bank_name" class="form-select">
                            <option value="">Select Bank</option> <!-- Placeholder -->
                        </select>
                    </div>
                    <div class="col-12 mb-4">
                        <label class="form-label" for="routingNumber">Routing Number</label>
                        <input type="text" id="routingNumber" name="routing_number" class="form-control"
                            placeholder="Example: 123456789" />
                    </div>
                    <div class="col-12 mb-4">
                        <label class="form-label" for="swiftCode">SWIFT Code</label>
                        <input type="text" id="swiftCode" name="swift_code" class="form-control"
                            placeholder="Example: ABCDUS33" />
                    </div>
                    <div class="col-12 mb-4">
                        <label class="form-label" for="branchName">Branch Name</label>
                        <input type="text" id="branchName" name="branch_name" class="form-control"
                            placeholder="Example: Dhaka Branch" />
                    </div>
                    <div class="col-12 mb-4">
                        <label class="form-label" for="contact_person_name">Contact Person Name</label>
                        <input type="text" id="contact_person_name" name="contact_person_name" class="form-control"
                            placeholder="Example: +8801234567890" />
                    </div>
                    <div class="col-12 mb-4">
                        <label class="form-label" for="contactNumber">Contact Number</label>
                        <input type="text" id="contactNumber" name="contact_number" class="form-control"
                            placeholder="Example: +8801234567890" />
                    </div>
                    <div class="col-12 mb-4">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control"
                            placeholder="Example:example@gamil.com" />
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
                            onclick="saveBankBranch()">Submit</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
                </div>
                </form>
                <!--/ Add bank branch form -->
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    var table1 = $('#dataInfo-dataTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        ajax: '{!! route('all.bank_branches') !!}',
        columns: [
            { 
                data: 'id', 
                name: 'serial_number', 
                render: function (data, type, row, meta) {
                    return meta.row + 1;
                },
                orderable: false, 
                searchable: false
            },            {data: 'bank_name', name: 'bank_name'},
            {data: 'routing_number', name: 'routing_number'},
            {data: 'swift_code', name: 'swift_code'},
            {data: 'branch_name', name: 'branch_name'},
            {data: 'contact_person_name', name: 'contact_person_name'},
            {data: 'contact_number', name: 'contact_number'},
            {data: 'email', name: 'email'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    function showModal(){
        $('.bank-title').text('Add Bank Branch'); 

        $('#createBankBranchModal').modal('show');
    }


    $(document).ready(function() {
    $.ajax({
        url: "{{ url('/getbankdata') }}", 
        type: 'GET',
        success: function(response) {
            var bankSelect = $('#bankName');
            bankSelect.empty();
            bankSelect.append('<option value="">Select Bank</option>');
            response.data.forEach(function(bank) {
                bankSelect.append('<option value="' + bank.id + '">' + bank.bank_name + '</option>');
            });
        },
        error: function(xhr) {
            swal({ title: "Oops", text: xhr.responseJSON?.message || xhr.responseText, icon: "error", timer: 1500 });
        }
    });
    });

    function saveBankBranch() {
        let url = "{{ url('bank_branches') }}";
        let formData = new FormData($("#createBankBranchForm")[0]);
        let submitButton = $('#createBankBranchForm button[type="submit"]');

    // Disable the submit button to prevent multiple submissions
    submitButton.prop('disabled', true);

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.statusCode === 200) {
                    $('#createBankBranchModal').modal('hide');
                    $('#dataInfo-dataTable').DataTable().ajax.reload();
                    swal("Success", response.statusMsg, "success");
                    $('#createBankBranchForm')[0].reset();
                } else {
                    swal("Error", response.statusMsg || "An unknown error occurred.", "error");
                }
            },
            error: function (xhr) {
                let errorMessage = xhr.responseJSON?.message || xhr.responseText || "Error occurred";
                swal({ title: "Oops", text: errorMessage, icon: "error", timer: 1500 });
            },
                complete: function () {
                    // Re-enable the submit button after the request is complete
                    submitButton.prop('disabled', false);
                }
        });
        return false;
    }

    function showData(id) {
        $.ajax({
            url: "{{ url('bank_branches') }}/" + id, 
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#createBankBranchForm')[0].reset(); 
                $('.bank-title').text('Update Bank Branch'); 
                $('#createBankBranchModal').modal('show');

                $('#id').val(data.id);
                $('#bankName').val(data.bank_name);
                $('#routingNumber').val(data.routing_number);
                $('#swiftCode').val(data.swift_code);
                $('#branchName').val(data.branch_name);
                $('#contact_person_name').val(data.contact_person_name);
                $('#contactNumber').val(data.contact_number);
                $('#email').val(data.email);
                $('#status').val(data.status);
            },
            error: function (xhr) {
                swal({ title: "Oops", text: xhr.responseJSON?.message || xhr.responseText, icon: "error", timer: 1500 });
            },
        });
    }

    function deleteData(id) {
        var csrf_token = $('meta[name="csrf-token"]').attr('content');

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this record!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "{{ url('bank_branches') }}/" + id, 
                    type: "POST",
                    data: { '_method': 'DELETE', '_token': csrf_token },
                    success: function (response) {
                        $('#dataInfo-dataTable').DataTable().ajax.reload();
                        swal("Delete Done", "The record has been deleted!", "success");
                    },
                    error: function (xhr) {
                        swal({ title: "Oops", text: xhr.responseJSON?.statusMsg || xhr.responseText, icon: "error", timer: 1500 });
                    }
                });
            }
        });
    }
</script>
<script>
    $(document).ready(function () {
    let table = $("#dataInfo-dataTable");
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
        var printContents = document.getElementById("dataInfo-dataTable").outerHTML;
        
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