<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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




Route::get('/', [HomeController::class, 'index'])->name('homeIndex');
Route::get('/search', [HomeController::class, 'search']);
Route::get('/detail/{id}', [HomeController::class, 'detail'])->name('homeDetail');

// Route::get('/', function(){
//     return view('index');
// });

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

// Route::get('/detail', function(){
//     return view('detail');
// });

// Route::get('/mypage', function(){
//     return view('mypage');
// });

// Route::get('/', function () {
//     return view('welcome');
// });
