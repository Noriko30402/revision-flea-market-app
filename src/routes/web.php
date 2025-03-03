<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Http\Controllers\StripePaymentController;

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

Route::get('/',[ItemController::class,'index'])->name('index');
Route::get('/item/{id}',[ItemController::class,'show'])->name('item.show');

Route::middleware('auth')->group(function () {

Route::get('/search',[ItemController::class,'search'])->name('search');

Route::get('/mypage',[AuthController::class,'index'])->name('mypage');
Route::get('/mypage/profile',[AuthController::class,'edit'])->name('mypage.profile');
Route::post('/mypage/profile',[AuthController::class,'storeOrUpdate'])->name('profile.storeOrUpdate');

Route::get('/sell',[ItemController::class,'showSellForm'])->name('sell');
Route::post('/sell/store',[ItemController::class,'storeSellForm'])->name('store.sell');

Route::post('product/{product}/favorite',[ItemController::class,'favorite'])->name('product.favorite');
Route::post('product/{product}/unfavorite',[ItemController::class,'unfavorite'])->name('product.unfavorite');

Route::post('products/{product}/Comments',[ItemController::class,'storeComment'])->name('comments.store');

Route::get('/purchase/address/{id}',[AuthController::class,'addressIndex'])->name('addressIndex');
Route::put('/purchase/address/update/{id}',[AuthController::class,'update'])->name('address.update');

Route::get('/purchase', [StripePaymentController::class, 'purchase'])->name('purchase');
Route::post('/purchase/{id}',[StripePaymentController::class,'purchase'])->name('purchase.product');
Route::post('/charge', [StripePaymentController::class, 'charge'])->name('charge');
Route::post('checkout/store', [StripePaymentController::class, 'store'])->name('checkout.store');
Route::get('checkout/success',[StripePaymentController::class, 'success'])->name('checkout.success');
});


