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
Route::get('/', 'HomeController@index')->name('home');

Route::get('/infoGet', 'Controller@infoD');


Route::get('/mmm', 'Mail\MailController@sendMailT');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dbt', 'LineBotT@dbT')->name('dbt');
// Route::get('/fileText', function(){
//     return view('fileText',[
//         'postT'=>false
//     ]);
// });
Route::post('/fileText', 'Controller@fileText')->name('fileText');


Route::get('/selectText', 'messageSeleController@index')->name('selectText');
Route::get('/insert', 'DataInsertController@index')->name('insert');
Route::post('/insert', 'DataInsertController@insertD')->name('insert');
Route::get('/edit/{utext?}', 'DataUpdateController@index');
Route::post('/editMessage', 'DataUpdateController@updateD')->name('update');
Route::post('/edit', 'DataUpdateController@editD')->name('edit');
// Route::get('/delet', 'DataDeletController@index')->name('delet');
Route::get('/messageDelete', 'DataDeletController@index')->name('messageDelete');
Route::get('/lineUser', 'LineUserListController@LineUserList')->name('lineUser');

Route::get('/manageBotImg', 'manageBotImgController@imgList')->name('manageBotImg');

