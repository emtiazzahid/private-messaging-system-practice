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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    return App\PrivateMessage::where('id',1)->get();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('get-private-message-notifications', 'PrivateMessageController@getUserNotifications');
Route::post('get-private-messages', 'PrivateMessageController@getPrivateMessages');
Route::post('get-private-message', 'PrivateMessageController@getPrivateMessageById');
Route::post('get-private-messages-sent', 'PrivateMessageController@getPrivateMessageSent');
Route::post('get-private-message', 'PrivateMessageController@sendPrivateMessage');



