<?php

namespace App\Http\Controllers\BasicSetup;

use App\Http\Controllers\Controller;
use App\Models\BasicSetup\Colors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ColorController extends Controller
{

    public function __construct()
    {
        $type =  'colors';
        $this->middleware('permission:delete_' . $type, ['only' => ['destroy']]);
        $this->middleware('permission:view_' . $type, ['only' => ['index']]);
        $this->middleware('permission:update_' . $type, ['only' => ['show', 'store']]);
        $this->middleware('permission:create_' . $type, ['only' => ['create', 'store']]);
    }
    public function index()
    {
        return view("basicSetup.Color.index");
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
                'color_name' => 'required',
                'status' => 'required',
            ]);

            // Check if we are updating or creating a new color
            if ($request['id'] != null) {
                // Update existing color record
                $color = DB::table('colors')->where('id', $request['id'])->first();

                if (!$color) {
                    return response()->json([
                        "statusCode" => 404,
                        "statusMsg" => "Color not found"
                    ], 404);
                }

                // Perform the update
                DB::table('colors')
                    ->where('id', $request['id'])
                    ->update([
                        'name' => $validatedData['color_name'],
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
                $color = new Colors();
                $color->name = $validatedData['color_name'];
                $color->status = $validatedData['status'];
                $color->create_by = auth()->id();
                $color->create_date = now();
                $color->save();

                return response()->json([
                    'statusCode' => 200,
                    'statusMsg' => 'Color added successfully!',
                    'data' => $color,
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
            $colors = DB::table('colors')->where('id', $id)->first();
            if (!$colors) {
                return response()->json([
                    "statusCode" => 404,
                    "statusMsg" => "Mode Of Units not found"
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
            $Colors = Colors::findOrFail($id);

            // Delete the bank record
            $Colors->delete();

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


    public function getColorData()
    {

        $rawData = DB::select("SELECT id,name,status
        FROM colors;");

        return DataTables::of($rawData)
            ->addColumn('action', function ($rawData) {
                $buttons = '';

                if (auth()->user()->can('update_colors')) {
                    $buttons .= '
                    <a onclick="showData(' . $rawData->id . ')" role="button" href="#" class="btn btn-success btn-sm">
                        <i class="bx bx-edit-alt"></i>
                    </a>
                ';
                }

                if (auth()->user()->can('delete_colors')) {
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
