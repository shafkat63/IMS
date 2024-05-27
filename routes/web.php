<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {return view('login');});
Route::get('login', function () {return view('login');})->name('logout');

Route::post('requestLogin',[App\Http\Controllers\UserController::class,'authenticate']);

//Route::group(['middleware'=>['role:Super Admin|Admin']],function () {
Route::group(['middleware'=>['role:Super Admin|Admin|Manager']],function () {

    Route::post('/logout',[App\Http\Controllers\UserController::class,'logout'])->name('logout');

    Route::get('GetRoles',[App\Http\Controllers\UserController::class,'GetRoles']);


    Route::get('Home', function () {return view('admin.home');});

    Route::resource('User', App\Http\Controllers\UserController::class);
    Route::get('GetRoles',[App\Http\Controllers\UserController::class,'GetRoles']);
    Route::get('/get/all/User',[App\Http\Controllers\UserController::class,'getUserData'])->name('all.User');

    Route::resource('Permission', App\Http\Controllers\PermissionController::class);
    Route::get('/get/all/Permission',[App\Http\Controllers\PermissionController::class,'getPermissionData'])->name('all.Permission');

    Route::resource('Role', App\Http\Controllers\RoleController::class);
    Route::get('/get/all/Role',[App\Http\Controllers\RoleController::class,'getRoleData'])->name('all.Role');
    Route::get('/addpermission/{roleid}',[App\Http\Controllers\RoleController::class,'addPermissionToRole']);

    Route::post('GivePermissionToRole',[App\Http\Controllers\RoleController::class,'GivePermissionToRole']);

});



