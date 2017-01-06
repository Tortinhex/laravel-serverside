<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth'], function() {
	// Resolve o get, post, put e delete automagicamente *apenas para o CRUD*
	Route::resource('client' , 'ClientController' , [ 'except' => ['create', 'edit'] ]);

	Route::group(['prefix' => 'project'], function() {
		Route::get(    ''      , 'ProjectController@index'  );
		Route::post(   ''      , 'ProjectController@store'  );
		Route::get(    '/{id}' , 'ProjectController@show'   );
		Route::delete( '/{id}' , 'ProjectController@destroy');
		Route::put(    '/{id}' , 'ProjectController@update' );

		Route::get('{id}/note'          , 'ProjectNoteController@index' );
		Route::post('{id}/note'          , 'ProjectNoteController@store' );
		Route::get('{id}/note/{noteId}' , 'ProjectNoteController@index' );
		Route::put('{id}/note/{noteId}' , 'ProjectNoteController@update');
		Route::delete('{id}/note/{noteId}' , 'ProjectNoteController@show'  );

	});

});

/*
    Route::get(    '/client'          , 'clientController@index');
	Route::post(   '/client'      , 'clientController@store'  );
	Route::get(    '/client/{id}' , 'clientController@show'   );
	Route::delete( '/client/{id}' , 'clientController@destroy');
	Route::put(    '/client/{id}' , 'clientController@update' );

	Route::get(    '/project/{id}/note'          , 'ProjectNoteController@index' );
	Route::post(   '/project/{id}/note'          , 'ProjectNoteController@store' );
	Route::get(    '/project/{id}/note/{noteId}' , 'ProjectNoteController@index' );
	Route::put(    '/project/{id}/note/{noteId}' , 'ProjectNoteController@update');
	Route::delete( '/project/{id}/note/{noteId}' , 'ProjectNoteController@show'  );

	Route::get(    '/project'      , 'ProjectController@index'  );
	Route::post(   '/project'      , 'ProjectController@store'  );
	Route::get(    '/project/{id}' , 'ProjectController@show'   );
	Route::delete( '/project/{id}' , 'ProjectController@destroy');
	Route::put(    '/project/{id}' , 'ProjectController@update' );
*/
