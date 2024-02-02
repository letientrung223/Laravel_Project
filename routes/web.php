<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ProductController;
// use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\BlogsController;
use App\Http\Controllers\Frontend\BlogController;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\MemberController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Frontend\SearchController;





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

Route::get('/', [HomeController::class, 'index']);

Route::get('/homepage', [HomeController::class, 'index'])->name('home');
Route::get('/account', [AccountController::class, 'index'])->name('account');
Route::post('/account/update/{id}',[AccountController::class, 'updateAccount']);
Route::get('/account/my-product', [AccountController::class, 'showMyProduct'])->name('showMyProduct');
Route::get('/send-email', [MailController::class, 'sendEmail'])->name('sendEmail');
Route::get('view-blog/',[BlogController::class, 'index']);
Route::get('view-blog/blog-detail/{id}',[BlogController::class, 'showBlogDetail']);

//CART
Route::post('/add-to-cart/',[ CartController::class,'addToCart'])->name('addToCart');
Route::get('/cart', [CartController::class, 'showCart']);
Route::post('/cart', [CartController::class, 'handleCart']);
Route::get('/cart/checkout', [CartController::class, 'showCheckout'])->name('cartCheckout');

//SEARCH
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/searchbyPrice', [SearchController::class, 'searchByPrice'])->name('searchByPrice');
Route::post('/searchLike', [SearchController::class, 'searchCondition'])->name('searchLike');
Route::post('/searchPrice', [SearchController::class, 'searchPrice'])->name('searchPrice');


Route::group(['middleware' => 'memberNotLogin'], function () {
    
    Route::get('member/login', [MemberController::class, 'loginNavigate'])->name('memberLogin');
    Route::post('member/login', [MemberController::class, 'loginMember']);
    Route::get('member/register', [MemberController::class, 'registerNavigate']);
    Route::post('member/register', [MemberController::class, 'registerMember'])->name('memberRegister');
});


       
Route::get('member/logout', [MemberController::class, 'logoutNavigate'])->name('memberLogout');


Route::group(['middleware' => 'member'], function () {
    // PRODUCT
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.detail');
    Route::get('/account/my-product/add', [ProductController::class, 'addProduct'])->name('addProduct');
    Route::post('/account/my-product/add', [ProductController::class, 'insertProduct']);
    Route::get('/account/my-product/edit/{id}', [ProductController::class, 'editProduct'])->name('editProduct');;
    Route::post('/account/my-product/edit/{id}', [ProductController::class, 'updateProduct']);
    Route::get('/account/my-product/delete/{id}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');

    //BLOG
    Route::post('view-blog/blog-detail/rate',[BlogController::class, 'handleRate'])->name('handleRate');
    Route::post('view-blog/blog-detail/comment',[BlogController::class, 'handleComment'])->name('handleComment');

});

Auth::routes();

Route::group(['prefix' => 'admin','middleware' => ['admin']], function () {
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

    Route::get('country/list',[CountryController::class, 'index'])->name('country');
    Route::get('country/add-country',[CountryController::class, 'add'])->name('add-country');
    Route::post('country/add-country',[CountryController::class, 'insertCountry'])->name('insert-country');
    Route::get('country/delete/{id}',[CountryController::class, 'deleteCountry'])->name('delete-country');

    Route::get('blog/list',[BlogsController::class, 'index'])->name('blog');
    Route::get('blog/add-blog',[BlogsController::class, 'add'])->name('add-blog');
    Route::post('blog/add-blog',[BlogsController::class, 'insertBlog'])->name('inser-blog');
    Route::get('blog/delete/{id}',[BlogsController::class, 'deleteBlog'])->name('delete-blog');
    Route::get('blog/edit/{id}',[BlogsController::class, 'edit'])->name('edit-blog');
    Route::post('blog/edit/{id}',[BlogsController::class, 'update'])->name('update-blog');

    Route::get('/user',[UserController::class, 'index'])->name('user');
    Route::post('/user/{id}',[UserController::class, 'update']);

    Route::post('logout', function () {
    Auth::logout(); // Đăng xuất người dùng
    return redirect('/login'); // Chuyển hướng sau khi đăng xuất đến /login
})->name('admin.logout');

});


