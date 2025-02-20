<?php

namespace App\Http\Controllers\BasicSetup;

use App\Http\Controllers\Controller;
use App\Models\BasicSetup\Organizations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class OrganizationController extends Controller
{

    public function __construct()
    {
        $type =  'organization';
        $this->middleware('permission:delete_' . $type, ['only' => ['destroy']]);
        $this->middleware('permission:view_' . $type, ['only' => ['index']]);
        $this->middleware('permission:update_' . $type, ['only' => ['show', 'store']]);
        $this->middleware('permission:create_' . $type, ['only' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("basicSetup.Organization.index");
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
        return view("basicSetup.Organization.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'organization_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'organization_name' => 'required|string|max:255',
                'tin_number' => 'required|string|max:255',
                'bin_number' => 'required|string|max:255',
                'vat_registration_number' => 'required|string|max:255',
                'national_id' => 'required|string|max:255',
                'address_1' => 'required|string|max:255',
                'address_2' => 'nullable|string|max:255',
                'contact_person_1' => 'required|string|max:255',
                'contact_person_2' => 'nullable|string|max:255',
                'contact_number_1' => 'required|string|max:255',
                'contact_number_2' => 'nullable|string|max:255',
                'email_address' => 'required|email|max:255',
                'web_address' => 'nullable|string|max:255',
                'mobile_wallet_number' => 'nullable|string|max:255',
                'erc_number' => 'nullable|string|max:255',
                'status' => 'required',
            ]);

            if ($request['id']) {
                $organization = DB::table('organizations')->where('id', $request['id'])->first();

                if (!$organization) {
                    return response()->json([
                        "statusCode" => 404,
                        "statusMsg" => "Organization not found"
                    ], 404);
                }

                $logoPath = $organization->organization_logo; // Default to old logo
                if ($request->hasFile('organization_logo')) {
                    // Delete the old logo if exists
                    if ($logoPath && file_exists(public_path($logoPath))) {
                        unlink(public_path($logoPath));
                    }

                    // Generate a unique name for the image
                    $imageOne = $request->file('organization_logo');
                    $one_full_name = Str::random(15) . '.' . strtolower($imageOne->getClientOriginalExtension());
                    $upload_path_one = "ALLImages/OrganizationLogos/";
                    $image_url_one = $upload_path_one . $one_full_name;

                    // Move the image to the public folder
                    $success_one = $imageOne->move(public_path($upload_path_one), $one_full_name);

                    // Update the image path
                    $logoPath = $image_url_one;
                }

                DB::table('organizations')
                    ->where('id', $request['id'])
                    ->update([
                        'organization_logo' => $logoPath,
                        'organization_name' => $validatedData['organization_name'],
                        'tin_number' => $validatedData['tin_number'],
                        'bin_number' => $validatedData['bin_number'],
                        'vat_registration_number' => $validatedData['vat_registration_number'],
                        'national_id' => $validatedData['national_id'],
                        'address_1' => $validatedData['address_1'],
                        'address_2' => $validatedData['address_2'],
                        'contact_person_1' => $validatedData['contact_person_1'],
                        'contact_person_2' => $validatedData['contact_person_2'],
                        'contact_number_1' => $validatedData['contact_number_1'],
                        'contact_number_2' => $validatedData['contact_number_2'],
                        'email_address' => $validatedData['email_address'],
                        'web_address' => $validatedData['web_address'],
                        'mobile_wallet_number' => $validatedData['mobile_wallet_number'],
                        'erc_number' => $validatedData['erc_number'],
                        'status' => $validatedData['status'],
                        'update_by' => auth()->user()->id,
                        'update_date' => now()
                    ]);

                return response()->json([
                    "statusCode" => 200,
                    "statusMsg" => "Organization updated successfully"
                ], 200);
            } else {
                // Create new organization
                $organization = new Organizations();
                $organization->organization_name = $validatedData['organization_name'];
                $organization->tin_number = $validatedData['tin_number'];
                $organization->bin_number = $validatedData['bin_number'];
                $organization->vat_registration_number = $validatedData['vat_registration_number'];
                $organization->national_id = $validatedData['national_id'];
                $organization->address_1 = $validatedData['address_1'];
                $organization->address_2 = $validatedData['address_2'];
                $organization->contact_person_1 = $validatedData['contact_person_1'];
                $organization->contact_person_2 = $validatedData['contact_person_2'];
                $organization->contact_number_1 = $validatedData['contact_number_1'];
                $organization->contact_number_2 = $validatedData['contact_number_2'];
                $organization->email_address = $validatedData['email_address'];
                $organization->web_address = $validatedData['web_address'];
                $organization->mobile_wallet_number = $validatedData['mobile_wallet_number'];
                $organization->erc_number = $validatedData['erc_number'];
                $organization->status = $validatedData['status'];
                $organization->create_by = auth()->id();
                $organization->create_date = now();

                if ($request->hasFile('organization_logo')) {
                    $imageOne = $request->file('organization_logo');
                    $one_full_name = Str::random(15) . '.' . strtolower($imageOne->getClientOriginalExtension());
                    $upload_path_one = "ALLImages/OrganizationLogos/";
                    $image_url_one = $upload_path_one . $one_full_name;

                    // Move the image to the public folder
                    $success_one = $imageOne->move(public_path($upload_path_one), $one_full_name);
                    $organization->organization_logo = $image_url_one;
                }

                $organization->save();

                return response()->json([
                    'statusCode' => 200,
                    'statusMsg' => 'Organization added successfully!',
                    'data' => $organization,
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
    public function edit($id)
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
            $Organizations = Organizations::findOrFail($id);

            $Organizations->delete();

            return response()->json([
                "statusCode" => 200,
                "statusMsg" => "Organizations record deleted successfully."
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                "statusCode" => 404,
                "statusMsg" => "Organizations record not found."
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ], 400);
        }
    }
    public function getOrganizationData()
    {
        $rawData = DB::select("SELECT id,organization_name,tin_number,bin_number,vat_registration_number,national_id,status FROM organizations");


        return DataTables::of($rawData)
            ->addColumn('action', function ($rawData) {
                $buttons = '';

                if (auth()->user()->can('update_organization')) {
                    $buttons .= '
                    <button onclick="showData(' . $rawData->id . ')" role="button"  class="btn btn-success btn-sm">
                        <i class="bx bx-edit-alt"></i>
                    </button>
                ';
                }

                if (auth()->user()->can('delete_organization')) {
                    $buttons .= '
                    <button onclick="deleteData(' . $rawData->id . ')" role="button"  class="btn btn-danger btn-sm">
                        <i class="bx bx-trash"></i>
                    </button>
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
