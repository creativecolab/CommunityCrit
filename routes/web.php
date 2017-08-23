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

// // Route::group ( ['middleware' => 'checkUser'], function () {
//     Route::get('/', 'TaskController@showRandomTask');
// // }

Route::get( '/', function() {
    if (Auth::check()) {
        return redirect()->route('overview');
        // return redirect()->action(
            // 'TaskController@showRandomTask', []);
    }
    else {
        return view('welcome');
    }
} );

Auth::routes();

//Route::get( '/overview', function () {
//    return view( 'overview' );
//} );
Route::get( '/overview', function () {
    return view( 'landing' );
} )->name('overview');

Route::get( '/about', function () {
    return view( 'about' );
} );

Route::get( '/privacy-policy', function () {
    return view( 'privacypolicy' );
} );

//Route::group( [ 'prefix' => 'devtest' ], function() {
//    Route::get('/submit/', function() { return view('proto/testsubmit');});
////    Route::get('/', 'TaskController@testDashboard' );
//    Route::get('/{id}', 'TaskController@testShow' );
//    Route::post( '/{task}/feedback', 'TaskController@testStoreResponse' );
//    Route::post( '{task}/skip', 'TaskController@skipQuestion' );
//    Route::post('/submit/new', 'TaskController@newTask');
//} );

// Route::get( '/home', 'HomeController@index' )->name( 'home' );
// Route::post( '/home/submit', 'TaskController@newsubmit' );
// Route::get( 'my-contributions', 'PersonalController@showMyFeedback');

Route::group( ['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get( '/summary/users/{daily?}', 'AdminController@showUserSummary' );
    Route::get( '/summary/submissions', 'AdminController@showSubmissionSummary' );
    Route::get( '/idea-names', 'AdminController@showIdeaNames' );
    Route::post('/idea-names/submit', 'AdminController@updateNames' );
});

Route::group( ['prefix' => 'moderation', 'middleware' => 'admin'], function() {
    Route::get( '/pending', 'AdminController@showPending' );
    Route::get( '/show/{status}', 'AdminController@showByStatus' );
    Route::get( '/update/{status}', 'AdminController@showUpdateByStatus' );

    Route::post( '/pending/ideas/save', 'AdminController@savePendingIdeas' );
    Route::post( '/pending/links/save', 'AdminController@savePendingLinks' );
    Route::post( '/update/{status}/ideas/save', 'AdminController@updateIdeasStatus' );
    Route::post( '/update/{status}/links/save', 'AdminController@updateLinksStatus' );
    Route::post( '/update/{status}/feedbacks/save', 'AdminController@updateFeedbacksStatus' );
    Route::post( '/update/{status}/questions/save', 'AdminController@updateQuestionsStatus' );
} );

Route::group( ['middleware' => 'checkUser' ], function() {
    Route::get( '/my-contributions', 'UserController@showMyFeedback')->name( 'my-contributions' );
    Route::get( '/exit', 'UserController@showExit')->name( 'exit' );
});

Route::group (['prefix' => 'ideas', 'middleware' => 'checkUser'], function () {
    Route::get('/submit/link/{id}', 'IdeaController@showSubmitLink');
    Route::get('/assess/{id}', 'IdeaController@showAssess');
    Route::get('/submit', 'IdeaController@showSubmitIdea')->name('submit-idea'); // submit a new idea
    Route::get('/combine', 'IdeaController@showCombination');
    // Route::get('/comment/{id}', 'IdeaController@showComment');
    Route::post( '/submit/new', 'IdeaController@submitIdea');
    Route::post( '/combine/new', 'IdeaController@combine' );
    // Route::post( '/comment/{idea}/new', 'IdeaController@comment' );
    Route::post( '/comment/{idea}/new', 'IdeaController@submitComment' );
    Route::post( '/assess/{idea}/new', 'IdeaController@assess');
});

Route::group( [ 'prefix' => 'ideas' ], function() {
    Route::get('/', 'IdeaController@index')->name( 'ideas' );
    Route::get('/{id}', 'IdeaController@show');
} );

// Route::group (['prefix' => 'links', 'middleware' => 'checkUser'], function () {
    
// });

Route::group( ['prefix' => 'activities', 'middleware' => 'checkUser' ], function() {
    Route::get( '/random/{idea_id?}', 'TaskController@showRandomTask')->name( 'do' );
    Route::get( '/menu', 'TaskController@showIdeaSelect')->name('main-menu');
    Route::get( '/summary', 'TaskController@showSummary');
    // Route::get( '/list', 'TaskController@allActivities' );
    // Route::get( '/{task_id}', 'TaskController@showTask');
    // Route::get( '/{task_id}/{idea_id}', 'TaskController@showTask');
    // Route::get( '/{task_id}/{idea_id}/{link_id}', 'TaskController@showTask');
    // Route::get( '/{task_id}/{idea_id?}/{link_id?}/{ques_id?}', function ($task_id, $idea_id = 0, $link_id = 0, $ques_id = 0) {
    //     return action('TaskController@showTask', ['task_id' => $task_id, 'idea_id' => $idea_id, 'link_id' => $link_id, 'ques_id' => $ques_id]);
    // })->name('show-task');
    Route::get( '/{task_id}/{idea_id?}/{link_id?}/{ques_id?}', 'TaskController@showTask')->name('show-task');
    
    // Route::get( '/eval', 'TaskController@showTaskOfTypeCat');
    // Route::get( '/{task_id}/{idea_id}', 'TaskController@showTask')->name('show-task');
    // Route::get( '/{task_id}', 'TaskController@showTask')->name('show-task');
    // Route::get( '/build/{task_id}/{idea_id}', 'TaskController@showElaborate');
    // Route::get( 'img/{id}', 'TaskController@imageTest');
    // Route::get( '/{id}', 'TaskController@show' );
    // Route::get( '/submit', function () {
    //     return redirect( '/activities/2/0/0' );}
    // )->name('submit');

    Route::match(['get', 'post'], '/dash', 'TaskController@dashboard');

    // POST methods
    Route::post( '/{task}/response', 'TaskController@storeResponse' );
    Route::post( '/{id}/skip', 'TaskController@skipQuestion' );
    Route::post( 'img/{task}/upload', 'TaskController@uploadImage');
    // activity center
    // Route::post( '/submit/select', 'TaskController@submitTask' );
    // Route::post( '/track/show', 'TaskController@createTaskHist' );
    Route::post( '/submit/feedback/new', 'TaskController@submitText' );
    Route::post( '/submit/idea/new', 'TaskController@submitIdea' );
    Route::post( '/submit/rating/new', 'TaskController@submitRatings' );
    Route::post( '/submit/link/new', 'TaskController@submitLink' );
    Route::post( '/submit/question/new', 'TaskController@submitQuestion' );
    Route::post( '/submit/ratetext/new', 'TaskController@submitRatingAndText' );
    Route::post( '/skip/{idea_id?}', 'TaskController@trackSkip' )->name('skip');
} );

Route::post( '/ajax/timer', 'TaskController@ajaxTimer' );
Route::post( '/ajax/ideas', 'TaskController@ajaxIdeas' );
//Route::group( ['prefix' => 'devtest'], function() {
//    Route::get( '/attach/{task}', 'TaskController@showConnect' ); // attaches idea and task
//    Route::get( '/', 'TaskController@showIdeaSelect')->name('main-menu');
//    Route::post( '/attach/{task}/new', 'TaskController@connectTaskIdea' );
//} );

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