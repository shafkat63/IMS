<?php

namespace App\Http\Controllers\AllRegularEntry;

use App\Http\Controllers\Controller;
use App\Models\AllRegularEntry\CustomerInquiry;
use App\Models\AllRegularEntry\CustomerInquiryDetails;
use App\Models\AllRegularEntry\SupplierInquiry;
use App\Models\BasicSetup\Country;
use App\Models\BasicSetup\Currency;
use App\Models\BasicSetup\Customers;
use App\Models\BasicSetup\Manufacturer;
use App\Models\BasicSetup\Products;
use App\Models\BasicSetup\ShipmentMode;
use App\Models\BasicSetup\Suppliers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class InquiryToSupplierController extends Controller
{
    public function __construct()
    {
        $type = 'inquiry_to_supplier';
        $this->middleware('permission:delete_' . $type, ['only' => ['destroy']]);
        $this->middleware('permission:view_' . $type, ['only' => ['index']]);
        $this->middleware('permission:update_' . $type, ['only' => ['show', 'store']]);
        $this->middleware('permission:create_' . $type, ['only' => ['create', 'store']]);
    }
    public function index()
    {
        return view("regularEntry.InquiryToSupplier.index");
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("regularEntry.InquiryToSupplier.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         // 'inquiry_date' => 'required|date',
    //         // 'system_generated_inquiry_number' => 'nullable|string|',
    //         'customer_id' => 'required',
    //         'inquiry_account_manager' => 'nullable|string',
    //         'shipment_mode_id' => 'required',
    //         'expected_arrival_date' => 'nullable|date',
    //         'payment_term' => 'nullable|string',
    //         'inquiry_validity' => 'nullable|integer',
    //         'remarks' => 'nullable|string',
    //         'sample_needed' => 'required|boolean',
    //         'status' => 'required|string|in:active,inactive',
    //         'product_name.*' => 'required|integer|exists:products,id',
    //         'color.*' => 'nullable|integer|exists:colors,id',
    //         'import_country_hs_code.*' => 'nullable|string',
    //         'export_country_hs_code.*' => 'nullable|string',
    //         'item_spec.*' => 'nullable|string',
    //         'mode_of_unit_id.*' => 'nullable',
    //         'manufacturer.*' => 'nullable',
    //         'country_of_origin.*' => 'nullable',
    //         'packing_size.*' => 'nullable|string',
    //         'currency_id.*' => 'nullable',
    //         'item_quantity.*' => 'required|integer|min:1',
    //     ]);

    //     try {
    //         DB::beginTransaction();

    //         // Store Inquiry
    //         $inquiry = DB::table('supplier_inquiries')->insertGetId([
    //             // 'inquiry_date' => $request->inquiry_date,
    //             'system_generated_inquiry_number' => Str::upper(Str::random(10)),
    //             'customer_id' => $request->customer_id,
    //             'inquiry_account_manager' => $request->inquiry_account_manager,
    //             'shipment_mode_id' => $request->shipment_mode_id,
    //             'expected_arrival_date' => $request->expected_arrival_date,
    //             'payment_term' => $request->payment_term,
    //             'inquiry_validity' => $request->inquiry_validity,
    //             'remarks' => $request->remarks,
    //             'sample_needed' => $request->sample_needed,
    //             'status' => $request->status,
    //             'create_by' => auth()->id(),
    //             'create_date' => now(),
    //         ]);

    //         // Store Product Details
    //         foreach ($request->product_name as $key => $product) {

    //             DB::table('supplier_inquiry_details')->insert([
    //                 'inquiry_id' => $inquiry,
    //                 'product_name' => $product,
    //                 'import_country_hs_code' => $request->import_country_hs_code[$key] ?? null,
    //                 'export_country_hs_code' => $request->export_country_hs_code[$key] ?? null,
    //                 'item_spec' => $request->item_spec[$key] ?? null,
    //                 'mode_of_unit_id' => $request->mode_of_unit_id[$key] ?? null,
    //                 'manufacturer' => $request->manufacturer[$key] ?? null,
    //                 'country_of_origin' => $request->country_of_origin[$key] ?? null,
    //                 'packing_size' => $request->packing_size[$key] ?? null,
    //                 'currency_id' => $request->currency_id[$key] ?? null,
    //                 'item_quantity' => $request->item_quantity[$key],
    //                 'create_by' => auth()->id(),
    //                 'create_date' => now(),
    //             ]);
    //         }

    //         DB::commit();
    //         return response()->json(['statusCode' => 200, 'statusMsg' => 'Inquiry created successfully!']);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
    //     }
    // }


    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'supplier_id' => 'required',
            'customer_inquiry_number' => 'required',
            'expected_arrival_date' => 'required|date',
            'submission_date' => 'required|date',
            'status' => 'required',
            // 'product_name.*' => 'required',
            // 'item_quantity.*' => 'required',
            // 'image_path.*' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            DB::beginTransaction();

            // Create the main inquiry
            $inquiry = SupplierInquiry::create([
                'supplier_id' => $request->supplier_id,
                'customer_id' => $request->customer_id,
                'system_generated_inquiry_number' => Str::upper(Str::random(10)),
                'customer_inquiry_number' => $request->customer_inquiry_number,
                'shipment_mode' => $request->shipment_mode,
                'payment_term' => $request->payment_term,
                'expected_arrival_date' => $request->expected_arrival_date,
                'submission_date' => $request->submission_date,
                'inquiry_validity' => $request->inquiry_validity,
                'sample_need' => $request->sample_need,
                'status' => $request->status,
                'remarks' => $request->remarks,
                'create_by' => auth()->id(),
                'create_date' => now(),
            ]);

            // // Handle product details
            // foreach ($request->product_name as $index => $productName) {
            //     $imagePath = null;
            //     if ($request->hasFile("image_path.$index")) {
            //         $imagePath = $request->file("image_path.$index")->store('product_images', 'public');
            //     }

            //     ProductDetail::create([
            //         'inquiry_id' => $inquiry->id,
            //         'product_name' => $productName,
            //         'color' => $request->color[$index],
            //         'item_spec' => $request->item_spec[$index],
            //         'import_country_hs_code' => $request->import_country_hs_code[$index],
            //         'export_country_hs_code' => $request->export_country_hs_code[$index],
            //         'mode_of_unit_id' => $request->mode_of_unit_id[$index],
            //         'manufacturer' => $request->manufacturer[$index],
            //         'country_of_origin' => $request->country_of_origin[$index],
            //         'packing_size' => $request->packing_size[$index],
            //         'currency_id' => $request->currency_id[$index],
            //         'item_quantity' => $request->item_quantity[$index],
            //         'image_path' => $imagePath,
            //     ]);
            // }

            DB::commit();
            return response()->json(['statusCode' => 200, 'statusMsg' => 'Supplier Inquiry created successfully!']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong', 'message' => $e->getMessage()], 500);
        }
    }

    // Let me know if you want me to tweak anything or explain a specific part of the code! 🚀


    public function show(string $id)
    {
        $inquiry = DB::select("
            SELECT 
                si.id,
                si.submission_date,
                si.system_generated_inquiry_number,
                c.name AS customer_name,
                s.supplier_name AS supplier_name,
                sm.name AS shipment_mode_name,
                si.customer_inquiry_number,
                si.expected_arrival_date,
                si.payment_term,
                si.inquiry_validity,
                si.remarks,
                si.authorization_status,
                si.sample_need,
                si.status
            FROM supplier_inquiries si
            LEFT JOIN customers c ON si.customer_id = c.id
            LEFT JOIN suppliers s ON si.supplier_id = s.id
            LEFT JOIN shipment_mode sm ON si.shipment_mode = sm.id
            WHERE si.id = ?
        ", [$id]);
        $customerInquiryNumber = $inquiry[0]->customer_inquiry_number ?? null;

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

        return view("regularEntry.InquiryToSupplier.show", [
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
            $SupplierInquiry = SupplierInquiry::findOrFail($id);

            // $SupplierInquiry->details()->delete();

            $SupplierInquiry->delete();

            return response()->json([
                "statusCode" => 200,
                "statusMsg" => "Supplier Inquiry record deleted successfully."
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                "statusCode" => 404,
                "statusMsg" => "Supplier Inquiry record not found."
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ], 400);
        }
    }
    public function getInquiryToSupplierData()
    {
        $rawData = DB::select("SELECT 
            i.id,
            i.submission_date,
            i.system_generated_inquiry_number,
            s.supplier_name AS supplier_name,
            c.name AS customer_name,
            i.customer_inquiry_number,
            sm.name AS shipment_mode,
            i.expected_arrival_date,
            i.payment_term,
            i.inquiry_validity,
            i.remarks,
            i.authorization_status,
            i.sample_need,
            i.status
        FROM supplier_inquiries AS i
        LEFT JOIN suppliers AS s ON i.supplier_id = s.id
        LEFT JOIN customers AS c ON i.customer_id = c.id
        LEFT JOIN shipment_mode AS sm ON i.shipment_mode = sm.id");

        return DataTables::of($rawData)



            ->addColumn('action', function ($rawData) {
                $buttons = '';

                if (auth()->user()->can('update_inquiry_to_supplier')) {
                    $buttons .= '
           <a href="' . url('inquiry_to_supplier/' . $rawData->id . '/edit') . '" class="btn btn-success btn-sm"><i class="bx bx-edit-alt"></i></a>
        ';
                }
                $buttons .= '<a href="' . url('inquiry_to_supplier/' . $rawData->id) . '" class="btn btn-info btn-sm">View</a>';

                if (auth()->user()->can('delete_inquiry_to_supplier')) {
                    $buttons .= '
           <a onclick="deleteData(' . $rawData->id . ')" role="button" href="#" class="btn btn-danger btn-sm"><i class="bx bx-trash"></i></a>
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



    public function getSuppliers()
    {
        $suppliers = Suppliers::select('id', 'supplier_name')->get();
        return response()->json($suppliers);
    }


    public function getCustomerInquiries()
    {
        $inquiries = CustomerInquiry::select(
            'customer_inquiries.id',
            'customer_inquiries.customer_id',
            'customer_inquiries.system_generated_inquiry_number',
            'customer_inquiries.shipment_mode_id',
            'shipment_mode.name as shipment_mode_name',
            'customer_inquiries.inquiry_validity',
            'customer_inquiries.expected_arrival_date',
            'customer_inquiries.payment_term',
            'customer_inquiries.sample_needed'
        )
            ->leftJoin('shipment_mode', 'customer_inquiries.shipment_mode_id', '=', 'shipment_mode.id')
            ->get();

        return response()->json($inquiries);
    }


    public function getCustomerByInquiry($inquiryId)
    {
        $inquiry = CustomerInquiry::where('id', $inquiryId)->first();

        if ($inquiry) {
            $Customers = Customers::where('id', $inquiry->customer_id)->first();

            if ($Customers) {
                return response()->json([
                    'id' => $Customers->id,
                    'name' => $Customers->name
                ]);
            }
        }

        return response()->json(null);
    }


    public function getCustomerInquiriesDetails($inquiryId)
    {
        $CustomerInquiryDetails = CustomerInquiryDetails::where('inquiry_id', $inquiryId)->get();
        return response()->json($CustomerInquiryDetails);
    }
}
