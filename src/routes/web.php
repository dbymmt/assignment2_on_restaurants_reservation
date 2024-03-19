<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\MypageController;
use App\Http\Controllers\Owner\HomeController as OwnerHomeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\Owner\MemberOnlyNotificationController;
use App\Http\Controllers\User\NotificationExitController;

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

    // ログアウト
    Route::post('/logout', [MypageController::class, 'logout'])->name('logout');

    // ログイン認証後
    Route::middleware('auth:user')->group(function () {

        // Route::resource('home', 'HomeController', ['only' => 'index']);

        // TOPページ
        Route::get('/mypage', [MypageController::class, 'index'])->name('mypage');
        // お気に入り機能
        Route::post('/mypage/favoriteAdd/{id}', [MypageController::class, 'favoriteAdd']);
        Route::delete('/mypage/favoriteDelete/{id}', [MypageController::class, 'favoriteDelete']);
        // 予約機能
        Route::post('/mypage/reservationAdd', [MypageController::class, 'reservationAdd']);
        Route::post('/mypage/reservationEdit', [MypageController::class, 'reservationEdit']);
        Route::delete('/mypage/reservationDelete', [MypageController::class, 'reservationDelete']);
        // レビュー機能
        Route::post('/review/reviewAdd', [ReviewController::class, 'reviewAdd']);

        // メルマガ解約機能
        Route::get('/mail/exit', [NotificationExitController::class, 'exitMail']);
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
        Route::get('home', [OwnerHomeController::class, 'index'])->name('home');
        Route::get('detail/{id}', [OwnerHomeController::class, 'detail'])->name('detail');
        Route::post('/restaurantAdd', [OwnerHomeController::class, 'restaurantAdd']);
        Route::post('/restaurantEdit', [OwnerHomeController::class, 'restaurantEdit']);
        Route::delete('/restaurantDelete', [OwnerHomeController::class, 'restaurantDelete']);

        // お知らせメール
        Route::get('/MemberOnlyNotification', [MemberOnlyNotificationController::class, 'index'])->name('mailIndex');
        Route::post('/MemberOnlyNotification/sendMail', [MemberOnlyNotificationController::class, 'sendMail'])->name('sendMail');
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
        // Route::resource('home', 'HomeController', ['only' => 'index']);
        Route::get('home', [AdminHomeController::class, 'index'])->name('home');
        Route::post('ownerAdd', [AdminHomeController::class, 'ownerAdd']);
    });
});


// ユーザー登録、ログイン
Route::get('/login', [App\Http\Controllers\User\Auth\LoginController::class, 'showLoginForm']);
Route::get('/register', [App\Http\Controllers\User\Auth\RegisterController::class, 'showRegistrationForm']);

// 検索部
Route::get('/', [IndexController::class, 'index']);
Route::get('/search', [IndexController::class, 'search']);

// 詳細
Route::get('/detail/{id}', [IndexController::class, 'detail']);

// レビュー
Route::get('/review/{id}', [ReviewController::class, 'review'])->name('review');

Route::get('/thanks', [MypageController::class, 'thanks']);

// マイページ用
Route::get('/mypage', [MypageController::class, 'index']);


// Route::get('/', function () {
//     return view('welcome');
// });
