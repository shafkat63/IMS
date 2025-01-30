<?php

namespace App\Http\Controllers\BasicSetup;

use App\Http\Controllers\Controller;
use App\Models\BasicSetup\PaymentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PaymentStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("basicSetup.PaymentStatus.index");
    }
    // public function getCountryData(Request $request)
    // {
    //     $getCountryData = Country::select('id', 'name')->get();

    //     return response()->json([
    //         'data' => $getCountryData
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'paymentstatus' => 'required|string|max:255',
                'status' => 'required',
            ]);

            if ($request['id'] == !null) {
                $shipment_mode = DB::table('shipment_mode')->where('id', $request['id'])->first();

                if (!$shipment_mode) {
                    return response()->json([
                        "statusCode" => 404,
                        "statusMsg" => "payment status mode not found"
                    ], 404);
                }

                DB::table('payment_status')
                    ->where('id', $request['id'])
                    ->update([
                        'name' => $validatedData['paymentstatus'],
                        'status' => $validatedData['status'],
                        'update_by' => auth()->user()->id,
                        'update_date' => now()
                    ]);

                return response()->json([
                    "statusCode" => 200,
                    "statusMsg" => "Shipment details updated successfully"
                ], 200);
            } else {
                $PaymentStatus = new PaymentStatus();
                $PaymentStatus->name = $validatedData['paymentstatus'];
                $PaymentStatus->status = $validatedData['status'];
                $PaymentStatus->create_by = auth()->id();
                $PaymentStatus->create_Date = now();
                $PaymentStatus->save();

                return response()->json([
                    'statusCode' => 200,
                    'statusMsg' => 'Payment Status  added successfully!',
                    'data' => $PaymentStatus,
                ]);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                "statusCode" => 422,
                "statusMsg" => $e->getMessage(),
                "errors" => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'statusCode' => 500,
                'statusMsg' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $payment_status = DB::table('payment_status')->where('id', $id)->first();
            if (!$payment_status) {
                return response()->json([
                    "statusCode" => 404,
                    "statusMsg" => "Payment status  not found"
                ], 404);
            }
            return response()->json($payment_status, 200);
        } catch (\Exception $e) {
            return response()->json([
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy($id)
    {
        try {
            $PaymentStatus = PaymentStatus::findOrFail($id);

            $PaymentStatus->delete();

            return response()->json([
                "statusCode" => 200,
                "statusMsg" => "Payment Status record deleted successfully."
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                "statusCode" => 404,
                "statusMsg" => "Payment Status record not found."
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ], 400);
        }
    }
    public function getPaymentStatusesData()
    {
        $rawData = DB::select("SELECT id,name, status FROM payment_status");


        return DataTables::of($rawData)
            ->addColumn('action', function ($rawData) {
                $buttton = '
                <div class="button-list">
                    <a onclick="showData(' . $rawData->id . ')" role="button" href="#" class="btn btn-success btn-sm">Edit</a>
                    <a onclick="deleteData(' . $rawData->id . ')" role="button" href="#" class="btn btn-danger btn-sm">Delete</a>
                </div>
                ';
                return $buttton;
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
