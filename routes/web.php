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

Route::get('/', 'MiuController@miuGet');

Route::post('/', 'MiuController@miuPost');

Route::get('info', function(){
	phpinfo();
});

Route::get('test_bot_send', 'LineBotController@testBotSend');
