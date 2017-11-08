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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/chat/{id}', 'HomeController@chat')->name('chat');
Route::get('/group/chat/{id}', 'HomeController@groupChat')->name('group.chat');

Route::post('/chat/message/send', 'HomeController@send')->name('chat.send');
Route::post('/chat/message/send/file', 'HomeController@sendFilesInConversation')->name('chat.send.file');
Route::post('/group/chat/message/send', 'HomeController@groupSend')->name('group.send');
Route::post('/group/chat/message/send/file', 'HomeController@sendFilesInGroupConversation')->name('group.send.file');

Route::get('/accept/message/request/{id}' , function ($id){
    Chat::acceptMessageRequest($id);
    return redirect()->back();
})->name('accept.message');

Route::post('/trigger/{id}' , function (\Illuminate\Http\Request $request , $id) {
    Chat::startVideoCall($id , $request->all());
});

Route::post('/group/chat/leave/{id}' , function ($id) {
    Chat::leaveFromGroupConversation($id);
});

Auth::routes();