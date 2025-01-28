<?php

namespace App\Http\Controllers\websetup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MenuAssignController extends Controller
{
    public function index(){

        return view("admin.menu.menu");
    }

    public function getMenuData(){
        $rawData = DB::select("SELECT id,menu_id,role,status,create_date,update_date
        FROM menu_assign;");

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
}
