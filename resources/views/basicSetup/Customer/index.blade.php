@extends('layout.app')
@section('main')

<h4 class="py-3 mb-2">Customer</h4>

<nav class="navbar navbar-example navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="javascript:void(0)"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-3">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-ex-3">
            <div class="navbar-nav me-auto">
                <a class="nav-item nav-link active" href="javascript:void(0)">Customer Setup</a>
            </div>
            @can('create_customers')

            <form onsubmit="return false">
                <button class="btn btn-outline-success" onclick="showModal()" type="button">Add New</button>
            </form>
            @endcan
        </div>
    </div>
</nav>

<div class="card">
    <h5 class="card-header">Customer Table</h5>


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
                    <th>Country Name</th>
                    <th>Address</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                    <th>BIN Number</th>
                    <th>TIN Number</th>
                    <th>VAT Registration Number</th>
                    <th>National ID</th>
                    <th>IRC Number</th>
                    <th>Remarks</th>
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
                    <h4 class="modal-title title">Add New Customer</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createForm" class="row g-3" onsubmit="return false">@csrf
                    <div class="col-6 mb-4">
                        <input type="hidden" id="id" name="id" class="form-control" />
                    </div>
                    <div class="row">

                        <div class="col-6 mb-4">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Mr. David" />
                        </div>

                        <div class="col-6 mb-4">
                            <label class="form-label" for="country_name">Country Name</label>
                            <select id="country_name" name="country_name" class="form-select">
                                <option value="">Select Country</option>
                            </select>
                        </div>


                        <div class="col-6 mb-4">
                            <label class="form-label" for="address">Address</label>
                            <input type="text" id="address" name="address" class="form-control"
                                placeholder="Baridhara DOHS" />
                        </div>

                        <div class="col-6 mb-4">
                            <label class="form-label" for="mobile_number">Mobile Number</label>
                            <input type="text" id="mobile_number" name="mobile_number" class="form-control"
                                placeholder="+88017XXXXXXXX" />
                        </div>

                        <div class="col-6 mb-4">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="abc@gmail.com" />
                        </div>

                        <div class="col-6 mb-4">
                            <label class="form-label" for="bin_number">BIN Number</label>
                            <input type="text" id="bin_number" name="bin_number" class="form-control"
                                placeholder="2547-564XXXXXXXX" />
                        </div>

                        <div class="col-6 mb-4">
                            <label class="form-label" for="tin_number">TIN Number</label>
                            <input type="text" id="tin_number" name="tin_number" class="form-control"
                                placeholder="8965-545XXXXXXXX" />
                        </div>

                        <div class="col-6 mb-4">
                            <label class="form-label" for="vat_registration_number">VAT Registration Number</label>
                            <input type="text" id="vat_registration_number" name="vat_registration_number"
                                class="form-control" placeholder="4698-5454XXXXXXXX" />
                        </div>

                        <div class="col-6 mb-4">
                            <label class="form-label" for="national_id">National ID</label>
                            <input type="text" id="national_id" name="national_id" class="form-control"
                                placeholder="5552091160" />
                        </div>

                        <div class="col-6 mb-4">
                            <label class="form-label" for="irc_number">IRC Number</label>
                            <input type="text" id="irc_number" name="irc_number" class="form-control"
                                placeholder="5552091160" />
                        </div>

                        <div class="col-12 mb-4">
                            <label class="form-label" for="remarks">Remarks</label>
                            <textarea id="remarks" name="remarks" class="form-control"
                                placeholder="Enter additional data here" rows="4"></textarea>
                        </div>


                        <div class="col-6 mb-4">
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
        ajax: '{!! route('all.customers') !!}', 
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
            { data: 'name', name: 'name', title: 'Customer Name' , render: wrapText },
            { data: 'countries', name: 'countries', title: 'Country Name'  , render: wrapText  },
            { data: 'address', name: 'address', title: 'Address'  , render: wrapText  },
            { data: 'mobile_number', name: 'mobile_number', title: 'Mobile Number'  , render: wrapText  },
            { data: 'email', name: 'email', title: 'Email'  , render: wrapText },
            { data: 'bin_number', name: 'bin_number', title: 'BIN Number'   , render: wrapText },
            { data: 'tin_number', name: 'tin_number', title: 'TIN Number'  , render: wrapText },
            { data: 'vat_registration_number', name: 'vat_registration_number', title: 'VAT Registration Number'  , render: wrapText },
            { data: 'national_id', name: 'national_id', title: 'National ID'  , render: wrapText },
            { data: 'irc_number', name: 'irc_number', title: 'IRC Number' , render: wrapText },
            { data: 'remarks', name: 'remarks', title: 'Remarks'  , render: wrapText },
            { data: 'status', name: 'status', title: 'Status'  , render: wrapText  },
            { data: 'action', name: 'action', orderable: false, searchable: false, title: 'Actions' }
        ],

        
    });


    $(document).ready(function() {
    $.ajax({
        url: "{{ url('/getcountrydata') }}", 
        type: 'GET',
        success: function(response) {
            console.log(response);
            
            var country = $('#country_name');
            country.empty();
            country.append('<option value="">Select Country</option>');
            response.data.forEach(function(countryt) {
                country.append('<option value="' + countryt.id + '">' + countryt.name + '</option>');
            });
        },
        error: function(xhr) {
            swal({ title: "Oops", text: xhr.responseJSON?.message || xhr.responseText, icon: "error", timer: 1500 });
        }
    });
    });

    function showModal() {
        $('.title').text('Add Customer'); 
        $('#createForm')[0].reset();  
        $('#id').val(''); 
        $('#createModal').modal('show');
    }


    function wrapText(data) {
    if (!data) return ''; 
    let words = data.split(" ");
    let lines = [];
    
    for (let i = 0; i < words.length; i += 5) {
        lines.push(words.slice(i, i + 5).join(" "));
    }
    
    return lines.join("<br>");
}


    function save() {
        let url = "{{ url('customers') }}"; 
        let formData = new FormData($("#createForm")[0]);  
        let submitButton = $('#createForm button[type="submit"]');

        submitButton.prop('disabled', true);

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
            },
           complete: function () {
            submitButton.prop('disabled', false);
        }
        });

        return false;
    }

    function showData(id) {
    // Show loading indicator
    swal({ title: "Loading...", text: "Fetching data...", icon: "info", buttons: false, timer: 1500 });

    $.ajax({
        url: `{{ url('customers') }}/${id}`,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            if (data) {
                $('#createForm')[0].reset(); 
                $('.title').text('Update Customer'); 

                // Fill form fields with retrieved data
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#country_name').val(data.country_name).trigger('change');
                $('#address').val(data.address);
                $('#mobile_number').val(data.mobile_number);
                $('#email').val(data.email);
                $('#bin_number').val(data.bin_number);
                $('#tin_number').val(data.tin_number);
                $('#vat_registration_number').val(data.vat_registration_number);
                $('#national_id').val(data.national_id);
                $('#irc_number').val(data.irc_number);
                $('#remarks').val(data.remarks);
                $('#status').val(data.status);

                $('#createModal').modal('show');
            } else {
                swal({ title: "Oops", text: "No data found", icon: "warning", timer: 2000 });
            }
        },
        error: function (xhr) {
            let errorMessage = "Error occurred while fetching data.";
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            }
            swal({ title: "Oops", text: errorMessage, icon: "error", timer: 2000 });
        }
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
                    url: `{{ url('customers') }}/${id}`,
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