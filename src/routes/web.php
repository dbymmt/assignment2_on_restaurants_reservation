<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/done', function(){
    return view('done');
});

Route::get('/thanks', function(){
    return view('thanks');
});

Route::get('/login', function(){
    return view('auth.login');
});

Route::get('/register', function(){
    return view('auth.register');
});

Route::get('/', function(){
    return view('index');
});

Route::get('/detail', function(){
    return view('detail');
});

Route::get('/mypage', function(){
    return view('mypage');
});

// Route::get('/', function () {
//     return view('welcome');
// });
