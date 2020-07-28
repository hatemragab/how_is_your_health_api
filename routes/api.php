<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//users api
Route::get('users', 'UserController@getAllUsers');
Route::post('createUsers', 'UserController@createUsers');
Route::post('userLogin', 'UserController@userLogin');
Route::post('getUserById', 'UserController@getUser');
Route::post('updateUser', 'UserController@updateUser');
Route::post('add_update_user_img', 'UserController@add_update_user_img');

// question api
Route::post('create_questions', 'QuestionsController@createQuestion');
Route::post('getAllQuestions', 'QuestionsController@getAllQuestions');



// answer api
Route::post('createAnswer', 'AnswerController@createAnswer');
Route::post('getAllAnswers', 'AnswerController@getAllAnswers');

