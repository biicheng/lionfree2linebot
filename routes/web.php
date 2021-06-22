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
//     return view('welcome');
// });
Route::get('/', 'HomeController@index');

Route::get('/infoGet', 'Controller@infoD');


Route::get('/mmm', 'Mail\MailController@sendMailT');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dbt', 'LineBotT@dbT')->name('dbt');


Route::get('/select', 'DataSelectController@index')->name('select');
Route::post('/select', 'DataSelectController@editData')->name('select');
Route::get('/insert', 'DataInsertController@index')->name('insert');
Route::post('/insert', 'DataInsertController@insertD')->name('insert');
Route::get('/update/{utext?}', 'DataUpdateController@index');
Route::post('/update', 'DataUpdateController@updateD')->name('update');
Route::post('/edit', 'DataUpdateController@editD')->name('edit');
Route::get('/delet', 'DataDeletController@index')->name('delet');

