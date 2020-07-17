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

// Auth::routes();

Route::get('login', 'Controller@index')->name('login');

Route::get('redirect', 'SocialAuthFacebookController@redirect')->middleware('cors');
Route::get('callback', 'SocialAuthFacebookController@callback');

Route::get('/{vue?}' , 'Controller@index')->where('vue', '[\/\w\.-]*')->middleware('auth');
