<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MypageController;
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


// ユーザー
Route::namespace('User')->prefix('user')->name('user.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:user')->group(function () {

        // TOPページ
        Route::resource('home', 'HomeController', ['only' => 'index']);
    });
});

// オーナー
Route::namespace('Owner')->prefix('owner')->name('owner.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:owner')->group(function () {

        // TOPページ
        Route::resource('home', 'HomeController', ['only' => 'index']);
    });
});

// 管理者
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:admin')->group(function () {

        // TOPページ
        Route::resource('home', 'HomeController', ['only' => 'index']);
    });
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/search', [HomeController::class, 'search']);
Route::get('/detail/{id}', [HomeController::class, 'detail']);
Route::get('/thanks', [MypageController::class, 'thanks'])->name('thanks');

Route::middleware('auth')->group(function () {
    Route::get('/mypage', [MypageController::class, 'index']);
    Route::post('/mypage/favoriteAdd/{id}', [MypageController::class, 'favoriteAdd']);
    Route::delete('/mypage/favoriteDelete/{id}', [MypageController::class, 'favoriteDelete']);
    Route::post('/detail/reservationAdd', [MypageController::class, 'reservationAdd']);
    Route::post('/mypage/reservationEdit', [MypageController::class, 'reservationEdit']);
    Route::delete('/mypage/reservationDelete', [MypageController::class, 'reservationDelete']);
});




// Route::get('/', function () {
//     return view('welcome');
// });
