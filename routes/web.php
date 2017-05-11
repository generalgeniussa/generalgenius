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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'HomeController@index')->name('home');


Auth::routes();

Route::group(['prefix' => 'meetings'], function() {
   Route::get('/', 'MeetingController@index')->name('meetings:list');
   Route::get('/create', 'MeetingController@create')->name('meetings:create');
   Route::post('/create', 'MeetingController@store')->name('meetings:store');
   Route::get('/{meetingId}', 'MeetingController@edit')->name('meetings:edit');
   Route::put('/{meetingId}', 'MeetingController@update')->name('meetings:update');
   Route::get('/{meetingId}/attend', 'MeetingController@attend')->name('meetings:attend');
   Route::post('/{meetingId}/notes/add', 'MeetingController@addNote')->name('meetings:notes:add');
   Route::post('/{meetingId}/complete', 'MeetingController@complete')->name('meetings:complete');
   Route::get('/{meetingId}/confirm', 'MeetingController@confirm')->name('meetings:confirm');
   Route::get('/{meetingId}/cancel', 'MeetingController@cancel')->name('meetings:cancel');
});

Route::group(['prefix' => 'leads'], function() {
    Route::get('/', 'LeadController@index')->name('leads:list');
    Route::post('/', 'LeadController@index')->name('leads:list');
    Route::get('/create', 'LeadController@create')->name('leads:create');
    Route::post('/create', 'LeadController@store')->name('leads:store');
    Route::get('/{meetingId}', 'LeadController@edit')->name('leads:edit');
    Route::put('/{meetingId}', 'LeadController@update')->name('leads:update');
    Route::get('/{meetingId}/meeting', 'LeadController@createMeeting')->name('leads:make-meeting');
});