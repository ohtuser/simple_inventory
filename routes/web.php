<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\Product\CategoryController;
use App\Http\Controllers\Product\UnitController;
use App\Http\Controllers\SidebarController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware'=>'admin_or_stuff_or_customer'], function(){
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
});

Route::group(['middleware'=>'admin_or_stuff'], function(){
    Route::name('admin.')->prefix('admin')->group(function(){
        Route::name('party.')->prefix('party')->group(function(){
            Route::get('/', [PartyController::class, 'index'])->name('index');
            Route::get('/list', [PartyController::class, 'list'])->name('list');
            Route::post('/store', [PartyController::class, 'store'])->name('store');
            Route::get('/edit', [PartyController::class, 'edit'])->name('edit');
        });

        Route::name('unit.')->prefix('unit')->group(function(){
            Route::get('/', [UnitController::class, 'index'])->name('index');
            Route::get('/list', [UnitController::class, 'list'])->name('list');
            Route::post('/store', [UnitController::class, 'store'])->name('store');
            Route::get('/edit', [UnitController::class, 'edit'])->name('edit');
        });
    });
});

Route::name('admin.')->prefix('admin')->middleware('admin:admin')->group(function () {
    Route::name('user.')->prefix('user')->group(function(){
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/list', [UserController::class, 'list'])->name('list');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit', [UserController::class, 'edit'])->name('edit');
    });

    Route::name('category.')->prefix('category')->group(function(){
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/list', [CategoryController::class, 'list'])->name('list');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit', [CategoryController::class, 'edit'])->name('edit');
    });

    Route::name('sub_category.')->prefix('sub_category')->group(function(){
        Route::get('/', [CategoryController::class, 'sub_category_index'])->name('index');
        Route::get('/list', [CategoryController::class, 'sub_category_list'])->name('list');
    });
});



// project setting
Route::get('set', function(){
    Artisan::call('migrate');
    SidebarController::sidebar_write();
    return "success";
});


// developer helper
Route::get('session', function(){
    return session()->all();
});

Route::get('sidebar_write', [SidebarController::class, 'sidebar_write']);


