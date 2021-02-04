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

Route::get('logear/{driver}', 'Auth\LoginController@redirectToProvider');
Route::get('logear/{driver}/callback', 'Auth\LoginController@handleProviderCallback');

//roles
Route::resource('roles', 'Rol\RolController', ['only' => ['index','show']]);

//users
Route::resource('users', 'User\UserController', ['except' => ['create','edit']]);
Route::get('users/login/manual', 'User\UserController@login');