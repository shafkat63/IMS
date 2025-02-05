<?php

namespace App\Http\Controllers\BasicSetup;

use App\Http\Controllers\Controller;
use App\Models\BasicSetup\Country;
use App\Models\BasicSetup\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("basicSetup.Manufacturer.index");
    }
    public function getCountryData(Request $request)
    {
        $getCountryData = Country::select('id', 'name')->get();

        return response()->json([
            'data' => $getCountryData
        ]);
    }

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
                'manufacturer' => 'required|string|max:255',
                'country' => 'required',
                'status' => 'required',
            ]);

            if ($request['id'] == !null) {
                $manufacturer = DB::table('manufacturer')->where('id', $request['id'])->first();

                if (!$manufacturer) {
                    return response()->json([
                        "statusCode" => 404,
                        "statusMsg" => "Product Sub Category not found"
                    ], 404);
                }

                // Perform the update
                DB::table('manufacturer')
                    ->where('id', $request['id'])
                    ->update([
                        'name' => $validatedData['manufacturer'],
                        'country_id' => $validatedData['country'],
                        'status' => $validatedData['status'],
                        'update_by' => auth()->user()->id,
                        'update_date' => now()
                    ]);

                return response()->json([
                    "statusCode" => 200,
                    "statusMsg" => "Product Sub Category details updated successfully"
                ], 200);
            } else {
                // Create new bank record
                $manufacturer = new Manufacturer();
                $manufacturer->name = $validatedData['manufacturer'];
                $manufacturer->country_id = $validatedData['country'];
                $manufacturer->status = $validatedData['status'];
                $manufacturer->create_by = auth()->id();
                $manufacturer->create_Date = now();
                $manufacturer->save();

                return response()->json([
                    'statusCode' => 200,
                    'statusMsg' => 'Product Sub Category added successfully!',
                    'data' => $manufacturer,
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
            $manufacturer = DB::table('manufacturer')->where('id', $id)->first();
            if (!$manufacturer) {
                return response()->json([
                    "statusCode" => 404,
                    "statusMsg" => "Manufacturer not found"
                ], 404);
            }
            return response()->json($manufacturer, 200);
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
            // Find the bank record by ID
            $Manufacturer = Manufacturer::findOrFail($id);

            // Delete the bank record
            $Manufacturer->delete();

            // Return a successful JSON response
            return response()->json([
                "statusCode" => 200,
                "statusMsg" => "Manufacturer record deleted successfully."
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle case where the record was not found
            return response()->json([
                "statusCode" => 404,
                "statusMsg" => "Manufacturer record not found."
            ], 404);
        } catch (\Exception $e) {
            // Handle general exceptions
            return response()->json([
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ], 400);
        }
    }
    public function getManufacturersData()
    {
        $rawData = DB::select("SELECT 
            psc.id, 
            psc.name, 
            ps.name AS countries, 
            psc.status
        FROM manufacturer psc
        JOIN countries ps ON psc.country_id = ps.id ");


        return DataTables::of($rawData)
            ->addColumn('action', function ($rawData) {
                $buttton = '
                <div class="button-list">
                    <a onclick="showData(' . $rawData->id . ')" role="button" href="#" class="btn btn-success btn-sm"><i class="bx bx-edit-alt"></i></a>
                    <a onclick="deleteData(' . $rawData->id . ')" role="button" href="#" class="btn btn-danger btn-sm"><i class="bx bx-trash" ></i></a>
                </div>
                ';
                return $buttton;
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
