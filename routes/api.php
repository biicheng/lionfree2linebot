<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/linebot', 'LineBotT@postTest');

Route::post('/insertAPI', 'DataInsert_API@insertD_API');
Route::post('/messageStatusE', 'DataUpdateAPI@editMessageStatus');
Route::get('/messageDeleteAPI', 'DataDeletAPI@index')->name('messageDelete');

// bot_cms_imgFileMapsSele
Route::post('/imgMaps', 'seleDataAPI@seleImgMap');

//create img
Route::post('/creatImgAPI', 'insertDataAPI@inserImgData');

//Route::get('/dbt', 'LineBotT@dbtest');
