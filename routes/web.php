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

// Route::get('/', function () {
//     return view('app');
// });

Route::get('/forms', 'FormController@index');
Route::get('/getform/{formID}', 'FormController@getForm');
Route::get('/getresponse/{formID}', 'FormController@getResponse')->name('pdf.response');
Route::get('/sendemail/{formID}', 'FormController@sendEmail');
Route::view('/{path?}', 'app');