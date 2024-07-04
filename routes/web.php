<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminnController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KasirController;
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

// Routes for guests
Route::middleware(['guest'])->group(function(){
    Route::get('/login', [SesiController::class, 'index'])->name('login');
    Route::post('/login', [SesiController::class, 'login'])->name('login.submit');
});

// Routes for authenticated users
Route::middleware(['auth'])->group(function(){
    Route::get('/admin', [AdminnController::class, 'index'])->middleware('userAkses:admin')->name('admin');
    Route::get('/petugasgudang', [AdminController::class, 'petugasgudang'])->middleware('userAkses:petugasgudang')->name('petugasgudang');
    Route::resource('barang', BarangController::class);
    Route::resource('petugasgudang', BarangController::class);
    Route::get('/kasir', [KasirController::class, 'index'])->middleware('userAkses:kasir')->name('kasir');
    Route::post('/kasir/order', [KasirController::class, 'submitOrder']);
    Route::get('/kasir/order', [KasirController::class, 'showOrder']);
    Route::get('/logout', [SesiController::class, 'logout'])->name('logout');
    
    // New route for fetching chart data
    Route::get('/get-chart-data', [AdminnController::class, 'getChartData']);
});

// Home route
Route::get('/home', function () {
    return view('home');
})->name('home');
