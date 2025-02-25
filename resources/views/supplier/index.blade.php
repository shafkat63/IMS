@extends('layout.app')
@section('title', '- Inquiry to Supplier')

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
            {{-- @can('create_inquiry_to_supplier') --}}

            <form onsubmit="return false">
                <a href="{{ url('csuplier_inquiry_to_customer/create') }}" class="btn btn-outline-success">Add New</a>
            </form>
            {{-- @endcan --}}
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



@endsection

@section('script')

<script>
    var table1 = $('#DataTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        ajax: '{!! route('all.csuplier_inquiry_to_customer') !!}', 
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
            { data: 'submission_date', name: 'submission_date', title: 'submission_date' },
            { data: 'supplier_name', name: 'supplier_name', title: 'supplier_name' },
            { data: 'customer_name', name: 'customer_name', title: 'Customer Name' },
            { data: 'customer_inquiry_number', name: 'customer_inquiry_number', title: 'customer_inquiry_number' },
            { data: 'shipment_mode', name: 'shipment_mode', title: 'Shipment Mode' },
            { data: 'expected_arrival_date', name: 'expected_arrival_date', title: 'Expected Arrival Date' },
            { data: 'payment_term', name: 'payment_term', title: 'Payment Term' },
            { data: 'inquiry_validity', name: 'inquiry_validity', title: 'Inquiry Validity' },
            { data: 'remarks', name: 'remarks', title: 'Remarks' },
            { data: 'authorization_status', name: 'authorization_status', title: 'Authorization Status' },
            { data: 'sample_need', name: 'sample_need', title: 'Sample Needed' },
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
                    url: `{{ url('inquiry_to_supplier') }}/${id}`,
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