<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['prefix' => 'v1', 'middleware' => 'cors'], function () {
    // Route::get('redirect', 'SocialAuthFacebookController@redirect');
    // Route::get('callback', 'SocialAuthFacebookController@callback');
// });

Route::group(['middleware' => 'auth'], function() {

    Route::group(['prefix' => 'pages'], function(){
	    Route::get('/choose_page', 'PageController@list');
	    Route::post('/create_page', 'PageController@create');
	    Route::post('/', 'PageController@create');
    });

    Route::group(['prefix' => 'posts'], function(){
	    // Route::get('/choose_page', 'PageController@list');
	    // Route::post('/create_page', 'LiveController@create');
	    Route::get('/', 'LiveController@list');
    });

    Route::group(['prefix' => 'webhook'], function(){
	    Route::post('/create', 'WebhookController@create');
    });
});

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/livenow', 'HomeController@list')->name('home');

// Route::options('{any?}', function (){
//     return response('',200);
// })->where('any', '.*');


// Route::prefix('livenow')->group(function () {
//     Route::get('list', 'HomeController@list');
// });