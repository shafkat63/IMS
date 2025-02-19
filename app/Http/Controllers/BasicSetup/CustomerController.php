<?php

namespace App\Http\Controllers\BasicSetup;

use App\Http\Controllers\Controller;
use App\Models\BasicSetup\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    public function __construct(){
        $this->middleware('permission:delete_customers',['only'=>['destroy']]);
        $this->middleware('permission:view_customers',['only'=>['index']]);
        $this->middleware('permission:update_customers',['only'=>['show','store']]);
        $this->middleware('permission:create_customers',['only'=>['create','store']]);
    } 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("basicSetup.Customer.index");
    }
    // public function getProductCategoryData(Request $request)
    // {
    //     $getProductCategoryData = Categories::select('id', 'name')->get();

    //     return response()->json([
    //         'data' => $getProductCategoryData
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
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'country_name' => 'required|string|max:255',
                'address' => 'nullable|string|max:500',
                'mobile_number' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'bin_number' => 'required|string|max:50',
                'tin_number' => 'required|string|max:50',
                'vat_registration_number' => 'nullable|string|max:50',
                'national_id' => 'nullable|string|max:50',
                'irc_number' => 'nullable|string|max:50',
                'remarks' => 'nullable|string|max:500',
                'status' => 'required',
            ]);

            if (!is_null($request->id)) {
                $customer = Customers::find($request->id);

                if (!$customer) {
                    return response()->json([
                        "statusCode" => 404,
                        "statusMsg" => "Customer not found"
                    ], 404);
                }

                $customer->update([
                    'name' => $validatedData['name'],
                    'country_name' => $validatedData['country_name'],
                    'address' => $validatedData['address'],
                    'mobile_number' => $validatedData['mobile_number'],
                    'email' => $validatedData['email'],
                    'bin_number' => $validatedData['bin_number'],
                    'tin_number' => $validatedData['tin_number'],
                    'vat_registration_number' => $validatedData['vat_registration_number'],
                    'national_id' => $validatedData['national_id'],
                    'irc_number' => $validatedData['irc_number'],
                    'remarks' => $validatedData['remarks'],
                    'status' => $validatedData['status'],
                    'update_by' => auth()->id(),
                ]);

                return response()->json([
                    "statusCode" => 200,
                    "statusMsg" => "Customer details updated successfully",
                    "data" => $customer
                ], 200);
            } else {
                $customer = Customers::create([
                    'name' => $validatedData['name'],
                    'country_name' => $validatedData['country_name'],
                    'address' => $validatedData['address'],
                    'mobile_number' => $validatedData['mobile_number'],
                    'email' => $validatedData['email'],
                    'bin_number' => $validatedData['bin_number'],
                    'tin_number' => $validatedData['tin_number'],
                    'vat_registration_number' => $validatedData['vat_registration_number'],
                    'national_id' => $validatedData['national_id'],
                    'irc_number' => $validatedData['irc_number'],
                    'remarks' => $validatedData['remarks'],
                    'status' => $validatedData['status'],
                    'create_by' => auth()->id(),
                ]);

                return response()->json([
                    'statusCode' => 200,
                    'statusMsg' => 'Customer added successfully!',
                    'data' => $customer,
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
            $customers = DB::table('customers')->where('id', $id)->first();
            if (!$customers) {
                return response()->json([
                    "statusCode" => 404,
                    "statusMsg" => " customers not found"
                ], 404);
            }
            return response()->json($customers, 200);
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
            $Customers = Customers::findOrFail($id);

            $Customers->delete();

            return response()->json([
                "statusCode" => 200,
                "statusMsg" => "Customers record deleted successfully."
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                "statusCode" => 404,
                "statusMsg" => "Customers record not found."
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ], 400);
        }
    }

    public function getCustomersData()
    {
        // $rawData = DB::select("SELECT 
        //     psc.id, 
        //     psc.name, 
        //     ps.name AS category_name, 
        //     psc.status
        // FROM product_sub_categories psc
        // JOIN categories ps ON psc.product_categories_id = ps.id ");
        $rawData = DB::select("SELECT 
            psc.id, 
            psc.name, 
            ps.name AS countries, 
            psc.address, 
            psc.mobile_number, 
            psc.email, 
            psc.bin_number, 
            psc.tin_number, 
            psc.vat_registration_number, 
            psc.national_id, 
            psc.irc_number, 
            psc.remarks, 
            psc.status
            FROM customers psc
            JOIN countries ps ON psc.country_name = ps.id");




        return DataTables::of($rawData)
            ->addColumn('status', function ($rawData) {
                return $rawData->status == 'active'
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>';
            })
            ->addColumn('action', function ($rawData) {
                $buttons = '';
    
                if (auth()->user()->can('update_customers')) {
                    $buttons .= '
                        <a onclick="showData(' . $rawData->id . ')" role="button" href="#" class="btn btn-success btn-sm">
                            <i class="bx bx-edit-alt"></i>
                        </a>
                    ';
                }
    
                if (auth()->user()->can('delete_customers')) {
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
            ->rawColumns(['status', 'action']) // Mark columns as raw HTML
            ->toJson();
    }
}
