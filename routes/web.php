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

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    //Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    //Products
    Route::resource('/products', \App\Http\Controllers\ProductsController::class);
    //Categories
    Route::resource('/category', \App\Http\Controllers\CategoryController::class);
    //Sector
    Route::resource('/sector', \App\Http\Controllers\SectorController::class);
});
