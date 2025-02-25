<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\AllRegularEntry\SupplierInquiry;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class SupplierInquiryToCustomer extends Controller
{
    public function index()
    {
        return view('supplier.index');
    }

    public function create()
    {
        return view("supplier.create");
    }

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

        return view("supplier.show", [
            'inquiry' => $inquiry,
            'details' => $inquiry_details
        ]);
    }

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


    public function getInquiryToSupplierData()
    {
        $user = Auth::id();
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
        LEFT JOIN shipment_mode AS sm ON i.shipment_mode = sm.id
        WHERE i.create_by = ?", [$user]);

        return DataTables::of($rawData)



            ->addColumn('action', function ($rawData) {
                $buttons = '';

                if (auth()->user()->can('update_inquiry_to_supplier')) {
                    $buttons .= '
           <a href="' . url('csuplier_inquiry_to_customer/' . $rawData->id . '/edit') . '" class="btn btn-success btn-sm"><i class="bx bx-edit-alt"></i></a>
        ';
                }
                $buttons .= '<a href="' . url('csuplier_inquiry_to_customer/' . $rawData->id) . '" class="btn btn-info btn-sm">View</a>';

                if (auth()->user()->can('csuplier_inquiry_to_customer')) {
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
}
