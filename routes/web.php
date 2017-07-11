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

Route::get( '/', function () {
	return view( 'welcome' );
} );

Auth::routes();

Route::get( '/overview', function () {
    return view( 'overview' );
} );

Route::get( '/about', function () {
    return view( 'about' );
} );

Route::get( '/home', 'HomeController@index' )->name( 'home' );
Route::get( 'proto/microtask', function () {
	return view('proto.microtask');
} );
Route::group( [ 'prefix' => 'tasks' ], function () {
	Route::get( '/', 'TaskController@index' );
    Route::get( '/{id}', 'TaskController@show' );
	Route::post( '{task}/feedback', 'TaskController@storeFeedback' );
} );
Route::group( [ 'prefix' => 'facets' ], function () {
	Route::get('/', 'TaskController@allFacets' );
    Route::get('/{slug}', 'TaskController@singleFacet' );
} );

Route::group( [ 'prefix' => 'sources' ], function () {
    Route::get('/', 'TaskController@allSources' );
    Route::get('/{slug}', 'TaskController@singleSource' );
} );

Route::group( [ 'prefix' => 'quotes' ], function () {
    Route::get('/{id}', 'TaskController@quote' );
} );