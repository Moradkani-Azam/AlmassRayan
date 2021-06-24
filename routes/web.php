<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Role;
use App\Http\Controllers\OrderController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('orders', OrderController::class);
    Route::get('admin/orders', [OrderController::class, 'all'])->name('admin.orders.index');
    Route::get('admin/orders/{order}', [OrderController::class, 'single'])->name('admin.orders.single');
    Route::put('admin/orders/{order}/changeStatus', [OrderController::class, 'changeStatus'])->name('orders.changeStatus');
});
