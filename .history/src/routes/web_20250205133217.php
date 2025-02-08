<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Auth;

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

// Route::post('products/{product}/favorite',[ItemController::class,'toggleFavorite'])->name('products.favorite');
Route::post('product/{product}/favorite',[ItemController::class,'favorite'])->name('product.favorite');
Route::post('product/{product}/unfavorite',[ItemController::class,'unfavorite'])->name('product.unfavorite');

Route::post('products/{product}/Comments',[ItemController::class,'storeComment'])->name('comments.store');

Route::get('/purchase/address',[AuthController::class,'addressIndex'])->name('addressIndex');
Route::put('/purchase/address/{id}',[AuthController::class,'update'])->name('address.update');
Route::get('/purchase/{id}',[ItemController::class,'purchase'])->name('purchase');

});


