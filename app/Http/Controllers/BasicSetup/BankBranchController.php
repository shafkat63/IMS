<?php

namespace App\Http\Controllers\BasicSetup;

use App\Http\Controllers\Controller;
use App\Models\BasicSetup\BankBranch;
use App\Models\BasicSetup\Banks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BankBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("basicSetup.BankBranch.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function getbankdata(Request $request)
    {
        $bankdata = Banks::select('id', 'bank_name')->get();

        return response()->json([
            'data' => $bankdata // Return only the bank data
        ]);
    }



    public function store(Request $request)
    {

        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'bank_name' => 'required|string|max:255',
                'routing_number' => 'required|string|max:50',
                'swift_code' => 'required|string|max:50',
                'branch_name' => 'required|string|max:255',
                'contact_person_name' => 'required|string|max:255',
                'email' => 'required',
                'contact_number' => 'required|string|max:255',
                'status' => 'required',
            ]);

            // Check if we are updating or creating a new bank
            if ($request['id'] == !null) {
                // Update existing bank record
                $bank_branches = DB::table('bank_branches')->where('id', $request['id'])->first();

                if (!$bank_branches) {
                    return response()->json([
                        "statusCode" => 404,
                        "statusMsg" => "Bank not found"
                    ], 404);
                }

                // Perform the update
                DB::table('bank_branches')
                    ->where('id', $request['id'])
                    ->update([
                        'bank_name' => $validatedData['bank_name'],
                        'routing_number' => $validatedData['routing_number'],
                        'swift_code' => $validatedData['swift_code'],
                        'branch_name' => $validatedData['branch_name'],
                        'contact_person_name' => $validatedData['contact_person_name'],
                        'contact_number' => $validatedData['contact_number'],
                        'email' => $validatedData['email'],
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
                $bank_branche = new BankBranch();
                $bank_branche->bank_name = $validatedData['bank_name'];
                $bank_branche->routing_number = $validatedData['routing_number'];
                $bank_branche->swift_code = $validatedData['swift_code'];
                $bank_branche->branch_name = $validatedData['branch_name'];
                $bank_branche->contact_number = $validatedData['contact_number'];
                $bank_branche->contact_person_name = $validatedData['contact_person_name'];
                $bank_branche->status = $validatedData['status'];
                $bank_branche->email = $validatedData['email'];
                $bank_branche->create_by = auth()->id();
                $bank_branche->create_at = now();
                $bank_branche->save();

                return response()->json([
                    'statusCode' => 200,
                    'statusMsg' => 'Bank added successfully!',
                    'data' => $bank_branche,
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
            $bank = DB::table('bank_branches')->where('id', $id)->first();
            if (!$bank) {
                return response()->json([
                    "statusCode" => 404,
                    "statusMsg" => "Bank Branche not found"
                ], 404);
            }
            return response()->json($bank, 200);
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

    public function destroy($id)
    {
        try {
            // Find the bank record by ID
            $BankBranch = BankBranch::findOrFail($id);

            // Delete the bank record
            $BankBranch->delete();

            // Return a successful JSON response
            return response()->json([
                "statusCode" => 200,
                "statusMsg" => "Bank Branch record deleted successfully."
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


    public function getbankBranchesData()
    {

        // $rawData = DB::select("SELECT id,bank_name,routing_number,swift_code,branch_name,contact_person_name,contact_number,email,status
        // FROM bank_branches;");

        $rawData = DB::select(
            "SELECT 
                bb.id, 
                b.bank_name, 
                bb.routing_number, 
                bb.swift_code, 
                bb.branch_name, 
                bb.contact_person_name, 
                bb.contact_number, 
                bb.email, 
                bb.status
            FROM bank_branches bb
            JOIN banks b ON bb.bank_name = b.id;");


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
