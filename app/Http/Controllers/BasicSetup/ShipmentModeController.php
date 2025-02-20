<?php

namespace App\Http\Controllers\BasicSetup;

use App\Http\Controllers\Controller;
use App\Models\BasicSetup\ShipmentMode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ShipmentModeController extends Controller
{
    public function __construct()
    {
        $type = 'shipmentmodes';
        $this->middleware('permission:delete_' . $type, ['only' => ['destroy']]);
        $this->middleware('permission:view_' . $type, ['only' => ['index']]);
        $this->middleware('permission:update_' . $type, ['only' => ['show', 'store']]);
        $this->middleware('permission:create_' . $type, ['only' => ['create', 'store']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("basicSetup.ShipmentMode.index");
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
                'shipment' => 'required|string|max:255',
                'status' => 'required',
            ]);

            if ($request['id'] == !null) {
                $shipment_mode = DB::table('shipment_mode')->where('id', $request['id'])->first();

                if (!$shipment_mode) {
                    return response()->json([
                        "statusCode" => 404,
                        "statusMsg" => "Shipment mode not found"
                    ], 404);
                }

                DB::table('shipment_mode')
                    ->where('id', $request['id'])
                    ->update([
                        'name' => $validatedData['shipment'],
                        'status' => $validatedData['status'],
                        'update_by' => auth()->user()->id,
                        'update_date' => now()
                    ]);

                return response()->json([
                    "statusCode" => 200,
                    "statusMsg" => "Shipment details updated successfully"
                ], 200);
            } else {
                $ShipmentMode = new ShipmentMode();
                $ShipmentMode->name = $validatedData['shipment'];
                $ShipmentMode->status = $validatedData['status'];
                $ShipmentMode->create_by = auth()->id();
                $ShipmentMode->create_Date = now();
                $ShipmentMode->save();

                return response()->json([
                    'statusCode' => 200,
                    'statusMsg' => 'Shipment Mode added successfully!',
                    'data' => $ShipmentMode,
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
            $shipment_mode = DB::table('shipment_mode')->where('id', $id)->first();
            if (!$shipment_mode) {
                return response()->json([
                    "statusCode" => 404,
                    "statusMsg" => "Shipment mode not found"
                ], 404);
            }
            return response()->json($shipment_mode, 200);
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $ShipmentMode = ShipmentMode::findOrFail($id);

            $ShipmentMode->delete();

            return response()->json([
                "statusCode" => 200,
                "statusMsg" => "Shipment Mode record deleted successfully."
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                "statusCode" => 404,
                "statusMsg" => "Shipment Mode record not found."
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ], 400);
        }
    }
    public function getShipmentmodesData()
    {
        $rawData = DB::select("SELECT id,name, status FROM shipment_mode");


        return DataTables::of($rawData)
            ->addColumn('action', function ($rawData) {
                $buttons = '';

                if (auth()->user()->can('update_shipmentmodes')) {
                    $buttons .= '
                    <a onclick="showData(' . $rawData->id . ')" role="button" href="#" class="btn btn-success btn-sm">
                        <i class="bx bx-edit-alt"></i>
                    </a>
                ';
                }

                if (auth()->user()->can('delete_shipmentmodes')) {
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
}
