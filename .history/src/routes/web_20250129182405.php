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

Route::get('/mypage/profile',[AuthController::class,'edit'])->name('mypage.profile');
Route::post('/mypage/profile', [AuthController::class, 'store'])->name('mypage.store');
Route::post('/mypage/profile/images',[AuthController::class,'images'])->name('mypage.images');
Route::post('products/{product}/favorite',[ItemController::class,'togglefavorite'])->name('products.favorite');

Route::post('products/{product}/Comments',[ItemController::class,'store'])->name('comments.store');
});


