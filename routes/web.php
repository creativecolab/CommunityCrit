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
        'HomeController@index', []
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


//Route::group( [ 'prefix' => 'devtest' ], function() {
//    Route::get('/submit/', function() { return view('proto/testsubmit');});
////    Route::get('/', 'TaskController@testDashboard' );
//    Route::get('/{id}', 'TaskController@testShow' );
//    Route::post( '/{task}/feedback', 'TaskController@testStoreResponse' );
//    Route::post( '{task}/skip', 'TaskController@skipQuestion' );
//    Route::post('/submit/new', 'TaskController@newTask');
//} );

Route::get( '/home', 'HomeController@index' )->name( 'home' );
Route::post( '/home/submit', 'TaskController@newsubmit' );

Route::group( [ 'prefix' => 'ideas' ], function() {
    Route::get('/submit/link/{id}', 'IdeaController@showSubmitLink');
    Route::get('/assess/{id}', 'IdeaController@showAssess');
    Route::get('/submit', 'IdeaController@showSubmit');
    Route::get('/combine', 'IdeaController@showCombination');
    Route::get('/comment/{id}', 'IdeaController@showComment');
    Route::get('/{id}', 'IdeaController@show');
    Route::get('/', 'IdeaController@index');
    Route::post( '/submit/new', 'IdeaController@submitIdea');
    Route::post( '/combine/new', 'IdeaController@combine' );
    Route::post( '/comment/{idea}/new', 'IdeaController@comment' );
    Route::post( '/assess/{idea}/new', 'IdeaController@assess');
    Route::post( '/submit/link/{idea}/new', 'IdeaController@submitLink');
} );

Route::group( [ 'prefix' => 'activities' ], function() {
    Route::match(['get', 'post'], 'dash', 'TaskController@dashboard');
    Route::get( 'img/{id}', 'TaskController@imageTest');
    Route::get( '/', 'TaskController@allActivities' );
    Route::get( '/{id}', 'TaskController@show' );
    Route::post( '/{task}/response', 'TaskController@storeResponse' );
    Route::post( '/{id}/skip', 'TaskController@skipQuestion' );
    Route::post( 'img/{task}/upload', 'TaskController@uploadImage');
} );

Route::group( ['prefix' => 'devtest' ], function() {
    Route::get( '/attach/{task}', 'TaskController@showConnect' );
    Route::get( '/', 'TaskController@mapTest');
    Route::post( '/attach/{task}/new', 'TaskController@connectTaskIdea' );
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
//Route::get('/presurvey', function () {
//    return view( 'survey/presurvey' );
//} );