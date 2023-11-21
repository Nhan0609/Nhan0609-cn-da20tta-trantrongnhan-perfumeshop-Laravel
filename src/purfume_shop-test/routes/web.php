<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FrontendController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

//Frontend
Route::get('/', [FrontendController::class, 'index']);
Route::get('category',[FrontendController::class, 'category']);
Route::get('category/{slug}', [FrontendController::class, 'viewcategory']);
Route::get('category/{cate_slug}/{prod_slug}',[FrontendController::class, 'productview']);

// Auth
Auth::routes();
Route::get('/home', [FrontendController::class, 'index'])->name('/login');

//Thêm vào giỏ hàng
Route::post('add-to-cart',[CartController::class, 'addProduct']);
//Xóa khỏi giỏ hàng
Route::post('delete-cart-item', [CartController::class, 'deleteproduct']);
//Cập nhật số lượng và giá trong giỏ hàng
Route::post('update-cart', [CartController::class, 'updatecart']);
//Giỏ hàng
Route::middleware(['auth'])-> group(function(){
   Route::get('cart',[CartController::class, 'viewcart']);
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    //Trang chủ
    Route::get('/dashboard', [FrontendController::class, 'index']);

    //Category
    Route::get('categories', [CategoryController::class, 'index']);
    // Thêm 
    Route::get('add-category', [CategoryController::class, 'add']);
    Route::post('insert-category', [CategoryController::class, 'insert']);
    // Sửa
    Route::get('edit-category/{id}', [CategoryController::class, 'edit']);
    Route::put('update-category/{id}', [CategoryController::class, 'update']);
    //Xóa
    Route::get('delete-category/{id}', [CategoryController::class, 'detroy']);

    //Product
    Route::get('products',[ProductController::class, 'index']);
    //Thêm
    Route::get('add-products',[ProductController::class, 'add']);
    Route::post('insert-product',[ProductController::class, 'insert']);
    //Sửa
    Route::get('edit-product/{id}',[ProductController::class, 'edit']);
    Route::put('upload-product/{id}', [ProductController::class, 'upload']);
    //Xóa
    Route::get('delete-product/{id}', [ProductController::class, 'destroy']);
});

