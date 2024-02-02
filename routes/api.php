<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\HomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::get('/view-blog',[BlogController::class, 'index']);
Route::get('/homepage',[HomeController::class, 'index']);

Route::post('member/login', [MemberController::class, 'loginMember']);
Route::get('member/login', [MemberController::class, 'loginNavigate'])->name('memberLogin');


Route::group(['prefix'=>'view-blog'],
    function(){
        Route::get('/',[BlogController::class, 'index']);
        Route::get('/blog-detail/{id}',[BlogController::class, 'showBlogDetail']);
        Route::post('/blog-detail/rate',[BlogController::class, 'handleRate'])->name('handleRate');
        Route::post('/blog-detail/comment',[BlogController::class, 'handleComment'])->name('handleComment');


});

