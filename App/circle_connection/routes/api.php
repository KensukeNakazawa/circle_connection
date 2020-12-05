<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;

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

Route::post('/login', [AuthController::class, 'index']);
Route::post('/register', [UserController::class, 'create']);


// ログインユーザーのみ
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    /** イベント系 */
    Route::get('/events/my_events/{user_id}', [EventController::class, 'getMyEvent']);
    Route::get('/events/participate_events/{user_id}', [EventController::class, 'getParticipateEvent']);
    Route::get('/events', [EventController::class, 'index']);
    Route::post('/events', [EventController::class, 'store']);
    Route::get('/events/{event_id}', [EventController::class, 'show']);
    Route::post('/event_participant', [EventController::class, 'addParticipant']);

    /** 検索系 */
    Route::get('/search/profiles', [SearchController::class, 'searchProfile']);
    Route::get('/search/get_search_items', [SearchController::class, 'getSearchItem']);
    /** プロフィール系 */
    Route::get('/profiles', [ProfileController::class, 'index']);
    Route::get('/profiles/{user_id}', [ProfileController::class, 'show']);


    /** マイページ系 */
    Route::post('/user/update_picture', [UserController::class, 'uploadProfilePicture']);
    Route::post('/user/update_sns_setting/{user_id}', [UserController::class, 'updateSnsSetting']);

    Route::get('/user_setting/{user_id}/edit', [UserController::class, 'editUserSetting']);
    Route::post('/user_setting', [UserController::class, 'updateUserSetting']);
    Route::get('/circle_setting/{user_id}/edit', [UserController::class, 'editCircleSetting']);
    Route::post('/circle_setting', [UserController::class, 'updateCircleSetting']);

});




