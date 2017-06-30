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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group( [ 'prefix' => 'tasks' ], function () {
	Route::get( '/', 'TaskController@index' );
	Route::post( '{task}/feedback', 'TaskController@storeFeedback' );
} );

Route::group([
	'prefix' => config('backpack.base.route_prefix', 'admin'),
	'middleware' => ['admin'],
	'namespace' => 'Admin'
], function() {
	// your CRUD resources and other admin routes here
	CRUD::resource('feedback', 'FeedbackCrudController');
	CRUD::resource('tasks', 'TaskCrudController');
	CRUD::resource('users', 'UserCrudController');
});
