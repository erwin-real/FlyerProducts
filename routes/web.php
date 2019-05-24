<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', 'DashboardController@index');

Route::resource('products', 'ProductController');
Route::resource('attributes', 'AttributeController');

// ATTRIBUTES
//Route::get('/attributes/{attribute}','AttributeController@show');
Route::post('/attributes/{attribute}','AttributeController@store');
Route::get('/attributes/{attribute}/create','AttributeController@create');

// COMBINATIONS
Route::get('/combinations/{product}/create','CombinationController@create');
Route::post('/combinations/{product}','CombinationController@store');
Route::get('/combinations/{product}','CombinationController@index');

//Auth::routes();

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset');