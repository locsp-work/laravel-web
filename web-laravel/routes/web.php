<?php

use Illuminate\Support\Facades\Route;

Route::any('/', 'GraphController@pageInfo')->name('home');
Route::any('/productInfo','GraphController@productInfo');
Route::get('/login','GraphController@login');

Route::any('/feedInfo','GraphController@feedInfo')->name('feedInfo');

Route::any('/feedInfo/edit','GraphController@editPost');

Route::any('/feedInfo/comments','GraphController@getComment')->name('comments');

Route::post('comments','GraphController@sendComment');

Route::any('/addPost','GraphController@addPost')->name('addPost');

Route::any('/fb-callback','GraphController@fbCallback')->name('callback');

Route::get('/chat','GraphController@chat')->name('chat');

Route::post('/chat','GraphController@chat');

Route::match(['get','post'],'/messages/{threadId}/{pageId}','GraphController@getMessage')->name('messages');

Route::match(['get','post'],'/messages','GraphController@sendMessage');

Route::any('/webhooks','GraphController@getMsg');

Route::any('/self_friend','GraphController@friend')->name('friend');

Route::any('/self_album','GraphController@album')->name('album');

Route::any('/self_status','GraphController@status')->name('status');

Route::match(['get','post'],'/config-chatbot-script','GraphController@chatbot')->name('chatbot');

Route::any('store-config','GraphController@store')->name('store');

Route::get('config-Info','GraphController@infoConfig')->name('infoCf');



