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


Route::group(
    [
        'middleware' => ['binduser']

    ],
    function () {
        Route::get('/', 'UserController@index');
        Route::get('/user', 'UserController@user');
        Route::get('/rating_users/{id?}', 'UserController@ratingUsers');
        Route::post('/repost', 'RepostController@repost');
        Route::get('/gifts', 'GiftController@gifts');
        Route::get('/gifts_new', 'GiftController@giftsNew');
        Route::post('/save_marks', 'GiftController@saveMarks');
        Route::get('/list_stages', 'StageController@listStages');

    });

Route::group(
    [
        'prefix'     => 'admin',
        'middleware' => ['ip']

    ],
    function () {
        Route::get('/', 'AdminController@index');
        Route::get('/gifts', 'AdminController@gifts');
        Route::get('/parse_etsy_com/run_parse_url_gift/{page}', 'ParseEtsyComController@runParseUrlGift')->where('page', '[0-9]+');
        Route::get('/parse_etsy_com/run_parse_gift', 'ParseEtsyComController@runParseGift')->where('page', '[0-9]+');
        Route::get('/gifts/edit/{id}', 'AdminController@edit');
        Route::get('/gifts/destroy/{id}', 'AdminController@destroy');
        Route::post('/gifts/update/{id}', 'AdminController@update');
    });
