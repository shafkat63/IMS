<?php

namespace App\Http\Controllers\BasicSetup;

use App\Http\Controllers\Controller;
use App\Models\BasicSetup\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("basicSetup.Country.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }



    public function store(Request $request)
    {
        
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'country' => 'required|string|max:255',
                'status' => 'required',
            ]);

            // Check if we are updating or creating a new bank
            if ($request['id'] == !null) {
                // Update existing bank record
                $country = DB::table('countries')->where('id', $request['id'])->first();

                if (!$country) {
                    return response()->json([
                        "statusCode" => 404,
                        "statusMsg" => "Bank not found"
                    ], 404);
                }

                // Perform the update
                DB::table('countries')
                    ->where('id',$request['id'])
                    ->update([
                        'name' => $validatedData['country'],
                        'status' => $validatedData['status'],
                        'update_by' => auth()->user()->id,
                        'update_at' => now()
                    ]);

                return response()->json([
                    "statusCode" => 200,
                    "statusMsg" => "Bank details updated successfully"
                ], 200);
            } else {
                // Create new bank record
                $country = new Country();
                $country->name = $validatedData['country'];
                $country->status = $validatedData['status'];
                $country->create_by = auth()->id();
                $country->create_at = now();
                $country->save();

                return response()->json([
                    'statusCode' => 200,
                    'statusMsg' => 'Bank added successfully!',
                    'data' => $country,
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
            $country = DB::table('countries')->where('id', $id)->first();
            if (!$country) {
                return response()->json([
                    "statusCode" => 404,
                    "statusMsg" => "countries not found"
                ], 404);
            }
            return response()->json($country, 200);
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
    // public function update(Request $request, $id)
    // {
    //     try {
    //         // Validate the incoming request
    //         $validatedData = $request->validate([
    //             'bank_name' => 'required|string|max:255',
    //             'bin_number' => 'required|string|max:50',
    //             'tin_number' => 'required|string|max:50',
    //             'status' => 'required',
    //         ]);

    //         // Check if the bank record exists
    //         $bank = DB::table('banks')->where('id', $id)->first();
    //         if (!$bank) {
    //             return response()->json([
    //                 "statusCode" => 404,
    //                 "statusMsg" => "Bank not found"
    //             ], 404);
    //         }

    //         // Update the bank record
    //         DB::table('banks')
    //             ->where('id', $id)
    //             ->update([
    //                 'bank_name' => $validatedData['bank_name'],
    //                 'bin_number' => $validatedData['bin_number'],
    //                 'tin_number' => $validatedData['tin_number'],
    //                 'status' => $validatedData['status'],
    //                 'update_by' => auth()->user()->id,
    //                 'update_at' => now()
    //             ]);

    //         return response()->json([
    //             "statusCode" => 200,
    //             "statusMsg" => "Bank details updated successfully"
    //         ], 200);
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         return response()->json([
    //             "statusCode" => 422,
    //             "statusMsg" => $e->getMessage(),
    //             "errors" => $e->errors()
    //         ], 422);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             "statusCode" => 400,
    //             "statusMsg" => $e->getMessage()
    //         ], 400);
    //     }
    // }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Find the bank record by ID
            $Country = Country::findOrFail($id);

            // Delete the bank record
            $Country->delete();

            // Return a successful JSON response
            return response()->json([
                "statusCode" => 200,
                "statusMsg" => "Bank record deleted successfully."
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                "statusCode" => 404,
                "statusMsg" => "Bank record not found."
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ], 400);
        }
    }


    public function getCountriesData()
    {

        $rawData = DB::select("SELECT id,name,status
        FROM countries;");

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
