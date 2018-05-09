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

Auth::routes();



Route::get('/bookings/edit/{id}/{event_id}', 'BookingController@edit')->middleware('auth.basic');
Route::get('/bookings/add/{event_id}', 'BookingController@add')->middleware('auth.basic');
Route::get('/bookings/history/{event_id}', 'BookingController@history')->middleware('auth.basic');
Route::get('/bookings/allUserList/{event_id}', 'BookingController@allUserList')->middleware('auth.basic');
Route::post('/bookings/create/{event_id}/{delegate_id}', 'BookingController@create')->middleware('auth.basic');
Route::get('/bookings/bookingList/{event_id}', 'BookingController@bookingList')->middleware('auth.basic');
Route::get('/bookings/checkedInList/{event_id}', 'BookingController@checkedInList')->middleware('auth.basic');
Route::post('/bookings/checkedIn/', 'BookingController@checkedIn')->middleware('auth.basic');
Route::post('/bookings/checkedOut/', 'BookingController@checkOut')->middleware('auth.basic');
Route::resource('bookings',  'BookingController'); 

Route::get('/passes/edit/{id}/{event_id}', 'PassController@passEdit')->middleware('auth.basic');
Route::post('/passes/passAmount', 'PassController@passAmount')->middleware('auth.basic');
Route::get('/passes/stat/{delegate_id}', 'PassController@stat')->middleware('auth.basic');
Route::post('/passes/postAjaxDelete', 'PassController@ajaxDelete')->middleware('auth.basic');
Route::get('/passes/create/{event_id}', 'PassController@create')->middleware('auth.basic');
Route::get('/passes/show-pass-list/{event_id}', 'PassController@index')->middleware('auth.basic');
Route::resource('passes',  'PassController'); 



Route::get('/events/stat/{event_id}', 'EventController@stat')->middleware('auth.basic');
Route::get('/events/asign/{event_id}', 'EventController@asignAdmin')->middleware('auth.basic');
Route::post('/events/postAjaxDelete', 'EventController@ajaxDelete')->middleware('auth.basic');
Route::post('/events/changeAdmin', 'EventController@changeAdmin')->middleware('auth.basic');
Route::resource('events',  'EventController'); 


Route::post('/users/changePassword','UserController@changePassword')->name('changePassword')->middleware('auth.basic');
Route::get('/users/resetPassword','UserController@resetPassword')->middleware('auth.basic');
Route::post('/users/postAjaxDelete', 'UserController@ajaxDelete')->middleware('auth.basic');
Route::post('/users/postAjaxChangeStatus', 'UserController@changeStatus')->middleware('auth.basic');
Route::get('/users', 'UserController@index')->middleware('auth.basic');




Route::get('/', 'HomeController@index')->middleware('auth.basic');