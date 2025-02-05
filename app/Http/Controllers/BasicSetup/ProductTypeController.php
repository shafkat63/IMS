<?php

namespace App\Http\Controllers\BasicSetup;

use App\Http\Controllers\Controller;
use App\Models\BasicSetup\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProductTypeController extends Controller
{
    public function index()
    {
        return view("basicSetup.ProductType.index");
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
            $validatedData = $request->validate([
                'name' => 'required',
                'alias' => 'required',
                'status' => 'required',
            ]);
    
            if ($request['id'] != null) {
                $product_type = DB::table('product_type')->where('id', $request['id'])->first();
    
                if (!$product_type) {
                    return response()->json([
                        "statusCode" => 404,
                        "statusMsg" => "Product type not found"
                    ], 404);
                }
    
                // Perform the update
                DB::table('product_type')
                    ->where('id', $request['id'])
                    ->update([
                        'name' => $validatedData['name'],
                        'alias' => $validatedData['alias'],
                        'status' => $validatedData['status'],
                        'update_by' => auth()->user()->id,
                        'update_date' => now()
                    ]);
    
                return response()->json([
                    "statusCode" => 200,
                    "statusMsg" => "Product type  updated successfully"
                ], 200);
            } else {
                $ProductType = new ProductType();
                $ProductType->name = $validatedData['name'];
                $ProductType->alias = $validatedData['alias'];
                $ProductType->status = $validatedData['status'];
                $ProductType->create_by = auth()->id();
                $ProductType->create_date = now();
                $ProductType->save();
    
                return response()->json([
                    'statusCode' => 200,
                    'statusMsg' => 'Product Type added successfully!',
                    'data' => $ProductType,
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
    

    public function show($id)
    {
        try {
            $colors = DB::table('product_type')->where('id', $id)->first();
            if (!$colors) {
                return response()->json([
                    "statusCode" => 404,
                    "statusMsg" => "Product type not found"
                ], 404);
            }
            return response()->json($colors, 200);
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
            $ProductType = ProductType::findOrFail($id);

            // Delete the bank record
            $ProductType->delete();

            // Return a successful JSON response
            return response()->json([
                "statusCode" => 200,
                "statusMsg" => "Product Type deleted successfully."
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle case where the record was not found
            return response()->json([
                "statusCode" => 404,
                "statusMsg" => "Product Type not found."
            ], 404);
        } catch (\Exception $e) {
            // Handle general exceptions
            return response()->json([
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ], 400);
        }
    }


    public function getProductTypesData()
    {

        $rawData = DB::select("SELECT id,name,alias,status
        FROM product_type;");

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
