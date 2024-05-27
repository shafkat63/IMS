<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public function __construct(){
        $this->middleware('permission:delete_role',['only'=>['destroy']]);
        $this->middleware('permission:view_role',['only'=>['index']]);
        $this->middleware('permission:update_role',['only'=>['show','store']]);
        $this->middleware('permission:create_role',['only'=>['store']]);
    }
    public function index(){
        return view('admin.role_permission.roles');
    }

    public function store(Request $request){
        try {
            if ($request['id']==""){

                Role::create([
                    'name'=>$request->name
                ]);
                return json_encode(array(
                    "statusCode" => 200,
                    "statusMsg" => "Data Added Successfully"
                ));
            }else{
                $id = $request['id'];
                $permission = Role::findById($id);
                $permission->update([
                    'name'=>$request->name
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

    public function GivePermissionToRole(Request $request){
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

    public function show($id){
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

    public function destroy($id){
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

    public function getRoleData(){

        $rawData = DB::select("SELECT id,name,guard_name,created_at,updated_at
        FROM roles;");

        return DataTables::of($rawData)
            ->addColumn('action', function ($rawData) {
                $buttton = '
                <div class="button-list">
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

    public function addPermissionToRole($id){
        $permission = Permission::get();
        $role = Role::findOrFail($id);
        $roleHavePermission = DB::table("role_has_permissions")
            ->where('role_has_permissions.role_id',$role->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return [
            'role' => $role,
            'permissions' => $permission,
            'roleHavePermission' => $roleHavePermission
        ];
    }
}
