<?php

namespace App\Http\Controllers\BasicSetup;

use App\Http\Controllers\Controller;
use App\Models\BasicSetup\ProductGrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProductGradeController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("basicSetup.ProductGrade.index");
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
                'name' => 'required|string|max:255',
                'remarks' => 'required|string|max:255',
                'status' => 'required',
            ]);

            if ($request['id'] == !null) {
                $product_grade = DB::table('product_grade')->where('id', $request['id'])->first();

                if (!$product_grade) {
                    return response()->json([
                        "statusCode" => 404,
                        "statusMsg" => "product grade not found"
                    ], 404);
                }

                DB::table('product_grade')
                    ->where('id', $request['id'])
                    ->update([
                        'name' => $validatedData['name'],
                        'remarks' => $validatedData['remarks'],
                        'status' => $validatedData['status'],
                        'update_by' => auth()->user()->id,
                        'update_date' => now()
                    ]);

                return response()->json([
                    "statusCode" => 200,
                    "statusMsg" => "Product Grade updated successfully"
                ], 200);
            } else {
                $product_grade = new ProductGrade();
                $product_grade->name = $validatedData['name'];
                $product_grade->remarks = $validatedData['remarks'];
                $product_grade->status = $validatedData['status'];
                $product_grade->create_by = auth()->id();
                $product_grade->create_Date = now();
                $product_grade->save();

                return response()->json([
                    'statusCode' => 200,
                    'statusMsg' => 'Product Grade added successfully!',
                    'data' => $product_grade,
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
            $product_grade = DB::table('product_grade')->where('id', $id)->first();
            if (!$product_grade) {
                return response()->json([
                    "statusCode" => 404,
                    "statusMsg" => "Product Grade  not found"
                ], 404);
            }
            return response()->json($product_grade, 200);
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


    public function destroy($id)
    {
        try {
            $product_grade = ProductGrade::findOrFail($id);

            $product_grade->delete();

            return response()->json([
                "statusCode" => 200,
                "statusMsg" => "Product Grade record deleted successfully."
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                "statusCode" => 404,
                "statusMsg" => "Product Grade record not found."
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ], 400);
        }
    }
    public function getProductGradesData()
    {
        $rawData = DB::select("SELECT id,name,remarks,status FROM product_grade");


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
