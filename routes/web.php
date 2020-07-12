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

// Route::get('/{any?}', function (){
//     return view('app');
// })->where('any', '^(?!api\/)[\/\w\.-]*');

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();

Route::get('redirect', 'SocialAuthFacebookController@redirect')->middleware('cors');
Route::get('callback', 'SocialAuthFacebookController@callback');

Route::get('/{vue?}' , 'Controller@index')->where('vue', '[\/\w\.-]*')->middleware('auth');

// Route::get('/livenow', 'HomeController@list')->name('home');

// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/test', 'TestController@index');
// Route::get('/test1', 'TestController@fblogin');
// Route::get('/fbcallback', 'TestController@callback');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');




// Route::prefix('livenow')->group(function () {
//     Route::get('list', 'HomeController@list');
// });
