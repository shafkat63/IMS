<?php

namespace App\Http\Controllers\AllRegularEntry;

use App\Http\Controllers\Controller;
use App\Models\AllRegularEntry\CustomerInquiry;
use App\Models\BasicSetup\Country;
use App\Models\BasicSetup\Currency;
use App\Models\BasicSetup\Customers;
use App\Models\BasicSetup\Manufacturer;
use App\Models\BasicSetup\Products;
use App\Models\BasicSetup\ShipmentMode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class CustomerInquiryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:delete_customer_inquiry', ['only' => ['destroy']]);
        $this->middleware('permission:view_customer_inquiry', ['only' => ['index']]);
        $this->middleware('permission:update_customer_inquiry', ['only' => ['show', 'store']]);
        $this->middleware('permission:create_customer_inquiry', ['only' => ['create','store']]);
    }
    /**
     * Display a listing of the resource.
     */

   
    public function index()
    {
        return view("regularEntry.CustomerInquiry.index");
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("regularEntry.CustomerInquiry.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'inquiry_date' => 'required|date',
            'customer_id' => 'required',
            'inquiry_account_manager' => 'nullable|string',
            'shipment_mode_id' => 'required',
            'expected_arrival_date' => 'nullable|date',
            'payment_term' => 'nullable|string',
            'inquiry_validity' => 'nullable|integer',
            'remarks' => 'nullable|string',
            'sample_needed' => 'required|boolean',
            'status' => 'required|string|in:active,inactive',
            'product_name.*' => 'required|integer|exists:products,id',
            'color.*' => 'nullable|integer|exists:colors,id',
            'import_country_hs_code.*' => 'nullable|string',
            'export_country_hs_code.*' => 'nullable|string',
            'item_spec.*' => 'nullable|string',
            'mode_of_unit_id.*' => 'nullable',
            'manufacturer.*' => 'nullable',
            'country_of_origin.*' => 'nullable',
            'packing_size.*' => 'nullable|string',
            'currency_id.*' => 'nullable',
            'item_quantity.*' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            // Store Inquiry
            $inquiry = DB::table('customer_inquiries')->insertGetId([
                'inquiry_date' => $request->inquiry_date,
                'system_generated_inquiry_number' => Str::upper(Str::random(10)),
                'customer_id' => $request->customer_id,
                'inquiry_account_manager' => $request->inquiry_account_manager,
                'shipment_mode_id' => $request->shipment_mode_id,
                'expected_arrival_date' => $request->expected_arrival_date,
                'payment_term' => $request->payment_term,
                'inquiry_validity' => $request->inquiry_validity,
                'remarks' => $request->remarks,
                'sample_needed' => $request->sample_needed,
                'status' => "active",
                'create_by' => auth()->id(),
                'create_date' => now(),
            ]);

            // Store Product Details
            foreach ($request->product_name as $key => $product) {

                DB::table('customer_inquiry_details')->insert([
                    'inquiry_id' => $inquiry,
                    'product_name' => $product,
                    'import_country_hs_code' => $request->import_country_hs_code[$key] ?? null,
                    'export_country_hs_code' => $request->export_country_hs_code[$key] ?? null,
                    'item_spec' => $request->item_spec[$key] ?? null,
                    'mode_of_unit_id' => $request->mode_of_unit_id[$key] ?? null,
                    'manufacturer' => $request->manufacturer[$key] ?? null,
                    'country_of_origin' => $request->country_of_origin[$key] ?? null,
                    'packing_size' => $request->packing_size[$key] ?? null,
                    'currency_id' => $request->currency_id[$key] ?? null,
                    'item_quantity' => $request->item_quantity[$key],
                    'create_by' => auth()->id(),
                    'create_date' => now(),
                ]);
            }

            DB::commit();
            return response()->json(['statusCode' => 200, 'statusMsg' => 'Inquiry created successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }



    public function show(string $id)
    {
        $inquiry = DB::select("
            SELECT 
                ci.id,
                ci.inquiry_date,
                ci.system_generated_inquiry_number,
                c.name AS customer_name,
                sm.name AS shipment_mode_name,
                ci.inquiry_account_manager,
                ci.expected_arrival_date,
                ci.payment_term,
                ci.inquiry_validity,
                ci.remarks,
                ci.authorization_status,
                ci.sample_needed,
                ci.status
            FROM customer_inquiries ci
            LEFT JOIN customers c ON ci.customer_id = c.id
            LEFT JOIN shipment_mode sm ON ci.shipment_mode_id = sm.id
            WHERE ci.id = ?
        ", [$id]);
        $customerInquiryNumber = $inquiry[0]->id ?? null;

        $inquiry_details = DB::select("
            SELECT 
                p.product_name,
                cid.import_country_hs_code,
                cid.export_country_hs_code,
                cid.item_spec,
                m.name AS manufacturer_name,
                co.name AS country_of_origin_name,
                cid.packing_size,
                cid.item_quantity,
                cid.status
            FROM customer_inquiry_details cid
            LEFT JOIN manufacturer m ON cid.manufacturer = m.id
            LEFT JOIN products p ON cid.product_name = p.id
            LEFT JOIN countries co ON cid.country_of_origin = co.id
            WHERE cid.inquiry_id = ?
        ", [$customerInquiryNumber]);

        $inquiry = $inquiry ? (object) $inquiry[0] : null;

        return view("regularEntry.CustomerInquiry.show", [
            'inquiry' => $inquiry,
            'details' => $inquiry_details
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $CustomerInquiry = CustomerInquiry::findOrFail($id);
        return view("regularEntry.CustomerInquiry.edit", compact("CustomerInquiry"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $CustomerInquiry = CustomerInquiry::findOrFail($id);

            $CustomerInquiry->details()->delete();

            $CustomerInquiry->delete();

            return response()->json([
                "statusCode" => 200,
                "statusMsg" => "Customer Inquiry record deleted successfully."
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                "statusCode" => 404,
                "statusMsg" => "Customer Inquiry record not found."
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ], 400);
        }
    }
    public function getCustomerInquiryData()
    {
        $rawData = DB::select("SELECT 
            i.id,
            i.inquiry_date,
            i.system_generated_inquiry_number,
            c.name AS customer_name,
            i.inquiry_account_manager,
            sm.name AS shipment_mode,
            i.expected_arrival_date,
            i.payment_term,
            i.inquiry_validity,
            i.remarks,
            i.authorization_status,
            i.sample_needed,
            i.status
        FROM customer_inquiries AS i
        LEFT JOIN customers AS c ON i.customer_id = c.id
        LEFT JOIN shipment_mode AS sm ON i.shipment_mode_id = sm.id");

        return DataTables::of($rawData)

            ->addColumn('action', function ($rawData) {
                $buttons = '';

                if (auth()->user()->can('update_customer_inquiry')) {
                    $buttons .= '
                <a onclick="showData(' . $rawData->id . ')" role="button" href="#" class="btn btn-success btn-sm">
                    <i class="bx bx-edit-alt"></i>
                </a>
            ';
                }
                $buttons .= '    <a href="' . url('customer_inquiry/' . $rawData->id) . '" class="btn btn-info btn-sm">View</a>';

                if (auth()->user()->can('delete_customer_inquiry')) {
                    $buttons .= '
                <a onclick="deleteData(' . $rawData->id . ')" role="button" href="#" class="btn btn-danger btn-sm">
                    <i class="bx bx-trash"></i>
                </a>
            ';
                }

                return '
            <div class="button-list">
                ' . $buttons . '
            </div>
        ';
            })



            ->rawColumns(['action'])
            ->toJson();
    }

    public function getCustomerData(Request $request)
    {
        $getCustomersData = Customers::select('id', 'name')->get();

        return response()->json([
            'data' => $getCustomersData
        ]);
    }
    public function getShipmentmodeData(Request $request)
    {
        $getShipmentModeData = ShipmentMode::select('id', 'name')->get();

        return response()->json([
            'data' => $getShipmentModeData
        ]);
    }
    public function getProductnameData(Request $request)
    {
        $search = $request->input('q'); // 'q' is the default parameter sent by Select2 for search

        $query = Products::select('id', 'product_name', 'mode_of_unit', 'import_hs_code', 'export_hs_code');
        if ($search) {
            $query->where('product_name', 'LIKE', "%{$search}%");
        }

        $getProductData = $query->get();

        return response()->json([
            'data' => $getProductData
        ]);
    }
    public function getColorforcustomerInquiryData(Request $request)
    {
        $productId = $request->input('product_id');

        if (!$productId) {
            return response()->json([
                'data' => [],
                'message' => 'No product ID provided.'
            ]);
        }

        $Colors = DB::table('product_details as pd')
            ->join('colors as c', 'pd.color', '=', 'c.id')
            ->select('c.id', 'c.name')
            ->where('pd.product_id', $productId)
            ->distinct()
            ->get();

        return response()->json([
            'data' => $Colors
        ]);
    }


    // public function getColorforcustomerInquirySpec(Request $request)
    // {
    //     $productId = "";
    //     $colorId = "";
    //     $Spec =  DB::table('product_details as pd')
    //         ->join('colors as c', 'pd.color', '=', 'c.id')
    //         ->select('c.id', 'c.name')
    //         ->where('pd.product_id', $productId)
    //         ->where('pd.color', $colorId)
    //         ->get();
    //     return response()->json([
    //         'data' => $Spec
    //     ]);
    // }



    public function getColorforcustomerInquirySpec(Request $request)
    {
        $productId = $request->input('product_id'); // Get the selected product ID
        $colorId = $request->input('color_id'); // Get the selected color ID

        if (!$productId || !$colorId) {
            return response()->json([
                'data' => [],
                'message' => 'Product ID or Color ID is missing.'
            ]);
        }

        $Spec = DB::table('product_details as pd')
            ->join('colors as c', 'pd.color', '=', 'c.id')
            ->select('pd.spec') // Assuming there's a specification field
            ->where('pd.product_id', $productId)
            ->where('pd.color', $colorId)
            ->first();

        return response()->json([
            'data' => $Spec
        ]);
    }

    public function getManufacturers(Request $request)
    {
        $Manufacturer = Manufacturer::select('id', 'name', 'country_id')->get();
        return response()->json([
            'data' => $Manufacturer
        ]);
    }
    public function getCountryData(Request $request)
    {
        $Country = Country::select('id', 'name')->get();
        return response()->json([
            'data' => $Country
        ]);
    }
    public function getCurrencyData(Request $request)
    {
        $Currency = Currency::select('id', 'name')->get();
        return response()->json([
            'data' => $Currency
        ]);
    }
}
