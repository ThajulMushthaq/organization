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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::group(['middleware' => ['guest']], function () {
    Route::get('/', 'App\Http\Controllers\LoginController@login')->name('login');
    Route::post('/login', 'App\Http\Controllers\LoginController@validate_login');

    Route::get('/register', 'App\Http\Controllers\LoginController@register');
    Route::post('/register', 'App\Http\Controllers\LoginController@register_user');
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'App\Http\Controllers\DashboardController@home');

    Route::get('/logout', 'App\Http\Controllers\LoginController@do_logout')->name('logout.do_logout');
});
