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

Route::prefix('auth')->group(function () {
    Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');    
    Route::get('user', 'AuthController@user');  
    Route::group(['middleware' => 'auth:api'], function(){
        Route::post('logout', 'AuthController@logout');
        Route::post('change_password', 'AuthController@changePassword');
    });
});

Route::group(['middleware' => 'auth:api'], function(){
    Route::group(['middleware' => 'isRoot'], function(){
       
    });
    Route::group(['middleware' => 'isRootOrAdmin'], function(){
        Route::resource('user', 'MaUserController');
        Route::resource('period', 'MaPeriodController');
        Route::resource('candidat', 'MaCandidatController');
        Route::resource('candidat_period', 'TrCandidatPeriodController');
        Route::resource('period_vote', 'TrPeriodVoteController');
        Route::resource('period_vote_detail', 'TrPeriodVoteDetailController');
        Route::post('candidat/upload_ktp/{id}', 'MaCandidatController@uploadKTP');
        Route::post('candidat/upload_pas_foto/{id}', 'MaCandidatController@uploadPasFoto');
        Route::post('period/status/{id}', 'TrPeriodVoteController@statusVote');
        Route::get('period/{id}/candidat', 'TrCandidatPeriodController@candidat');
        Route::get('period/{id}/vote', 'TrPeriodVoteController@periodVote');
        Route::get('period_vote_detail/result/{id}', 'TrPeriodVoteDetailController@getResult');
    });
    Route::group(['middleware' => 'isUser'], function(){
       
    });
});

Route::get('ktp/{image}', 'FileController@ktp');
Route::get('pas_foto/{image}', 'FileController@pas_foto');