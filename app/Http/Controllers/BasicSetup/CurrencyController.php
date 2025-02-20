<?php

namespace App\Http\Controllers\BasicSetup;

use App\Http\Controllers\Controller;
use App\Models\BasicSetup\Currencies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CurrencyController extends Controller
{
    public function __construct()
    {
        $type = 'currencies';
        $this->middleware('permission:delete_' . $type, ['only' => ['destroy']]);
        $this->middleware('permission:view_' . $type, ['only' => ['index']]);
        $this->middleware('permission:update_' . $type, ['only' => ['show', 'store']]);
        $this->middleware('permission:create_' . $type, ['only' => ['create', 'store']]);
    }
    public function index()
    {
        return view("basicSetup.Currency.index");
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
                'currency_name' => 'required',
                'status' => 'required',
            ]);
    
            // Check if we are updating or creating a new color
            if ($request['id'] != null) {
                // Update existing color record
                $currencies = DB::table('currencies')->where('id', $request['id'])->first();
    
                if (!$currencies) {
                    return response()->json([
                        "statusCode" => 404,
                        "statusMsg" => "Color not found"
                    ], 404);
                }
    
                // Perform the update
                DB::table('currencies')
                    ->where('id', $request['id'])
                    ->update([
                        'name' => $validatedData['currency_name'],
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
                $Currencies = new Currencies();
                $Currencies->name = $validatedData['currency_name'];
                $Currencies->status = $validatedData['status'];
                $Currencies->create_by = auth()->id();
                $Currencies->create_date = now();
                $Currencies->save();
    
                return response()->json([
                    'statusCode' => 200,
                    'statusMsg' => 'Color added successfully!',
                    'data' => $Currencies,
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
            $currencies = DB::table('currencies')->where('id', $id)->first();
            if (!$currencies) {
                return response()->json([
                    "statusCode" => 404,
                    "statusMsg" => "Mode Of Units not found"
                ], 404);
            }
            return response()->json($currencies, 200);
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
            $currencies = Currencies::findOrFail($id);

            // Delete the bank record
            $currencies->delete();

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


    public function getCurrenciesData()
    {

        $rawData = DB::select("SELECT id,name,status
        FROM currencies;");

        return DataTables::of($rawData)
        ->addColumn('action', function ($rawData) {
            $buttons = '';

            if (auth()->user()->can('update_currencies')) {
                $buttons .= '
                    <a onclick="showData(' . $rawData->id . ')" role="button" href="#" class="btn btn-success btn-sm">
                        <i class="bx bx-edit-alt"></i>
                    </a>
                ';
            }

            if (auth()->user()->can('delete_currencies')) {
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
