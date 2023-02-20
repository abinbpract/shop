<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\ProfitController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth','is_admin')->group(function () {
    
Route::resource('/productcategories',ProductCategoryController::class);
Route::resource('/products',ProductController::class);
Route::resource('/transactions',TransactionController::class);
Route::post('api/getproducts', [TransactionController::class,'fetchProduct']);
Route::post('api/getprices', [TransactionController::class,'fetchRate']);
Route::resource('/parties',PartyController::class);
Route::resource('/results',ProfitController::class);
Route::post('api/getprofitproducts',[ProfitController::class,'fetchProduct']);
Route::post('api/getsalesprices', [ProfitController::class,'fetchRate']);
});
require __DIR__.'/auth.php';

