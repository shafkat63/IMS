<?php

namespace App\Http\Controllers\BasicSetup;

use App\Http\Controllers\Controller;
use App\Models\BasicSetup\Categories;
use App\Models\BasicSetup\Colors;
use App\Models\BasicSetup\ModeOfUnit;
use App\Models\BasicSetup\ProductGrade;
use App\Models\BasicSetup\Products;
use App\Models\BasicSetup\ProductsDetails;
use App\Models\BasicSetup\ProductSubCategory;
use App\Models\BasicSetup\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("basicSetup.Product.index");
    }

    public function getProduct($id)
    {
        $product = Products::find($id);
        $productDetails = ProductsDetails::where('product_id', $id)->get();
        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'data' => [
                'product' => $product,
                'product_details' => $productDetails
            ]
        ]);
    }


    public function create()
    {
        return view("basicSetup.Product.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'product_name' => 'required|string|max:255',
                'product_type' => 'required|string|max:255',
                'product_category_id' => 'required',
                'sub_category_id' => 'required',
                'mode_of_unit' => 'required|string|max:255',
                'part_number' => 'required|string|max:255',
                'import_hs_code' => 'nullable|string|max:255',
                'export_hs_code' => 'nullable|string|max:255',
                'product_grade' => 'nullable|string|max:255',
                'color' => 'nullable|array',
                'spec' => 'nullable|array',
                'image_path' => 'nullable|array',
                'image_path.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if ($request->id) {
                $product = DB::table('products')->where('id', $request->id)->first();

                if (!$product) {
                    return response()->json([
                        "statusCode" => 404,
                        "statusMsg" => "Product not found"
                    ], 404);
                }

                DB::table('products')
                    ->where('id', $request->id)
                    ->update([
                        'product_name' => $validatedData['product_name'],
                        'product_type' => $validatedData['product_type'],
                        'product_category_id' => $validatedData['product_category_id'],
                        'sub_category_id' => $validatedData['sub_category_id'],
                        'mode_of_unit' => $validatedData['mode_of_unit'],
                        'part_number' => $validatedData['part_number'],
                        'import_hs_code' => $validatedData['import_hs_code'],
                        'export_hs_code' => $validatedData['export_hs_code'],
                        'product_grade' => $validatedData['product_grade'],
                        'update_by' => auth()->id(),
                        'update_date' => now(),
                    ]);

                DB::table('product_details')->where('product_id', $request->id)->delete();

                if ($request->has('color')) {
                    foreach ($request->color as $index => $color) {
                        $imagePath = null;

                        if ($request->hasFile("image_path.$index")) {
                            $image = $request->file("image_path.$index");
                            $imageName = Str::random(15) . '.' . strtolower($image->getClientOriginalExtension());
                            $uploadPath = "ALLImages/ProductImages/";
                            $image->move(public_path($uploadPath), $imageName);
                            $imagePath = $uploadPath . $imageName;
                        }

                        DB::table('product_details')->insert([
                            'product_id' => $request->id,
                            'color' => $color,
                            'spec' => $request->spec[$index] ?? null,
                            'image_path' => $imagePath,
                            'create_by' => auth()->id(),
                            'create_date' => now(),
                        ]);
                    }
                }

                return response()->json([
                    "statusCode" => 200,
                    "statusMsg" => "Product updated successfully"
                ], 200);
            } else {
                // Insert new product
                $productId = DB::table('products')->insertGetId([
                    'product_name' => $validatedData['product_name'],
                    'product_type' => $validatedData['product_type'],
                    'product_category_id' => $validatedData['product_category_id'],
                    'sub_category_id' => $validatedData['sub_category_id'],
                    'mode_of_unit' => $validatedData['mode_of_unit'],
                    'part_number' => $validatedData['part_number'],
                    'import_hs_code' => $validatedData['import_hs_code'],
                    'export_hs_code' => $validatedData['export_hs_code'],
                    'product_grade' => $validatedData['product_grade'],
                    'create_by' => auth()->id(),
                    'create_date' => now(),
                ]);

                if ($request->has('color')) {
                    foreach ($request->color as $index => $color) {
                        $imagePath = null;

                        if ($request->hasFile("image_path.$index")) {
                            $image = $request->file("image_path.$index");
                            $imageName = Str::random(15) . '.' . strtolower($image->getClientOriginalExtension());
                            $uploadPath = "ALLImages/ProductImages/";
                            $image->move(public_path($uploadPath), $imageName);
                            $imagePath = $uploadPath . $imageName;
                        }

                        DB::table('product_details')->insert([
                            'product_id' => $productId,
                            'color' => $color,
                            'spec' => $request->spec[$index] ?? null,
                            'image_path' => $imagePath,
                            'create_by' => auth()->id(),
                            'create_date' => now(),
                        ]);
                    }
                }

                return response()->json([
                    'statusCode' => 200,
                    'statusMsg' => 'Product added successfully!',
                    'data' => ['id' => $productId]
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
            $organizations = DB::table('organizations')->where('id', $id)->first();
            if (!$organizations) {
                return response()->json([
                    "statusCode" => 404,
                    "statusMsg" => "organizations  not found"
                ], 404);
            }
            return response()->json($organizations, 200);
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

    //      public function edit($id)
    // {
    //     $product = Product::findOrFail($id); // Fetch product details
    //     return view('products.edit', compact('product')); // Pass product data to the view
    // }

    public function edit(string $id)
    {
        $product = Products::findOrFail($id); // Fetch product details

        return view("basicSetup.Product.edit", compact('product'));
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
            $Products = Products::findOrFail($id);

            $Products->delete();

            return response()->json([
                "statusCode" => 200,
                "statusMsg" => "Products record deleted successfully."
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                "statusCode" => 404,
                "statusMsg" => "Products record not found."
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ], 400);
        }
    }
    public function getProductData()
    {
        // $rawData = DB::select("SELECT id,product_name,product_type,product_category_id,sub_category_id,mode_of_unit,status FROM products");
        $rawData = DB::select("SELECT 
            p.id,
            p.product_name,
            pt.name AS product_type,
            pc.name AS product_category_id,
            sc.name AS sub_category_id,
            u.unit_name AS mode_of_unit,
            p.status
            FROM products AS p
            LEFT JOIN product_type AS pt ON p.product_type = pt.id
            LEFT JOIN categories AS pc ON p.product_category_id = pc.id
            LEFT JOIN product_sub_categories AS sc ON p.sub_category_id = sc.id
            LEFT JOIN mode_of_units AS u ON p.mode_of_unit = u.id ");


        return DataTables::of($rawData)
            ->addColumn('action', function ($rawData) {
                $button = '
                <div class="button-list">
                    <a href="' . url('products/' . $rawData->id . '/edit') . '" class="btn btn-success btn-sm">Edit</a>
                    <a onclick="showData(' . $rawData->id . ')" role="button" href="#" class="btn btn-info btn-sm">View</a>
                    <a onclick="deleteData(' . $rawData->id . ')" role="button" href="#" class="btn btn-danger btn-sm">Delete</a>
                </div>';
                return $button;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function getProducttypeData(Request $request)
    {
        $getProductTypeData = ProductType::select('id', 'name')->get();

        return response()->json([
            'data' => $getProductTypeData
        ]);
    }
    public function getCategoryData(Request $request)
    {
        $Categories = Categories::select('id', 'name')->get();

        return response()->json([
            'data' => $Categories
        ]);
    }
    public function getSubCategoryData(Request $request)
    {
        $ProductSubCategory = ProductSubCategory::select('id', 'name')->get();

        return response()->json([
            'data' => $ProductSubCategory
        ]);
    }
    public function getModeofunitData(Request $request)
    {
        $ModeOfUnit = ModeOfUnit::select('id', 'unit_name')->get();

        return response()->json([
            'data' => $ModeOfUnit
        ]);
    }
    public function getColorforprodData(Request $request)
    {
        $Colors = Colors::select('id', 'name')->get();

        return response()->json([
            'data' => $Colors
        ]);
    }
    public function getProductGradeData(Request $request)
    {
        $ProductGrade = ProductGrade::select('id', 'name')->get();

        return response()->json([
            'data' => $ProductGrade
        ]);
    }
}
