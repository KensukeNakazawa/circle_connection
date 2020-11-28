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

Route::post('/login', 'AuthController@login');
Route::post('/register', 'UserController@create');


// ログインユーザーのみ
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/me', 'AuthController@me');
    Route::post('/logout', 'AuthController@logout');

    /** イベント系 */
    Route::get('/events/my_events/{user_id}', 'EventController@getMyEvent');
    Route::get('/events/participate_events/{user_id}', 'EventController@getParticipateEvent');
    Route::resource('events', 'EventController',  ['only' => ['index', 'show', 'store']]);
    Route::post('/event_participant', 'EventController@addParticipant');

    /** 検索系 */
    Route::get('/search/profiles', 'SearchController@searchProfile');
    Route::get('/search/get_search_items', 'SearchController@getSearchItem');
    /** プロフィール系 */
    Route::resource('profiles', 'ProfileController', ['only' => ['index', 'show']]);


    /** マイページ系 */
    Route::post('/user/update_picture', 'UserController@uploadProfilePicture');
    Route::post('/user/update_sns_setting/{user_id}', 'UserController@updateSnsSetting');

    Route::get('/user_setting/{user_id}/edit', 'UserController@editUserSetting');
    Route::post('/user_setting', 'UserController@updateUserSetting');
    Route::get('/circle_setting/{user_id}/edit', 'UserController@editCircleSetting');
    Route::post('/circle_setting', 'UserController@updateCircleSetting');

});




