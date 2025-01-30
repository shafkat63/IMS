<?php

namespace App\Http\Controllers\BasicSetup;

use App\Http\Controllers\Controller;
use App\Models\BasicSetup\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProductCategoryController extends Controller
{
    public function index()
    {
        return view("basicSetup.ProductCategory.index");
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
                'category_name' => 'required',
                'status' => 'required',
            ]);
    
            // Check if we are updating or creating a new color
            if ($request['id'] != null) {
                // Update existing color record
                $currencies = DB::table('categories')->where('id', $request['id'])->first();
    
                if (!$currencies) {
                    return response()->json([
                        "statusCode" => 404,
                        "statusMsg" => "Color not found"
                    ], 404);
                }
    
                // Perform the update
                DB::table('categories')
                    ->where('id', $request['id'])
                    ->update([
                        'name' => $validatedData['category_name'],
                        'status' => $validatedData['status'],
                        'update_by' => auth()->user()->id,
                        'update_date' => now()
                    ]);
    
                return response()->json([
                    "statusCode" => 200,
                    "statusMsg" => "Color details updated successfully"
                ], 200);
            } else {
                // Create new color record
                $categories = new Categories();
                $categories->name = $validatedData['category_name'];
                $categories->status = $validatedData['status'];
                $categories->create_by = auth()->id();
                $categories->create_date = now();
                $categories->save();
    
                return response()->json([
                    'statusCode' => 200,
                    'statusMsg' => 'Color added successfully!',
                    'data' => $categories,
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
            $categories = DB::table('categories')->where('id', $id)->first();
            if (!$categories) {
                return response()->json([
                    "statusCode" => 404,
                    "statusMsg" => "Mode Of Units not found"
                ], 404);
            }
            return response()->json($categories, 200);
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
            $categories = Categories::findOrFail($id);

            // Delete the bank record
            $categories->delete();

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


    public function getProductCategoriesData()
    {

        $rawData = DB::select("SELECT id,name,status
        FROM categories;");

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
