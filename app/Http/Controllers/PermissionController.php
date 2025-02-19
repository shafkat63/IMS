<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    /* public function __construct()
    {
        $this->middleware('permission:delete_permission', ['only' => ['destroy']]);
        $this->middleware('permission:view_permission', ['only' => ['index']]);
        $this->middleware('permission:update_permission', ['only' => ['show']]);
        $this->middleware('permission:create_permission', ['only' => ['store']]);
    } */

    public function index()
    {
        //$user = User::find(22);

        // Get the user's roles (assuming the user has roles assigned)
        //$roles = $user->getRoleNames(); // Returns a collection of role names

        // Loop through the roles
        /* foreach ($roles as $role) {
            // Get role object from the name
            $role = Role::findByName($role);

            // Get all permissions associated with the role
            $permissions = $role->permissions; // Returns all permissions related to the role

            // Display or process the role name and associated permissions
            echo "Role: " . $role->name . "\n";
            echo "Permissions:\n";

            foreach ($permissions as $permission) {
                echo $permission->name . "\n";
            }
        } */
        return view('admin.role_permission.permission');
    }

    // public function store(Request $request){
    //     try {
    //         if ($request['id']==""){

    //             Permission::create([
    //                'name'=>$request->name
    //             ]);

    //             return json_encode(array(
    //                 "statusCode" => 200,
    //                 "statusMsg" => "Data Added Successfully"
    //             ));

    //         }else{
    //             $id = $request['id'];
    //             $permission = Permission::findById($id);
    //             $permission->update([
    //                 'name'=>$request->name
    //             ]);
    //             return json_encode(array(
    //                 "statusCode" => 200,
    //                 "statusMsg" => "Data Update Successfully"
    //             ));
    //         }

    //     } catch (\Exception $e) {

    //         return json_encode(array(
    //             "statusCode" => 400,
    //             "statusMsg" => $e->getMessage()
    //         ));;
    //     }
    // }



    public function store(Request $request)
    {
        try {
            if (empty($request->id)) {
                $baseName = strtolower($request->name);
                if ($request->type != "Single") {
                    $permissions = [
                        "view_{$baseName}",
                        "create_{$baseName}",
                        "update_{$baseName}",
                        "delete_{$baseName}"
                    ];

                    foreach ($permissions as $permission) {
                        Permission::create(['name' => $permission]);
                    }

                    return response()->json([
                        "statusCode" => 200,
                        "statusMsg" => "Permissions Added Successfully"
                    ]);
                } else {
                    Permission::create([
                        'name' => $baseName
                    ]);


                    return response()->json([
                        "statusCode" => 200,
                        "statusMsg" => "Permissions Added Successfully"
                    ]);
                }
            } else {
                $id = $request->id;
                $permission = Permission::findById($id);
                $permission->update(['name' => strtolower($request->name)]);

                return response()->json([
                    "statusCode" => 200,
                    "statusMsg" => "Permission Updated Successfully"
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ]);
        }
    }




    public function show($id)
    {
        try {
            $singleDataShow = DB::table('permissions')->where('id', $id)->get();
            //$singleDataShow = Permission::findById($id)->get();
            return $singleDataShow;
        } catch (\Exception $e) {

            return json_encode(array(
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ));;
        }
    }

    public function destroy($id)
    {
        try {
            $permission = Permission::findById($id);
            $permission->delete();
            return json_encode(array(
                "statusCode" => 200
            ));
        } catch (\Exception $e) {

            return json_encode(array(
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ));;
        }
    }

    public function getPermissionData()
    {

        $rawData = DB::select("SELECT id,name,guard_name,created_at,updated_at
        FROM permissions;");

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

    public function getDates()
    {
        $Date = "";
        date_default_timezone_set("Asia/Dhaka");
        return $Date = date("d/m/Y h:m");
    }
}
