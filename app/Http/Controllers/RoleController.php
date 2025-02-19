<?php

namespace App\Http\Controllers;

use App\Models\setup\MenuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    /* public function __construct(){
        $this->middleware('permission:delete_role',['only'=>['destroy']]);
        $this->middleware('permission:view_role',['only'=>['index']]);
        $this->middleware('permission:update_role',['only'=>['show','store']]);
        $this->middleware('permission:create_role',['only'=>['store']]);
    } */
    public function index()
    {
        return view('admin.role_permission.roles');
    }

    public function store(Request $request)
    {
        try {
            if ($request['id'] == "") {

                Role::create([
                    'name' => $request->name
                ]);
                return json_encode(array(
                    "statusCode" => 200,
                    "statusMsg" => "Data Added Successfully"
                ));
            } else {
                $id = $request['id'];
                $permission = Role::findById($id);
                $permission->update([
                    'name' => $request->name
                ]);
                return json_encode(array(
                    "statusCode" => 200,
                    "statusMsg" => "Data Update Successfully"
                ));
            }
        } catch (\Exception $e) {
            return json_encode(array(
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ));;
        }
    }

    public function GivePermissionToRole(Request $request)
    {
        try {
            if (!empty($request['id'])) {
                $role = Role::findOrFail($request['id']);
                $role->syncPermissions($request->permission);
                return json_encode(array(
                    "statusCode" => 200,
                    "statusMsg" => "Data Added Successfully"
                ));
            } else {
                return json_encode(array(
                    "statusCode" => 201,
                    "statusMsg" => "Failed To Give Permission To Role"
                ));
            }
        } catch (\Exception $e) {
            $role = Role::findOrFail($request['id']);
            $role->syncPermissions($request->permission);

            return json_encode(array(
                "statusCode" => 400,
                "statusMsg" =>  $e->getMessage()
            ));
        }
    }
    public function GiveMenuToRole(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'role_id' => 'required|exists:roles,id',
                'menu_id' => 'array',
                'menu_id.*' => 'exists:menu,id'
            ]);

            // Get role ID and menu IDs from the request
            $roleId = $request->input('role_id');
            $menuIds = $request->input('menu_id', []); // Default to empty array if no menu selected

            // Delete existing menu assignments for the role
            DB::table('menu_assign')->where('role_id', $roleId)->delete();

            // Insert new menu assignments
            foreach ($menuIds as $menuId) {
                DB::table('menu_assign')->insert([
                    'menu' => $menuId,
                    'role_id' => $roleId,
                    'status' => 1, // You can adjust the status as needed
                    'create_by' => auth()->user()->id,
                    'create_date' => now(),
                    'update_by' => null,
                    'update_date' => null
                ]);
            }

            return response()->json([
                "statusCode" => 200,
                "statusMsg" => "Menus assigned to role successfully"
            ]);
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
            $singleDataShow = DB::table('roles')->where('id', $id)->get();

            //$singleDataShow = Role::findById($id)->get();
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
            $permission = Role::findById($id);
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

    public function getRoleData()
    {

        $rawData = DB::select("SELECT id,name,guard_name,created_at,updated_at
        FROM roles;");

        return DataTables::of($rawData)
            ->addColumn('action', function ($rawData) {
                $buttton = '
                <div class="button-list">
                    <a onclick="addMenuToRole(' . $rawData->id . ')" role="button" href="#" class="btn btn-warning btn-sm">Add Menu</a>
                    <a onclick="addPermissionToRole(' . $rawData->id . ')" role="button" href="#" class="btn btn-info btn-sm">Add Permission</a>
                    <a onclick="showData(' . $rawData->id . ')" role="button" href="#" class="btn btn-success btn-sm">Edit</a>
                    <a onclick="deleteData(' . $rawData->id . ')" role="button" href="#" class="btn btn-danger btn-sm">Delete</a>
                </div>
                ';
                return $buttton;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    // public function addMenuToRole($id)
    // {
    //     $role = Role::findOrFail($id);

    //     $menu =  DB::table('menu as m')
    //         ->leftJoin('menu_assign as ma', function ($join) use ($id) {
    //             $join->on('m.id', '=', 'ma.menu')
    //                 ->where('ma.role_id', '=', $id);
    //         })
    //         ->select('m.id', 'm.title', DB::raw('CASE WHEN ma.id IS NOT NULL THEN 1 ELSE 0 END AS menu_exists'))
    //         ->get();
    //     return [
    //         'role' => $role,
    //         'menu' => $menu
    //     ];
    // }
    public function addMenuToRole($id)
    {
        $role = Role::findOrFail($id);

        $menu =  DB::table('menu as m')
            ->leftJoin('menu_assign as ma', function ($join) use ($id) {
                $join->on('m.id', '=', 'ma.menu')
                    ->where('ma.role_id', '=', $id);
            })
            ->select('m.id', 'm.title', DB::raw('CASE WHEN ma.id IS NOT NULL THEN 1 ELSE 0 END AS menu_exists'))
            ->orderBy('m.title', 'asc') // Order alphabetically by title
            ->get();
        return [
            'role' => $role,
            'menu' => $menu
        ];
    }



    public function addPermissionToRole($id)
    {
        $permission = Permission::get();
        $role = Role::findOrFail($id);
        $roleHavePermission = DB::table("role_has_permissions")
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return [
            'role' => $role,
            'permissions' => $permission,
            'roleHavePermission' => $roleHavePermission
        ];
    }
}
