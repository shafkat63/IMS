<?php

namespace App\Http\Controllers\BasicSetup;

use App\Http\Controllers\Controller;
use App\Models\BasicSetup\ModeOfUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ModeOfUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("basicSetup.ModeOfUnit.index");
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
                'unit_name' => 'required',
                'status' => 'required',
            ]);

            // Check if we are updating or creating a new bank
            if ($request['id'] == !null) {
                // Update existing bank record
                $mode_of_units = DB::table('mode_of_units')->where('id', $request['id'])->first();

                if (!$mode_of_units) {
                    return response()->json([
                        "statusCode" => 404,
                        "statusMsg" => "Bank not found"
                    ], 404);
                }

                // Perform the update
                DB::table('mode_of_units')
                    ->where('id', $request['id'])
                    ->update([
                        'unit_name' => $validatedData['unit_name'],
                        'status' => $validatedData['status'],
                        'update_by' => auth()->user()->id,
                        'update_date' => now()
                    ]);

                return response()->json([
                    "statusCode" => 200,
                    "statusMsg" => "Bank details updated successfully"
                ], 200);
            } else {
                // Create new bank record
                $ModeOfUnit = new ModeOfUnit();
                $ModeOfUnit->unit_name = $validatedData['unit_name'];
                $ModeOfUnit->status = $validatedData['status'];
                $ModeOfUnit->create_by = auth()->id();
                $ModeOfUnit->create_date = now();
                $ModeOfUnit->save();

                return response()->json([
                    'statusCode' => 200,
                    'statusMsg' => 'Bank added successfully!',
                    'data' => $ModeOfUnit,
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
            $mode_of_units = DB::table('mode_of_units')->where('id', $id)->first();
            if (!$mode_of_units) {
                return response()->json([
                    "statusCode" => 404,
                    "statusMsg" => "Mode Of Units not found"
                ], 404);
            }
            return response()->json($mode_of_units, 200);
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
            $mode_of_unit = ModeOfUnit::findOrFail($id);

            // Delete the bank record
            $mode_of_unit->delete();

            // Return a successful JSON response
            return response()->json([
                "statusCode" => 200,
                "statusMsg" => "Bank record deleted successfully."
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle case where the record was not found
            return response()->json([
                "statusCode" => 404,
                "statusMsg" => "Bank record not found."
            ], 404);
        } catch (\Exception $e) {
            // Handle general exceptions
            return response()->json([
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ], 400);
        }
    }


    public function getModeOfUnitData()
    {

        $rawData = DB::select("SELECT id,unit_name,status
        FROM mode_of_units;");

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
