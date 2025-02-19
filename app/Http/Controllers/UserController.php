<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('permission:delete_user',['only'=>['destroy']]);
        $this->middleware('permission:view_user',['only'=>['index']]);
        $this->middleware('permission:update_user',['only'=>['show','store']]);
        $this->middleware('permission:create_user',['only'=>['store']]);
    } 
    public function index()
    {
        return view('admin.user');
    }

    public function store(Request $request)
    {
        try {
            if ($request['id'] == "") {

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password)
                ]);
                $user->syncRoles($request->roles);
                return json_encode(array(
                    "statusCode" => 200,
                    "statusMsg" => "Data Added Successfully"
                ));
            } else {
                $id = $request['id'];
                $permission = User::findOrFail($id);
                $permission->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
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

    public function show($id)
    {
        try {
            $singleDataShow = DB::table('users')->where('id', $id)->get();
            //$singleDataShow = User::findOrFail($id)->get();
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
            $permission = User::findOrFail($id);
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

    public function GetRoles()
    {
        try {
            $singleDataShow = Role::all();
            return $singleDataShow;
        } catch (\Exception $e) {

            return json_encode(array(
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ));;
        }
    }

    public function getUserData()
    {
        $rawData = User::with('roles')->get();

        return DataTables::of($rawData)
            ->addColumn('roles_html', function ($rawData) {
                $roleBadges = '';
                foreach ($rawData->roles as $role) {
                    $roleBadges .= '<span class="badge rounded-pill bg-label-info">' . $role->name . '</span></br>';
                }
                return $roleBadges;
            })
            ->addColumn('action', function ($rawData) {
                $button = '
            <div class="button-list">
                <a onclick="showData(' . $rawData->id . ')" role="button" href="#" class="btn btn-success btn-sm">Edit</a>
                <a onclick="deleteData(' . $rawData->id . ')" role="button" href="#" class="btn btn-danger btn-sm">Delete</a>
            </div>
            ';
                return $button;
            })
            ->rawColumns(['roles_html', 'action'])
            ->toJson();
    }

    public function authenticate(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $hasStudentRoles = $user->hasAnyRole(['Super Admin', 'Admin']);
                if ($user) {
                    return json_encode(array(
                        'statusCode' => 200,
                        'route' => 'Home',
                    ));
                } else {
                    return json_encode(array(
                        'statusCode' => 201,
                    ));
                }
            } else {
                return json_encode(array(
                    "statusCode" => 201
                ));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return json_encode(array(
                "statusCode" => 201,
                "statusMsg" => $e->getMessage()
            ));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
