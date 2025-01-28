<?php

use App\Http\Controllers\AllRegularEntry\CommissionSettlementController;
use App\Http\Controllers\AllRegularEntry\CustomerFeedbackController;
use App\Http\Controllers\AllRegularEntry\CustomerInquiryController;
use App\Http\Controllers\AllRegularEntry\DocumentArchiveController;
use App\Http\Controllers\AllRegularEntry\DraftLCController;
use App\Http\Controllers\AllRegularEntry\IndentController;
use App\Http\Controllers\AllRegularEntry\InquiryToSupplierController;
use App\Http\Controllers\AllRegularEntry\LCAmendmentController;
use App\Http\Controllers\AllRegularEntry\OfferToCustomerController;
use App\Http\Controllers\AllRegularEntry\OrderToSupplierController;
use App\Http\Controllers\AllRegularEntry\OriginalLCController;
use App\Http\Controllers\AllRegularEntry\ProformaInvoiceController;
use App\Http\Controllers\AllRegularEntry\ShipmentAdviceController;
use App\Http\Controllers\AllRegularEntry\ShipmentBookingController;
use App\Http\Controllers\AllRegularEntry\ShippingDocumentController;
use App\Http\Controllers\AllRegularEntry\SupplierOfferController;
use App\Http\Controllers\BasicSetup\BankBranchController;
use App\Http\Controllers\BasicSetup\BankController;
use App\Http\Controllers\BasicSetup\ColorController;
use App\Http\Controllers\BasicSetup\CountryController;
use App\Http\Controllers\BasicSetup\CurrencyController;
use App\Http\Controllers\BasicSetup\CustomerController;
use App\Http\Controllers\BasicSetup\ManufacturerController;
use App\Http\Controllers\BasicSetup\ModeOfUnitController;
use App\Http\Controllers\BasicSetup\OrganizationController;
use App\Http\Controllers\BasicSetup\PaymentStatusController;
use App\Http\Controllers\BasicSetup\ProductCategoryController;
use App\Http\Controllers\BasicSetup\ProductController;
use App\Http\Controllers\BasicSetup\ProductGradeController;
use App\Http\Controllers\BasicSetup\ProductSubCategoryController;
use App\Http\Controllers\BasicSetup\ProductTypeController;
use App\Http\Controllers\BasicSetup\ShipmentModeController;
use App\Http\Controllers\BasicSetup\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\websetup\MenuAssignController;
use App\Http\Controllers\WebSetup\SidebarNavController;
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

Route::get('WebSettings', [DashboardController::class, 'WebSettings'])->name('WebSettings');

Route::get('/', function () {
    return view('login');
});
Route::get('login', function () {
    return view('login');
})->name('logout');

Route::post('requestLogin', [UserController::class, 'authenticate']);

//Route::group(['middleware'=>['role:Super Admin|Admin']],function () {
Route::group(['middleware' => ['role:Super Admin|Admin|Manager']], function () {



    Route::resource('SidebarNav', SidebarNavController::class);
    Route::post('/get/all/SidebarNav', [App\Http\Controllers\WebSetup\SidebarNavController::class, 'getData'])->name('all.SidebarNav');

    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('GetRoles', [UserController::class, 'GetRoles']);


    Route::get('Home', function () {
        return view('admin.home');
    });

    Route::resource('User', App\Http\Controllers\UserController::class);
    Route::get('GetRoles', [App\Http\Controllers\UserController::class, 'GetRoles']);
    Route::get('/get/all/User', [App\Http\Controllers\UserController::class, 'getUserData'])->name('all.User');

    Route::resource('Permission', App\Http\Controllers\PermissionController::class);
    Route::get('/get/all/Permission', [App\Http\Controllers\PermissionController::class, 'getPermissionData'])->name('all.Permission');

    Route::resource('Role', App\Http\Controllers\RoleController::class);
    Route::get('/get/all/Role', [App\Http\Controllers\RoleController::class, 'getRoleData'])->name('all.Role');
    Route::get('/addpermission/{roleid}', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);

    Route::post('GivePermissionToRole', [App\Http\Controllers\RoleController::class, 'GivePermissionToRole']);

    Route::resource('menuassign', MenuAssignController::class);
    Route::get('/get/all/menu', [MenuAssignController::class, 'getMenuData'])->name('all.menu');





    //Basic Setup 

    Route::resource('organizations', OrganizationController::class);
    Route::resource('countries', CountryController::class);
    Route::resource('banks', BankController::class);
    Route::resource('bank-branches', BankBranchController::class);
    Route::resource('modes-of-units', ModeOfUnitController::class);
    Route::resource('colors', ColorController::class);
    Route::resource('currencies', CurrencyController::class);
    Route::resource('product-types', ProductTypeController::class);
    Route::resource('product-categories', ProductCategoryController::class);
    Route::resource('product-sub-categories', ProductSubCategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('manufacturers', ManufacturerController::class);
    Route::resource('shipment-modes', ShipmentModeController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('payment-statuses', PaymentStatusController::class);
    Route::resource('product-grades', ProductGradeController::class);





    Route::resource('customer-inquiry', CustomerInquiryController::class);
    Route::resource('inquiry-to-supplier', InquiryToSupplierController::class);
    Route::resource('supplier-offer', SupplierOfferController::class);
    Route::resource('offer-to-customer', OfferToCustomerController::class);
    Route::resource('customer-feedback', CustomerFeedbackController::class);
    Route::resource('order-to-supplier',OrderToSupplierController::class);
    Route::resource('proforma-invoice', ProformaInvoiceController::class);
    Route::resource('indent', IndentController::class);
    Route::resource('draft-lc', DraftLCController::class);
    Route::resource('original-lc', OriginalLCController::class);
    Route::resource('lc-amendment', LCAmendmentController::class);
    Route::resource('shipment-advice', ShipmentAdviceController::class);
    Route::resource('shipment-booking', ShipmentBookingController::class);
    Route::resource('shipping-document', ShippingDocumentController::class);
    Route::resource('commission-settlement', CommissionSettlementController::class);
    Route::resource('document-archive', DocumentArchiveController::class);













});
