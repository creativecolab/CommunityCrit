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

//Route::get( '/', function () {
//	return view( 'welcome' );
//} );
Route::get( '/', function() {
    return redirect()->action(
        'TaskController@testShow', ['id' => 0]
    );
} );

Auth::routes();

//Route::get( '/overview', function () {
//    return view( 'overview' );
//} );
Route::get( '/overview', 'TaskController@overview' );

Route::get( '/about', function () {
    return view( 'about' );
} );

Route::get('/presurvey', function () {
    return view( 'survey/presurvey' );
} );

Route::group( [ 'prefix' => 'devtest' ], function() {
    Route::get('/{id}', 'TaskController@testShow' );
//    Route::get('/', 'TaskController@testDashboard' );
    Route::post( '/{task}/feedback', 'TaskController@testStoreResponse' );
    Route::post( '{task}/skip', 'TaskController@skipQuestion' );
} );

Route::get( '/home', 'HomeController@index' )->name( 'home' );
Route::get( 'proto/microtask', function () {
	return view('proto.microtask');
} );
//Route::group( [ 'prefix' => 'tasks' ], function () {
//	Route::get( '/', 'TaskController@index' );
//    Route::get( '/{id}', 'TaskController@testShow' );
//	Route::post( '{task}/feedback', 'TaskController@storeFeedback' );
//} );
//Route::group( [ 'prefix' => 'facets'] , function () {
//	Route::get('/', 'TaskController@allFacets' );
//    Route::get('/{slug}', 'TaskController@singleFacet' );
//} );
//
//Route::group( [ 'prefix' => 'sources', 'middleware' => ['auth'] ], function () {
//    Route::get('/', 'TaskController@allSources' );
//    Route::get('/{slug}', 'TaskController@singleSource' );
//} );
//
//Route::group( [ 'prefix' => 'quotes', 'middleware' => ['auth'] ], function () {
//    Route::get('/{id}', 'TaskController@quote' );
//} );
//
//Route::group( [ 'prefix' => 'survey', 'middleware' => ['auth'] ], function () {
////    Route::match(array('GET','POST'), '/{page}', 'SurveyController@index' );
//    Route::get('/{page}', 'SurveyController@index' );
//    Route::post( '/{user}/response', 'SurveyController@storeResponse' );
//} );
//
//Route::group( ['prefix' => 'projects', 'middleware' => ['web'] ], function() {
//    Route::get( '/', 'TaskController@allProjects' );
//    Route::get( '/questions/{id}', 'TaskController@show' );
//    Route::post( 'questions/{task}/feedback', 'TaskController@storeResponse' );
//    Route::post( 'questions/{task}/skip', 'TaskController@skipQuestion' );
//} );