<?php

use App\Http\Controllers\DashboardController;
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

Route::group(['prefix'=>'admin','name'=>'admin.','middleware' => 'admin:admin'], function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
});

Route::group(['prefix'=>'stuff','name'=>'stuff.','middleware' => 'stuff:stuff'], function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
});

Route::get('session', function(){
    return session()->all();
});
