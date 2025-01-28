<?php

namespace App\Http\Controllers;

use App\Models\WebSetup\SidebarNav;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:create_dashboard', ['only' => ['create']]);
        $this->middleware('permission:view_dashboard', ['only' => ['index']]);
        $this->middleware('permission:update_dashboard', ['only' => ['edit']]);
        $this->middleware('permission:delete_dashboard', ['only' => ['destroy']]);
    }
    public function WebSettings(){
        return view('datatable');
    }

    public function index(){
        $this->checkLogin();
        
        return view('welcome');
    }

    public function alert(){
        return view('alert');
    }

    public function button(){

        return view('button');
    }

    public function form(){

        return view('form');
    }
}
