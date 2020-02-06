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


Route::group(['middlewareGroup' => ['web']], function () {

	Auth::routes();

    Route::group(['middleware' => 'auth'], function () {

        Route::get('/', 'BerandaController@index')->name('beranda.index');
        Route::get('/dashboard', 'BerandaController@dashboard')->name('beranda.dashboard');

        Route::group(['prefix' => 'master'], function () {

	        Route::group(['prefix' => 'barang'], function () {
	            Route::get('/', 'MasterDataBarangController@index')->name('barang.index');
	            Route::get('/trash', 'MasterDataBarangController@index')->name('barang.trash');
	            Route::get('/{id}/edit', 'MasterDataBarangController@edit')->name('barang.edit');
	            Route::patch('/{id}/edit', 'MasterDataBarangController@perbarui')->name('barang.perbarui');
	            Route::patch('{id}/restore', 'MasterDataBarangController@restore')->name('barang.restore');
	            Route::delete('{id}/hapus', 'MasterDataBarangController@hapus')->name('barang.hapus');
	            Route::post('/datatables', 'MasterDataBarangController@datatables')->name('barang.datatables');
	            Route::post('/simpan', 'MasterDataBarangController@simpan')->name('barang.simpan');
	        });

        });

    });

});
