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
    return view('app');
});

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth'], function() {
	// Resolve o get, post, put e delete automagicamente *apenas para o CRUD*
	Route::resource('client'  , 'ClientController'  , [ 'except' => ['create', 'edit'] ]);
	Route::resource('project' , 'ProjectController' , [ 'except' => ['create', 'edit'] ]);

	Route::group(['prefix' => 'project'], function() {
		Route::get('{id}/note'			  , 'ProjectNoteController@index');
		Route::post('{id}/note'			  , 'ProjectNoteController@store');
		Route::get('{id}/note/{noteId}'   , 'ProjectNoteController@show');
		Route::put('{id}/note/{noteId}'   , 'ProjectNoteController@update');
		Route::delete('{id}/task/{taskId}', 'ProjectNoteController@destroy');

		Route::get('{id}/task'			    , 'ProjectTaskController@index');
		Route::get('{id}/task/{taskId}'     , 'ProjectTaskController@show');
		Route::post('{id}/task'		        , 'ProjectTaskController@store');
		Route::put('{id}/task/{taskId}'     , 'ProjectTaskController@update');
		Route::delete('{id}/task/{taskId}'  , 'ProjectTaskController@destroy');

		Route::get(   '{id}/members'                , 'ProjectMemberController@index');
		Route::post(  '{id}/addMember'              , 'ProjectMemberController@create');
		Route::delete('{id}/removeMember/{idMember}', 'ProjectMemberController@delete');
		
		Route::post('{id}/file'                , 'ProjectFileController@store');
	});
});
