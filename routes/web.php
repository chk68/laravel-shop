<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutusController;
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

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/category/{cat}', [ProductController::class,'showCategory'])->name('showCategory');
Route::get('/category/{cat}/{product_id}', [ProductController::class,'show'])->name('showProduct');
Route::get('/cart', [CartController::class,'index'])->name('cartIndex');
Route::get('/contact', [ContactController::class,'index'])->name('contactIndex');
Route::get('/aboutus', [AboutusController::class,'index'])->name('aboutusIndex');

Route::post('/add-to-cart', [CartController::class,'addToCart'])->name('addToCart');



