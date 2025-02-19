<?php

namespace App\Http\Controllers\BasicSetup;

use App\Http\Controllers\Controller;
use App\Models\BasicSetup\Categories;
use App\Models\BasicSetup\ProductSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProductSubCategoryController extends Controller
{
    public function __construct(){
        $this->middleware('permission:delete_product_sub_categories',['only'=>['destroy']]);
        $this->middleware('permission:view_product_sub_categories',['only'=>['index']]);
        $this->middleware('permission:update_product_sub_categories',['only'=>['show','store']]);
        $this->middleware('permission:create_product_sub_categories',['only'=>['create','store']]);
    } 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("basicSetup.ProductSubCategory.index");
    }
    public function getProductCategoryData(Request $request)
    {
        $getProductCategoryData = Categories::select('id', 'name')->get();

        return response()->json([
            'data' => $getProductCategoryData
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
                'subcategory_name' => 'required|string|max:255',
                'product_category_id' => 'required',
                'status' => 'required',
            ]);

            if ($request['id'] == !null) {
                $product_sub_categories = DB::table('product_sub_categories')->where('id', $request['id'])->first();

                if (!$product_sub_categories) {
                    return response()->json([
                        "statusCode" => 404,
                        "statusMsg" => "Product Sub Category not found"
                    ], 404);
                }

                // Perform the update
                DB::table('product_sub_categories')
                    ->where('id', $request['id'])
                    ->update([
                        'name' => $validatedData['subcategory_name'],
                        'product_categories_id' => $validatedData['product_category_id'],
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
                $ProductSubCategory = new ProductSubCategory();
                $ProductSubCategory->name = $validatedData['subcategory_name'];
                $ProductSubCategory->product_categories_id = $validatedData['product_category_id'];
                $ProductSubCategory->status = $validatedData['status'];
                $ProductSubCategory->create_by = auth()->id();
                $ProductSubCategory->create_Date = now();
                $ProductSubCategory->save();

                return response()->json([
                    'statusCode' => 200,
                    'statusMsg' => 'Product Sub Category added successfully!',
                    'data' => $ProductSubCategory,
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
            $product_sub_categories = DB::table('product_sub_categories')->where('id', $id)->first();
            if (!$product_sub_categories) {
                return response()->json([
                    "statusCode" => 404,
                    "statusMsg" => " Product sub categories not found"
                ], 404);
            }
            return response()->json($product_sub_categories, 200);
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
            $ProductSubCategory = ProductSubCategory::findOrFail($id);

            // Delete the bank record
            $ProductSubCategory->delete();

            return response()->json([
                "statusCode" => 200,
                "statusMsg" => "Product Sub Category record deleted successfully."
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                "statusCode" => 404,
                "statusMsg" => "Product Sub Category record not found."
            ], 404);
        } catch (\Exception $e) {
            // Handle general exceptions
            return response()->json([
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ], 400);
        }
    }

    public function getSubProductCategoriesData()
    {
        $rawData = DB::select("SELECT 
            psc.id, 
            psc.name, 
            ps.name AS category_name, 
            psc.status
        FROM product_sub_categories psc
        JOIN categories ps ON psc.product_categories_id = ps.id ");



        // $rawData = DB::select("SELECT id,name,product_categories_id,status
        // FROM product_sub_categories;");

        return DataTables::of($rawData)
        ->addColumn('action', function ($rawData) {
            $buttons = '';

            if (auth()->user()->can('update_product_sub_categories')) {
                $buttons .= '
                    <a onclick="showData(' . $rawData->id . ')" role="button" href="#" class="btn btn-success btn-sm">
                        <i class="bx bx-edit-alt"></i>
                    </a>
                ';
            }

            if (auth()->user()->can('delete_product_sub_categories')) {
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
