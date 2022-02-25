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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/', function(){
	return response()->json(['message'	=>	'Welcome to ' . config('app.name')], 203);
});
Route::get('/v1', function(){
	return response()->json(['message'	=>	'Hello, thank you for connecting with v1 services'], 203);
});
Route::get('/auth/token', function (Request $request) {
	return response()->json(['error'=>'resource link not supported'], 403);
});

Route::middleware('guest')->group(function(){
	Route::post('/auth/token', [
		'as'	=> 'mobile.auth',
		'uses'	=> 'Api\AuthTokenController@store'
	]);

	Route::post('/auth/register', [
		'as'	=> 'auth.register',
		'uses'	=> 'Api\UsersApiController@store'
	]);
});

Route::middleware('auth:sanctum')->group(
	function() {
		Route::post('/logout', [ 'as'	=> 'api.logout', 'users'	=> 'AuthenticatedSessionController@destroy' ]); // not yet used

		Route::delete('/auth/token', [
			'as'	=> 'mobile.logout',
			'uses'	=> 'Api\AuthTokenController@destroy'
		]);

		// API sections
		Route::group(['prefix' => 'v1'], function(){
			Route::get('my-data', [
				'as'	=> 'sqlite.setup',
				'uses'	=> 'Api\MobileApiSchemaController@show',
			]);
		});

		// api routes
		Route::apiResource('v1/api-users', 'Api\UsersApiController');

	}
);