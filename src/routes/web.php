<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Requests\EmailVerificationRequest;
use Illuminate\Http\Request;


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
Route::get('/item/{item_id}',[ItemController::class,'show'])->name('item.show');

Route::middleware('auth')->group(function () {

Route::get('/search',[ItemController::class,'search'])->name('search');

Route::get('/mypage',[AuthController::class,'index'])->name('mypage');
Route::get('/mypage/profile',[AuthController::class,'edit'])->name('mypage.profile');
Route::post('/mypage/profile',[AuthController::class,'storeOrUpdate'])->name('profile.storeOrUpdate');

Route::get('/sell',[ItemController::class,'showSellForm'])->name('sell');
Route::post('/sell/store',[ItemController::class,'storeSellForm'])->name('store.sell');

Route::post('item/{item}/favorite',[ItemController::class,'favorite'])->name('item.favorite');
Route::post('item/{item}/unfavorite',[ItemController::class,'unfavorite'])->name('item.unfavorite');

Route::post('items/{item}/Comments',[ItemController::class,'storeComment'])->name('comments.store');

Route::get('/purchase/address/{item_id}',[AuthController::class,'addressIndex'])->name('addressIndex');
Route::put('/purchase/address/update/{item_id}',[AuthController::class,'update'])->name('address.update');

Route::get('/purchase', [StripePaymentController::class, 'purchase'])->name('purchase');
Route::post('/purchase/{item_id}',[StripePaymentController::class,'purchase'])->name('purchase.item');
Route::post('/charge', [StripePaymentController::class, 'charge'])->name('charge');
Route::post('checkout/store', [StripePaymentController::class, 'store'])->name('checkout.store');
Route::get('checkout/success',[StripePaymentController::class, 'success'])->name('checkout.success');
});


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->name('verification.notice');
