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

Route::get('/auth/{username}/{password}/{imei}', 'ApiController@auth')->name('auth');

// OPNAME
Route::any('/get_app_version', 'ApiController@app_version')->name('app_version');

//GENERAL
Route::get('/get_pallet', 'ApiController@get_pallet')->name('get_pallet');
Route::get('/pallet_data', 'ApiController@pallet_data')->name('pallet_data');
Route::get('/vehicle_data', 'ApiController@vehicle_data')->name('vehicle_data');
Route::get('/loading_dock_data', 'ApiController@loading_dock_data')->name('loading_dock_data');
Route::get('/location_data', 'ApiController@location_data')->name('location_data');
Route::get('/item_data/{source}/{id}', 'ApiController@item_data')->name('item_data');

// TRANSFER
Route::post('/transfer_save', 'ApiController@transfer_save')->name('transfer_save');

// PICKING
Route::get('/picking_data', 'ApiController@picking_data')->name('picking_data');
Route::post('/picking_save', 'ApiController@picking_save')->name('picking_save');
Route::get('/picking_history', 'ApiController@picking_history')->name('picking_history');
Route::get('/picking_detail/{loading_no}', 'ApiController@picking_detail')->name('picking_detail');

// TALLY
Route::get('/tally_history', 'ApiController@tally_history')->name('tally_history');
Route::get('/tally_data/{mode}/{keyword}', 'ApiController@tally_data')->name('tally_data');
Route::get('/tally_data_detail/{tally_no}', 'ApiController@tally_data_detail')->name('tally_data_detail');
Route::post('/tally_save/{tally_no}', 'ApiController@tally_save')->name('tally_save');

Route::get('/tally_detail/{tally_no}', 'ApiController@tally_detail')->name('tally_detail');

// PUTAWAY
Route::get('/putaway_data/{mode}/{keyword}', 'ApiController@putaway_data')->name('putaway_data');
Route::get('/putaway_pallet_data', 'ApiController@putaway_pallet_data')->name('putaway_pallet_data');
Route::post('/putaway_pallet_save', 'ApiController@putaway_pallet_save')->name('putaway_pallet_save');
Route::get('/putaway_data_detail/{putaway_no}', 'ApiController@putaway_data_detail')->name('putaway_data_detail');
Route::post('/putaway_save/{putaway_no}', 'ApiController@putaway_save')->name('putaway_save');

// LOADING
Route::get('/loading', 'ApiController@loading_data')->name('loading_data');
Route::post('/loading_save', 'ApiController@loading_save')->name('loading_save');

// OPNAME
Route::any('/opname_save', 'ApiController@opname_save')->name('opname_save');

// DELIVERY
Route::get('/delivery_data', 'ApiController@delivery_data')->name('delivery_data');
Route::post('/delivery_save/{id}/{status}', 'ApiController@delivery_save')->name('delivery_save');