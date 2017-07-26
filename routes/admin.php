<?php

Route::get( '/', '\Backpack\Base\app\Http\Controllers\AdminController@redirect' );
Route::get( 'dashboard', '\Backpack\Base\app\Http\Controllers\AdminController@dashboard' );
CRUD::resource( 'feedback', 'FeedbackCrudController' );
CRUD::resource( 'tasks', 'TaskCrudController' );
CRUD::resource( 'sources', 'SourceCrudController' );
CRUD::resource( 'users', 'UserCrudController' );
CRUD::resource( 'options', 'OptionCrudController' );
CRUD::resource( 'ideas', 'IdeaCrudController' );
