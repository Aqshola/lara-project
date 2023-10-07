<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
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
    return view('welcome');
});

Route::resource('product', ProductController::class)->missing(function () {
    return Redirect::route('product.index');
});
Route::resource('patient', PatientController::class)->missing(function () {
    return Redirect::route('patient.index');
});

Route::get('invoice/print/{id}', [InvoiceController::class, 'print'])->name('invoice.print');
Route::resource('invoice', InvoiceController::class)->missing(function () {
    return Redirect::route('invoice.index');
});
