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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['as' => 'admin.', 'middleware' => ['auth','admin'], 'prefix' => 'admin' ], function(){
	Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
	/* category */
	Route::get('category/{category}/remove', 'CategoryController@remove')->name('category.remove');
	Route::get('category/trash', 'CategoryController@trash')->name('category.trash');
	Route::get('category/recover/{id}', 'CategoryController@recoverCat')->name('category.recover');

	/* product */
	Route::get('product/{product}/remove', 'ProductController@remove')->name('product.remove');
	Route::get('product/trash', 'ProductController@trash')->name('product.trash');
	Route::get('product/recover/{id}', 'ProductController@recoverProduct')->name('product.recover');
	Route::view('product/extras', 'admin.partials.extras')->name('product.extras');

	/* Profile */
	Route::get('profile/{profile}/remove', 'ProfileController@remove')->name('profile.remove');
	Route::get('profile/trash', 'ProfileController@trash')->name('profile.trash');
	Route::get('profile/recover/{id}', 'ProfileController@recoverProduct')->name('profile.recover');
	Route::view('profile/roles', 'admin.partials.extras')->name('profile.extras');
	Route::get('profile/states/{id?}', 'ProfileController@getStates')->name('profile.states');
	Route::get('profile/cities/{id?}', 'ProfileController@getCities')->name('profile.cities');

	Route::resource('product','ProductController');
	Route::resource('category','CategoryController');
	Route::resource('profile', 'ProfileController');
});