<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\SidebarController;
use App\Http\Controllers\UserController;
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

Route::name('admin.')->prefix('admin')->middleware('admin:admin')->group(function () {
    // Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::name('user.')->prefix('user')->group(function(){
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/list', [UserController::class, 'list'])->name('list');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit', [UserController::class, 'edit'])->name('edit');
    });
});

Route::group(['prefix'=>'stuff','name'=>'stuff.','middleware' => 'stuff:stuff'], function () {

});

Route::group(['middleware'=>'permission_check'], function(){
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::name('admin.')->prefix('admin')->group(function(){
        Route::name('party.')->prefix('party')->group(function(){
            Route::get('/', [PartyController::class, 'index'])->name('index');
            Route::get('/list', [PartyController::class, 'list'])->name('list');
            Route::post('/store', [PartyController::class, 'store'])->name('store');
            Route::get('/edit', [PartyController::class, 'edit'])->name('edit');
        });
    });
});

Route::get('session', function(){
    return session()->all();
});

Route::get('sidebar_write', [SidebarController::class, 'sidebar_write']);
