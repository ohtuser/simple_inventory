<?php

use App\Http\Controllers\AdmiOrderController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InvoiceSettingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\Product\CategoryController;
use App\Http\Controllers\Product\CommonProductController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\UnitController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SidebarController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\auth\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login_attempt', [AuthController::class, 'loginAttempt'])->name('login_attempt');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'admin_or_stuff_or_customer'], function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
    Route::post('profile_update', [DashboardController::class, 'profile_update'])->name('profile_update');

    Route::name('customer.')->prefix('customer')->group(function () {
        Route::name('order.')->prefix('order')->group(function () {
            Route::get('create', [OrderController::class, 'create'])->name('create');
            Route::post('store', [OrderController::class, 'store'])->name('store');
            Route::get('index', [OrderController::class, 'index'])->name('index');
            Route::get('print', [OrderController::class, 'print'])->name('print');
        });
    });

    Route::name('transaction.')->prefix('transaction')->group(function () {
        Route::get('print-invoice', [InventoryController::class, 'printInvoice'])->name('print');
    });
});

Route::group(['middleware' => 'admin_or_stuff'], function () {
    Route::name('admin.')->prefix('admin')->group(function () {
        Route::name('party.')->prefix('party')->group(function () {
            Route::get('/', [PartyController::class, 'index'])->name('index');
            Route::get('/list', [PartyController::class, 'list'])->name('list');
            Route::post('/store', [PartyController::class, 'store'])->name('store');
            Route::get('/edit', [PartyController::class, 'edit'])->name('edit');
        });

        Route::name('unit.')->prefix('unit')->group(function () {
            Route::get('/', [UnitController::class, 'index'])->name('index');
            Route::get('/list', [UnitController::class, 'list'])->name('list');
            Route::post('/store', [UnitController::class, 'store'])->name('store');
            Route::get('/edit', [UnitController::class, 'edit'])->name('edit');
        });

        Route::name('brand.')->prefix('brand')->group(function () {
            Route::get('/', [BrandController::class, 'index'])->name('index');
            Route::get('/list', [BrandController::class, 'list'])->name('list');
            Route::post('/store', [BrandController::class, 'store'])->name('store');
            Route::get('/edit', [BrandController::class, 'edit'])->name('edit');
        });

        Route::name('product.')->prefix('product')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/list', [ProductController::class, 'list'])->name('list');
            Route::post('/store', [ProductController::class, 'store'])->name('store');
            Route::get('/edit', [ProductController::class, 'edit'])->name('edit');
        });

        Route::name('order.')->prefix('order')->group(function () {
            Route::get('/', [AdmiOrderController::class, 'index'])->name('index');
        });
    });



    Route::name('transaction.')->prefix('transaction')->group(function () {
        // common
        Route::post('store', [InventoryController::class, 'store'])->name('store');


        // purchase
        Route::get('purchase/create', [InventoryController::class, 'purchaseCreate'])->name('purchase.create');
        Route::get('purchase/list', [InventoryController::class, 'purchaseList'])->name('purchase.list');

        // purchase return
        Route::get('purchase-return/create', [InventoryController::class, 'purchaseReturnCreate'])->name('purchase_return.create');
        Route::get('purchase-return/list', [InventoryController::class, 'purchaseReturnList'])->name('purchase_return.list');

        // sell
        Route::get('sell/create', [InventoryController::class, 'sellCreate'])->name('sell.create');
        Route::get('sell/list', [InventoryController::class, 'sellList'])->name('sell.list');

        // sell return
        Route::get('sell-return/create', [InventoryController::class, 'sellReturnCreate'])->name('sell_return.create');
        Route::get('sell-return/list', [InventoryController::class, 'sellReturnList'])->name('sell_return.list');
    });

    // Reports
    Route::name('reports.')->prefix('reports')->group(function () {
        Route::name('inv_reports.')->prefix('inv-reports')->group(function () {
            Route::get('stock-report', [ReportController::class, 'stockReport'])->name('stock_report');
            Route::get('due-report', [ReportController::class, 'customerWiseDue'])->name('custome_wWise_due');
        });
    });
});

Route::name('admin.')->prefix('admin')->middleware('admin:admin')->group(function () {
    Route::name('user.')->prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/list', [UserController::class, 'list'])->name('list');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit', [UserController::class, 'edit'])->name('edit');
    });

    Route::name('category.')->prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/list', [CategoryController::class, 'list'])->name('list');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit', [CategoryController::class, 'edit'])->name('edit');
    });

    Route::name('sub_category.')->prefix('sub_category')->group(function () {
        Route::get('/', [CategoryController::class, 'sub_category_index'])->name('index');
        Route::get('/list', [CategoryController::class, 'sub_category_list'])->name('list');
    });
});

// common routes

Route::name('common.')->prefix('common')->group(function () {
    Route::get('get-subcategory', [CommonProductController::class, 'getSubcategory'])->name('get_subcategory');
    Route::get('get-product-details', [CommonProductController::class, 'getProductDetails'])->name('get_product_details');

    // live search
    Route::get('vendor-live-search', [CommonProductController::class, 'vendorLiveSearch'])->name('vendor_live_search');
    Route::get('customer-live-search', [CommonProductController::class, 'customerLiveSearch'])->name('customer_live_search');
    Route::get('product-live-search', [CommonProductController::class, 'productLiveSearch'])->name('product_live_search');
});

Route::get('invoice-setting', [InvoiceSettingController::class, 'index'])->name('invoice_setting');
Route::post('invoice-setting-store', [InvoiceSettingController::class, 'store'])->name('invoice_setting_store');

// project setting
Route::get('set', function () {
    Artisan::call('migrate');
    SidebarController::sidebar_write();
    return "success";
});


// developer helper
Route::get('session', function () {
    return session()->all();
});

Route::get('sidebar_write', [SidebarController::class, 'sidebar_write']);
