<?php

namespace App\Http\Controllers\BasicSetup;

use App\Http\Controllers\Controller;
use App\Models\BasicSetup\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("basicSetup.Supplier.index");
    }

    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'supplier_name' => 'required|string|max:255',
                'country_name' => 'required|string|max:255',
                'address1' => 'nullable|string|max:500',
                'address2' => 'nullable|string|max:500',
                'city' => 'nullable|string|max:100',
                'contact_number' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'remarks' => 'nullable|string|max:500',
                'status' => 'required|in:active,inactive',
            ]);
    
            if (!is_null($request->id)) {
                // Fetch the supplier by ID
                $supplier = Suppliers::find($request->id);
    
                if (!$supplier) {
                    return response()->json([
                        "statusCode" => 404,
                        "statusMsg" => "Supplier not found"
                    ], 404);
                }
    
                // Update the supplier details
                $supplier->update([
                    'supplier_name' => $validatedData['supplier_name'],
                    'country_name' => $validatedData['country_name'],
                    'address1' => $validatedData['address1'],
                    'address2' => $validatedData['address2'],
                    'city' => $validatedData['city'],
                    'contact_number' => $validatedData['contact_number'],
                    'email' => $validatedData['email'],
                    'remarks' => $validatedData['remarks'],
                    'status' => $validatedData['status'],
                    'update_by' => auth()->id(),
                    'update_date' => now(),
                ]);
    
                return response()->json([
                    "statusCode" => 200,
                    "statusMsg" => "Supplier details updated successfully",
                    "data" => $supplier
                ], 200);
            } else {
                $supplier = Suppliers::create([
                    'supplier_name' => $validatedData['supplier_name'],
                    'country_name' => $validatedData['country_name'],
                    'address1' => $validatedData['address1'],
                    'address2' => $validatedData['address2'],
                    'city' => $validatedData['city'],
                    'contact_number' => $validatedData['contact_number'],
                    'email' => $validatedData['email'],
                    'remarks' => $validatedData['remarks'],
                    'status' => $validatedData['status'],
                    'create_by' => auth()->id(),
                    'create_date' => now(),
                ]);
    
                return response()->json([
                    'statusCode' => 200,
                    'statusMsg' => 'Supplier added successfully!',
                    'data' => $supplier,
                ]);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                "statusCode" => 422,
                "statusMsg" => "Validation failed",
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
            $suppliers = DB::table('suppliers')->where('id', $id)->first();
            if (!$suppliers) {
                return response()->json([
                    "statusCode" => 404,
                    "statusMsg" => " suppliers not found"
                ], 404);
            }
            return response()->json($suppliers, 200);
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
            $Suppliers = Suppliers::findOrFail($id);

            $Suppliers->delete();

            return response()->json([
                "statusCode" => 200,
                "statusMsg" => "Suppliers record deleted successfully."
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                "statusCode" => 404,
                "statusMsg" => "Suppliers record not found."
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ], 400);
        }
    }

    public function getSuppliersData()
    {

        $rawData = DB::select("SELECT 
            psc.id, 
            psc.supplier_name, 
            ps.name AS countries, 
            psc.address1, 
            psc.address2, 
            psc.city, 
            psc.contact_number, 
            psc.email, 
            psc.remarks, 
            psc.status
            FROM suppliers psc
            JOIN countries ps ON psc.country_name = ps.id");




        return DataTables::of($rawData)
            ->addColumn('status', function ($rawData) {
                return $rawData->status == 'active'
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>';
            })
            ->addColumn('action', function ($rawData) {
                return '
                <div class="button-list">
                    <a onclick="showData(' . $rawData->id . ')" role="button" href="#" class="btn btn-success btn-sm"><i class="bx bx-edit-alt"></i></a>
                    <a onclick="deleteData(' . $rawData->id . ')" role="button" href="#" class="btn btn-danger btn-sm"><i class="bx bx-trash-alt"></i></a>
                </div>';
            })
            ->rawColumns(['status', 'action']) // Mark columns as raw HTML
            ->toJson();
    }
}
