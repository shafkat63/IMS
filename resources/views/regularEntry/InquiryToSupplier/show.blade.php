@extends('layout.app')

@section('main')
<h4 class="py-3 mb-2">Customer Inquiry Details</h4>

<div class="card">
    <div class="col-lg-3 col-sm-6 col-12 d-flex ms-auto justify-content-end">
        <button class="btn btn-sm btn-info m-4 mb-3" onclick="printTable()">Print</button>
    </div>
    <div class="card-body" id="table">
        <h3 class="card-header mt-4" >Inquiry Information</h3>

        <table class="table table-bordered" >
            <tbody>
                <tr>
                    <th>Inquiry Date</th>
                    <td>{{ $inquiry->inquiry_date ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>System Generated Inquiry Number</th>
                    <td>{{ $inquiry->system_generated_inquiry_number ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Customer Name</th>
                    <td>{{ $inquiry->customer_name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Inquiry Account Manager</th>
                    <td>{{ $inquiry->inquiry_account_manager ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Shipment Mode</th>
                    <td>{{ $inquiry->shipment_mode_name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Expected Arrival Date</th>
                    <td>{{ $inquiry->expected_arrival_date ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Payment Term</th>
                    <td>{{ $inquiry->payment_term ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Inquiry Validity</th>
                    <td>{{ $inquiry->inquiry_validity ?? 'N/A' }} days</td>
                </tr>
                <tr>
                    <th>Remarks</th>
                    <td>{{ $inquiry->remarks ?? 'No remarks' }}</td>
                </tr>
                <tr>
                    <th>Authorization Status</th>
                    <td>
                        <span class="badge {{ $inquiry->authorization_status === 'Approved' ? 'bg-success' : 'bg-warning' }}">
                            {{ ucfirst($inquiry->authorization_status) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Sample Needed</th>
                    <td>
                        <span class="badge {{ $inquiry->sample_needed ? 'bg-primary' : 'bg-secondary' }}">
                            {{ $inquiry->sample_needed ? 'Yes' : 'No' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge {{ $inquiry->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($inquiry->status) }}
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>

        <h4 class="mt-4">Customer Inquiry Details</h4>

        @if (!empty($details) && count($details) > 0)
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Product Name</th>
                        <th>Import HS Code</th>
                        <th>Export HS Code</th>
                        <th>Item Spec</th>
                        <th>Manufacturer</th>
                        <th>Country of Origin</th>
                        <th>Packing Size</th>
                        <th>Item Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $detail)
                    <tr>
                        <td>{{ $detail->product_name ?? 'N/A' }}</td>
                        <td>{{ $detail->import_country_hs_code ?? 'N/A' }}</td>
                        <td>{{ $detail->export_country_hs_code ?? 'N/A' }}</td>
                        <td>{{ $detail->item_spec ?? 'N/A' }}</td>
                        <td>{{ $detail->manufacturer_name ?? 'N/A' }}</td>
                        <td>{{ $detail->country_of_origin_name ?? 'N/A' }}</td>
                        <td>{{ $detail->packing_size ?? 'N/A' }}</td>
                        <td>{{ $detail->item_quantity ?? '0' }}</td>
                      
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-muted">No inquiry details available.</p>
        @endif

    </div>
</div>

<a href="{{ url('customer_inquiry') }}" class="btn btn-secondary mt-3">Back</a>
@endsection
@section('script')

<script>
    //For Printing 
    function printTable() {
        var printContents = document.getElementById("table").outerHTML;
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