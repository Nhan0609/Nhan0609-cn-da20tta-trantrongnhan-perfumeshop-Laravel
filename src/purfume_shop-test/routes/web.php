<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\FrontendController as AdminFrontendController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\SendMailController as FrontendSendMailController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\SendMailController;
use Illuminate\Auth\Notifications\ResetPassword;

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



//Giới thiệu website
Route::get('/views.interact.introduce', [FrontendController::class, 'viewintroduce']);
//Liên hệ
Route::get('/views.interact.contact', [FrontendController::class, 'viewcontact']);
//Đổi mật khẩu
Route::get('/change_password', [UserController::class, 'change_password']);
//Gửi mail đơn đặt hàng
Route::get('sendmail-bill', [FrontendSendMailController::class, 'sendmail_bill']);

//Frontend
//Trang chủ
Route::get('/', [FrontendController::class, 'index']);
//Danh mục
Route::get('category',[FrontendController::class, 'category']);
//Xem danh mục
Route::get('category/{slug}', [FrontendController::class, 'viewcategory']);
//Hiển thị sản phẩm có view cao
Route::get('category/{cate_slug}/{prod_slug}',[FrontendController::class, 'productview']);
//Hiển thị sản phẩm mới cập nhật
// Route::get('newProducts', [FrontendController::class, 'newProducts']);
//Tìm kiếm sản phẩm
Route::post('timkiem', [FrontendController::class, 'search']);
//Hiển thị tất cả sản phẩm
Route::get('allprod', [FrontendController::class, 'allprod']);
//Bảng báo giá
Route::get('quotation', [FrontendController::class,'quotation']);



// Auth
Auth::routes();
//Hiển thị số lượng sản phẩm có trong giỏ hàng
Route::get('load-cart-data', [CartController::class, 'cartcount']);
//Hiển thị số lượng sản phẩm có trong danh sách yêu thích
Route::get('load-wishlist-count', [CartController::class, 'wishlistcount']);

//Home
Route::get('/home', [FrontendController::class, 'index'])->name('/login');

//Thêm vào giỏ hàng
Route::post('add-to-cart',[CartController::class, 'addProduct']);
//Xóa khỏi giỏ hàng
Route::post('delete-cart-item', [CartController::class, 'deleteproduct']);
//Cập nhật số lượng và giá trong giỏ hàng
Route::post('update-cart', [CartController::class, 'updatecart']);
//Thêm sản phẩm vào danh sách yêu thích
Route::post('add-to-wishlist', [WishlistController::class, 'add']);
//Xóa sản phẩm khỏi danh sách yêu thích
Route::post('delete-wishlist-item', [WishlistController::class, 'deleteitem']);
//Giỏ hàng
Route::get('cart', [CartController::class, 'viewcart']);
//Thanh toán
Route::get('checkout', [CheckoutController::class, 'index']);
//Đặt hàng
Route::post('place-order', [CheckoutController::class, 'placeorder']);
//Xu ly ket qua tra ve cua API Pay
Route::get('return-payment', [CheckoutController::class, 'returnPayment']);

Route::middleware(['auth'])-> group(function(){
   //Xem đơn hàng
   Route::get('my-orders', [UserController::class, 'index']);
   //Xem chi tiết đơn hàng
   Route::get('view-order/{id}', [UserController::class, 'view']);
   //Danh sách yêu thích
   Route::get('wishlist', [WishlistController::class, 'index']);
});
 // Thông tin người dùng
Route::get('infor', [UserController::class, 'infor']);

Route::middleware(['auth', 'isAdmin'])->group(function () {
    //Trang chủ Admin
    Route::get('dashboard', [AdminFrontendController::class, 'index']);
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

    //Đơn đặt hàng
    Route::get('orders', [OrderController::class, 'index']);
    //Xem chi tiết đơn đặt hàng
    Route::get('admin/view-order/{id}', [OrderController::class, 'view']);
    //Cập nhật trạng thái đơn hàng
    Route::put('update-order/{id}', [OrderController::class, 'updateorder']);
    //Xem lịch sử đặt hàng
    Route::get('order-history', [OrderController::class, 'orderhistory']);
    //Hiển thị thông tin User
    Route::get('users', [DashboardController::class, 'users']);
    //Xem thông tin User
    Route::get('view-users/{id}', [DashboardController::class, 'viewuser']);
   //Hiển thị form tra cứu doanh thu
   Route::get('/revenue-form', [DashboardController::class, 'form']);
   //Tra cứu doanh thu theo ngày
   Route::post('/revenue-search-day', [DashboardController::class, 'search_day'])->name('revenue-search-day');
   //Tra cứu doanh thu theo tháng
   Route::post('/revenue-search-month', [DashboardController::class, 'search_month'])->name('revenue-search-month');
   //Tra cứu doanh thu theo quý
   Route::post('/revenue-search-quarter', [DashboardController::class, 'search_quarter'])->name('revenue-search-quarter');
   //Tra cứu doanh thu theo năm
   Route::post('/revenue-search-year', [DashboardController::class, 'search_year'])->name('revenue-search-year');
});

