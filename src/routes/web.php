<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MypageController;

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
Route::get('/search', [HomeController::class, 'search']);
Route::get('/detail/{id}', [HomeController::class, 'detail']);
Route::get('/thanks', [MypageController::class, 'thanks'])->name('thanks');

Route::middleware('auth')->group(function () {
    Route::get('/mypage', [MypageController::class, 'index']);
});



// Route::get('/done', function(){
//     return view('done');
// });

// Route::get('/thanks', function(){
//     return view('thanks');
// });

// Route::get('/login', function(){
//     return view('auth.login');
// });

// Route::get('/register', function(){
//     return view('auth.register');
// });


// Route::get('/mypage', function(){
//     return view('mypage');
// });

// Route::get('/', function () {
//     return view('welcome');
// });
