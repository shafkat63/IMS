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
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('login');
});
Route::get('login', function () {
    return view('login');
})->name('login');

Route::post('requestLogin', [UserController::class, 'authenticate']);

//Route::group(['middleware'=>['role:Super Admin|Admin']],function () {
Route::group(['middleware' => ['role:Super Admin|Admin|Manager']], function () {



    Route::resource('SidebarNav', SidebarNavController::class);
    Route::post('/get/all/SidebarNav', [SidebarNavController::class, 'getData'])->name('all.SidebarNav');


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

    Route::resource('organization', OrganizationController::class);
    Route::get('/get/all/organization', [OrganizationController::class, 'getOrganizationData'])->name('all.organization');

    Route::resource('countries', CountryController::class);
    Route::get('/get/all/countries', [CountryController::class, 'getCountriesData'])->name('all.countries');

    Route::resource('banks', BankController::class);
    Route::get('/get/all/banks', [BankController::class, 'getbanksData'])->name('all.banks');

    Route::resource('bank_branches', BankBranchController::class);
    Route::get('/getbankdata', [BankBranchController::class, 'getbankdata']);
    Route::get('/get/all/bank_branches', [BankBranchController::class, 'getbankBranchesData'])->name('all.bank_branches');

    Route::resource('modes_of_units', ModeOfUnitController::class);
    Route::get('/get/all/modes_of_units', [ModeOfUnitController::class, 'getModeOfUnitData'])->name('all.modes_of_units');

    Route::resource('colors', ColorController::class);
    Route::get('/get/all/colors', [ColorController::class, 'getColorData'])->name('all.colors');

    Route::resource('currencies', CurrencyController::class);
    Route::get('/get/all/currencies', [CurrencyController::class, 'getCurrenciesData'])->name('all.currencies');

    Route::resource('product_types', ProductTypeController::class);
    Route::get('/get/all/product_types', [ProductTypeController::class, 'getProductTypesData'])->name('all.product_types');


    Route::resource('productcategories', ProductCategoryController::class);
    Route::get('/get/all/productcategories', [ProductCategoryController::class, 'getProductCategoriesData'])->name('all.productcategories');

    Route::resource('product_sub_categories', ProductSubCategoryController::class);
    Route::get('/get/all/product_sub_categories', [ProductSubCategoryController::class, 'getSubProductCategoriesData'])->name('all.product_sub_categories');
    Route::get('/get_product_sub_categories', [ProductSubCategoryController::class, 'getProductCategoryData']);



    Route::resource('products', ProductController::class);
    Route::get('/get/all/products', [ProductController::class, 'getProductData'])->name('all.products');
    Route::get('/producttype', [ProductController::class, 'getProducttypeData']);
    Route::get('/productcategory', [ProductController::class, 'getCategoryData']);
    Route::get('/productsubcategory', [ProductController::class, 'getSubCategoryData']);
    Route::get('/modeofunit', [ProductController::class, 'getModeofunitData']);
    Route::get('/getcolorforprod', [ProductController::class, 'getColorforprodData']);
    Route::get('/productgradeforprods', [ProductController::class, 'getProductGradeData']);
    Route::get('/getProducts/{id}', [ProductController::class, 'getProduct']);


    Route::resource('manufacturers', ManufacturerController::class);
    Route::get('/get/all/manufacturers', [ManufacturerController::class, 'getManufacturersData'])->name('all.manufacturers');
    Route::get('/getcountrydata', [ManufacturerController::class, 'getCountryData']);

    Route::resource('shipmentmodes', ShipmentModeController::class);
    Route::get('/get/all/shipmentmodes', [ShipmentModeController::class, 'getShipmentmodesData'])->name('all.shipmentmodes');

    Route::resource('customers', CustomerController::class);
    Route::get('/get/all/customers', [CustomerController::class, 'getCustomersData'])->name('all.customers');
    //not done
    Route::resource('suppliers', SupplierController::class);
    Route::get('/get/all/suppliers', [SupplierController::class, 'getSuppliersData'])->name('all.suppliers');


    Route::resource('payment_statuses', PaymentStatusController::class);
    Route::get('/get/all/payment_statuses', [PaymentStatusController::class, 'getPaymentStatusesData'])->name('all.payment_statuses');

    Route::resource('product_grades', ProductGradeController::class);
    Route::get('/get/all/product_grades', [ProductGradeController::class, 'getProductGradesData'])->name('all.product_grades');






    Route::resource('customer_inquiry', CustomerInquiryController::class);
    Route::get('/get/all/customer_inquiry', [CustomerInquiryController::class, 'getCustomerInquiryData'])->name('all.customer_inquiry');

    Route::get('/getcustomer', [CustomerInquiryController::class, 'getCustomerData']);
    Route::get('/getshipmentmode', [CustomerInquiryController::class, 'getShipmentmodeData']);
    Route::get('/getproductname', [CustomerInquiryController::class, 'getProductnameData']);
    Route::get('/getcolorforcustomerinquiry', [CustomerInquiryController::class, 'getColorforcustomerInquiryData']);
    Route::get('/getspecforcustomerinquiry', [CustomerInquiryController::class, 'getColorforcustomerInquirySpec']);
    Route::get('/getmanufacturers', [CustomerInquiryController::class, 'getManufacturers']);
    Route::get('/getcountry', [CustomerInquiryController::class, 'getCountryData']);
    Route::get('/getcurrency', [CustomerInquiryController::class, 'getCurrencyData']);


    Route::resource('inquiry_to_supplier', InquiryToSupplierController::class);
    Route::get('/get/all/inquiry_to_supplier', [InquiryToSupplierController::class, 'getInquiryToSupplierData'])->name('all.inquiry_to_supplier');
    Route::get('/get_suppliers', [InquiryToSupplierController::class,'getSuppliers'])->name('get.suppliers');
    Route::get('/get-customer-inquiries', [InquiryToSupplierController::class,'getCustomerInquiries'])->name('get-customer-inquiries');
    Route::get('/get-customer/{inquiryId}', [InquiryToSupplierController::class,'getCustomerByInquiry']);

    Route::get('/getcustomer', [CustomerInquiryController::class, 'getCustomerData']);
    Route::get('/getshipmentmode', [CustomerInquiryController::class, 'getShipmentmodeData']);
    Route::get('/getproductname', [CustomerInquiryController::class, 'getProductnameData']);
    Route::get('/getcolorforcustomerinquiry', [CustomerInquiryController::class, 'getColorforcustomerInquiryData']);
    Route::get('/getspecforcustomerinquiry', [CustomerInquiryController::class, 'getColorforcustomerInquirySpec']);
    Route::get('/getmanufacturers', [CustomerInquiryController::class, 'getManufacturers']);
    Route::get('/getcountry', [CustomerInquiryController::class, 'getCountryData']);
    Route::get('/getcurrency', [CustomerInquiryController::class, 'getCurrencyData']);








    Route::resource('supplier-offer', SupplierOfferController::class);
    Route::resource('offer-to-customer', OfferToCustomerController::class);
    Route::resource('customer-feedback', CustomerFeedbackController::class);
    Route::resource('order-to-supplier', OrderToSupplierController::class);
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
