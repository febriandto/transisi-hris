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

	Route::get('/logout', 'BerandaController@logout')->name('logout');

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

        Route::group(['prefix' => 'binlocation'], function(){

	        Route::group(['prefix' => 'warehousezone'], function(){
	        	Route::get('/', 'WarehouseZoneController@index')->name('warehousezone.index');
		        Route::get('/trash', 'WarehouseZoneController@index')->name('warehousezone.trash');
	          Route::get('/{id}/edit', 'WarehouseZoneController@edit')->name('warehousezone.edit');
	          Route::patch('/{id}/edit', 'WarehouseZoneController@perbarui')->name('warehousezone.perbarui');
	          Route::patch('{id}/restore', 'WarehouseZoneController@restore')->name('warehousezone.restore');
	          Route::delete('{id}/hapus', 'WarehouseZoneController@hapus')->name('warehousezone.hapus');
	          Route::post('/datatables', 'WarehouseZoneController@datatables')->name('warehousezone.datatables');
	          Route::post('/simpan', 'WarehouseZoneController@simpan')->name('warehousezone.simpan');
	        });

	        Route::group(['prefix' => 'warehouserow'], function(){
	        	Route::get('/', 'WarehouseRowController@index')->name('warehouserow.index');
		        Route::get('/trash', 'WarehouseRowController@index')->name('warehouserow.trash');
	          Route::get('/{id}/edit', 'WarehouseRowController@edit')->name('warehouserow.edit');
	          Route::patch('/{id}/edit', 'WarehouseRowController@perbarui')->name('warehouserow.perbarui');
	          Route::patch('{id}/restore', 'WarehouseRowController@restore')->name('warehouserow.restore');
	          Route::delete('{id}/hapus', 'WarehouseRowController@hapus')->name('warehouserow.hapus');
	          Route::post('/datatables', 'WarehouseRowController@datatables')->name('warehouserow.datatables');
	          Route::post('/simpan', 'WarehouseRowController@simpan')->name('warehouserow.simpan');
	        });

	        Route::group(['prefix' => 'warehouse'], function(){
	        	Route::get('/', 'WarehouseController@index')->name('warehouse.index');
		        Route::get('/trash', 'WarehouseController@index')->name('warehouse.trash');
	          Route::get('/{id}/edit', 'WarehouseController@edit')->name('warehouse.edit');
	          Route::patch('/{id}/edit', 'WarehouseController@perbarui')->name('warehouse.perbarui');
	          Route::patch('{id}/restore', 'WarehouseController@restore')->name('warehouse.restore');
	          Route::delete('{id}/hapus', 'WarehouseController@hapus')->name('warehouse.hapus');
	          Route::post('/datatables', 'WarehouseController@datatables')->name('warehouse.datatables');
	          Route::post('/simpan', 'WarehouseController@simpan')->name('warehouse.simpan');
	        });

	        Route::group(['prefix' => 'binlocation'], function(){
	        	Route::get('/', 'BinLocationController@index')->name('binlocation.index');
		        Route::get('/trash', 'BinLocationController@index')->name('binlocation.trash');
	          Route::get('/{id}/edit', 'BinLocationController@edit')->name('binlocation.edit');
	          Route::patch('/{id}/edit', 'BinLocationController@perbarui')->name('binlocation.perbarui');
	          Route::patch('{id}/restore', 'BinLocationController@restore')->name('binlocation.restore');
	          Route::delete('{id}/hapus', 'BinLocationController@hapus')->name('binlocation.hapus');
	          Route::post('/datatables', 'BinLocationController@datatables')->name('binlocation.datatables');
	          Route::post('/simpan', 'BinLocationController@simpan')->name('binlocation.simpan');
	        });

	        Route::group(['prefix' => 'warehousearea'], function(){
	        	Route::get('/', 'WarehouseAreaController@index')->name('warehousearea.index');
		        Route::get('/trash', 'WarehouseAreaController@index')->name('warehousearea.trash');
	          Route::get('/{id}/edit', 'WarehouseAreaController@edit')->name('warehousearea.edit');
	          Route::patch('/{id}/edit', 'WarehouseAreaController@perbarui')->name('warehousearea.perbarui');
	          Route::patch('{id}/restore', 'WarehouseAreaController@restore')->name('warehousearea.restore');
	          Route::delete('{id}/hapus', 'WarehouseAreaController@hapus')->name('warehousearea.hapus');
	          Route::post('/datatables', 'WarehouseAreaController@datatables')->name('warehousearea.datatables');
	          Route::post('/simpan', 'WarehouseAreaController@simpan')->name('warehousearea.simpan');
	        });

	      });

    });

});
