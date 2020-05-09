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

Route::get('/forgotpassword', function(){
	return view('auth.passwords.reset');
});

Route::group(['prefix' => 'profile'], function () {
		Route::get('/', 'ProfileController@index')->name('profile.index');
		Route::post('/perbarui', 'ProfileController@perbarui')->name('profile.perbarui');
		Route::post('/passwordreset', 'ProfileController@passwordreset')->name('profile.passwordreset');
});

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

	        Route::group(['prefix' => 'user'], function () {
	            Route::get('/', 'UserController@index')->name('user.index');
	            Route::get('/trash', 'UserController@index')->name('user.trash');
							Route::get('/{id}/edit', 'UserController@edit')->name('user.edit');
	            Route::patch('/{id}/edit', 'UserController@perbarui')->name('user.perbarui');
							Route::patch('{id}/restore', 'UserController@restore')->name('user.restore');
							Route::patch('/{id}/resetSave', 'UserController@resetSave')->name('user.resetSave');
	            Route::delete('{id}/hapus', 'UserController@hapus')->name('user.hapus');
	            Route::post('/datatables', 'UserController@datatables')->name('user.datatables');
	            Route::post('/simpan', 'UserController@simpan')->name('user.simpan');
	        });

				});

				// Tally
				Route::group(['prefix' => 'tally'], function () {

					// create
	        Route::group(['prefix' => 'create'], function () {
	            Route::get('/', 'Tally\CreateController@index')->name('tallycreate.index');
	            Route::get('/trash', 'Tally\CreateController@index')->name('tallycreate.trash');
	            Route::get('/{id}/edit', 'Tally\CreateController@edit')->name('tallycreate.edit');
	            Route::patch('/{id}/edit', 'Tally\CreateController@perbarui')->name('tallycreate.perbarui');
	            Route::patch('{id}/restore', 'Tally\CreateController@restore')->name('tallycreate.restore');
	            Route::delete('{id}/hapus', 'Tally\CreateController@hapus')->name('tallycreate.hapus');
	            Route::post('/datatables', 'Tally\CreateController@datatables')->name('tallycreate.datatables');
	            Route::post('/simpan', 'Tally\CreateController@simpan')->name('tallycreate.simpan');
	        });

				});

				// Customer
				Route::group(['prefix' => 'customer'], function () {

					// Customer Master
	        Route::group(['prefix' => 'master'], function () {
	            Route::get('/', 'Customer\CustomerMasterController@index')->name('customermaster.index');
	            Route::get('/trash', 'Customer\CustomerMasterController@index')->name('customermaster.trash');
	            Route::get('/{id}/edit', 'Customer\CustomerMasterController@edit')->name('customermaster.edit');
	            Route::patch('/{id}/edit', 'Customer\CustomerMasterController@perbarui')->name('customermaster.perbarui');
	            Route::patch('{id}/restore', 'Customer\CustomerMasterController@restore')->name('customermaster.restore');
	            Route::delete('{id}/hapus', 'Customer\CustomerMasterController@hapus')->name('customermaster.hapus');
	            Route::post('/datatables', 'Customer\CustomerMasterController@datatables')->name('customermaster.datatables');
	            Route::post('/simpan', 'Customer\CustomerMasterController@simpan')->name('customermaster.simpan');
	        });

				});
				
				// Warehouse
        Route::group(['prefix' => 'warehouse'], function(){

        	// Warehouse Plant
					Route::group(['prefix' => 'plant'], function(){
	        	Route::get('/', 'Warehouse\WarehousePlantController@index')->name('warehouseplant.index');
		        Route::get('/trash', 'Warehouse\WarehousePlantController@index')->name('warehouseplant.trash');
	          Route::get('/{id}/edit', 'Warehouse\WarehousePlantController@edit')->name('warehouseplant.edit');
	          Route::patch('/{id}/edit', 'Warehouse\WarehousePlantController@perbarui')->name('warehouseplant.perbarui');
	          Route::patch('{id}/restore', 'Warehouse\WarehousePlantController@restore')->name('warehouseplant.restore');
	          Route::delete('{id}/hapus', 'Warehouse\WarehousePlantController@hapus')->name('warehouseplant.hapus');
	          Route::post('/datatables', 'Warehouse\WarehousePlantController@datatables')->name('warehouseplant.datatables');
	          Route::post('/simpan', 'Warehouse\WarehousePlantController@simpan')->name('warehouseplant.simpan');
	        });

	        // Warehouse Zone
	        Route::group(['prefix' => 'zone'], function(){
	        	Route::get('/', 'Warehouse\WarehouseZoneController@index')->name('warehousezone.index');
		        Route::get('/trash', 'Warehouse\WarehouseZoneController@index')->name('warehousezone.trash');
	          Route::get('/{id}/edit', 'Warehouse\WarehouseZoneController@edit')->name('warehousezone.edit');
	          Route::patch('/{id}/edit', 'Warehouse\WarehouseZoneController@perbarui')->name('warehousezone.perbarui');
	          Route::patch('{id}/restore', 'Warehouse\WarehouseZoneController@restore')->name('warehousezone.restore');
	          Route::delete('{id}/hapus', 'Warehouse\WarehouseZoneController@hapus')->name('warehousezone.hapus');
	          Route::post('/datatables', 'Warehouse\WarehouseZoneController@datatables')->name('warehousezone.datatables');
	          Route::post('/simpan', 'Warehouse\WarehouseZoneController@simpan')->name('warehousezone.simpan');
	        });

	        // Warehouse Row
	        Route::group(['prefix' => 'row'], function(){
	        	Route::get('/', 'Warehouse\WarehouseRowController@index')->name('warehouserow.index');
		        Route::get('/trash', 'Warehouse\WarehouseRowController@index')->name('warehouserow.trash');
	          Route::get('/{id}/edit', 'Warehouse\WarehouseRowController@edit')->name('warehouserow.edit');
	          Route::patch('/{id}/edit', 'Warehouse\WarehouseRowController@perbarui')->name('warehouserow.perbarui');
	          Route::patch('{id}/restore', 'Warehouse\WarehouseRowController@restore')->name('warehouserow.restore');
	          Route::delete('{id}/hapus', 'Warehouse\WarehouseRowController@hapus')->name('warehouserow.hapus');
	          Route::post('/datatables', 'Warehouse\WarehouseRowController@datatables')->name('warehouserow.datatables');
	          Route::post('/simpan', 'Warehouse\WarehouseRowController@simpan')->name('warehouserow.simpan');
	        });

	        // Warehouse Name
	        Route::group(['prefix' => 'name'], function(){
	        	Route::get('/', 'Warehouse\WarehouseController@index')->name('warehouse.index');
		        Route::get('/trash', 'Warehouse\WarehouseController@index')->name('warehouse.trash');
	          Route::get('/{id}/edit', 'Warehouse\WarehouseController@edit')->name('warehouse.edit');
	          Route::patch('/{id}/edit', 'Warehouse\WarehouseController@perbarui')->name('warehouse.perbarui');
	          Route::patch('{id}/restore', 'Warehouse\WarehouseController@restore')->name('warehouse.restore');
	          Route::delete('{id}/hapus', 'Warehouse\WarehouseController@hapus')->name('warehouse.hapus');
	          Route::post('/datatables', 'Warehouse\WarehouseController@datatables')->name('warehouse.datatables');
	          Route::post('/simpan', 'Warehouse\WarehouseController@simpan')->name('warehouse.simpan');
	        });

	        // Warehouse Bin
	        Route::group(['prefix' => 'bin'], function(){
	        	Route::get('/', 'Warehouse\WarehouseBinController@index')->name('warehousebin.index');
		        Route::get('/trash', 'Warehouse\WarehouseBinController@index')->name('warehousebin.trash');
	          Route::get('/{id}/edit', 'Warehouse\WarehouseBinController@edit')->name('warehousebin.edit');
	          Route::patch('/{id}/edit', 'Warehouse\WarehouseBinController@perbarui')->name('warehousebin.perbarui');
	          Route::patch('{id}/restore', 'Warehouse\WarehouseBinController@restore')->name('warehousebin.restore');
	          Route::delete('{id}/hapus', 'Warehouse\WarehouseBinController@hapus')->name('warehousebin.hapus');
	          Route::post('/datatables', 'Warehouse\WarehouseBinController@datatables')->name('warehousebin.datatables');
	          Route::post('/simpan', 'Warehouse\WarehouseBinController@simpan')->name('warehousebin.simpan');
					});

					// Warehouse Location
					Route::group(['prefix' => 'location'], function(){
	        	Route::get('/', 'Warehouse\WarehouseLocationController@index')->name('warehouselocation.index');
		        Route::get('/trash', 'Warehouse\WarehouseLocationController@index')->name('warehouselocation.trash');
	          Route::get('/{id}/edit', 'Warehouse\WarehouseLocationController@edit')->name('warehouselocation.edit');
	          Route::patch('/{id}/edit', 'Warehouse\WarehouseLocationController@perbarui')->name('warehouselocation.perbarui');
	          Route::patch('{id}/restore', 'Warehouse\WarehouseLocationController@restore')->name('warehouselocation.restore');
	          Route::delete('{id}/hapus', 'Warehouse\WarehouseLocationController@hapus')->name('warehouselocation.hapus');
	          Route::post('/datatables', 'Warehouse\WarehouseLocationController@datatables')->name('warehouselocation.datatables');
	          Route::post('/simpan', 'Warehouse\WarehouseLocationController@simpan')->name('warehouselocation.simpan');
	        });

					// Warehouse Area
	        Route::group(['prefix' => 'area'], function(){
	        	Route::get('/', 'Warehouse\WarehouseAreaController@index')->name('warehousearea.index');
		        Route::get('/trash', 'Warehouse\WarehouseAreaController@index')->name('warehousearea.trash');
	          Route::get('/{id}/edit', 'Warehouse\WarehouseAreaController@edit')->name('warehousearea.edit');
	          Route::patch('/{id}/edit', 'Warehouse\WarehouseAreaController@perbarui')->name('warehousearea.perbarui');
	          Route::patch('{id}/restore', 'Warehouse\WarehouseAreaController@restore')->name('warehousearea.restore');
	          Route::delete('{id}/hapus', 'Warehouse\WarehouseAreaController@hapus')->name('warehousearea.hapus');
	          Route::post('/datatables', 'Warehouse\WarehouseAreaController@datatables')->name('warehousearea.datatables');
	          Route::post('/simpan', 'Warehouse\WarehouseAreaController@simpan')->name('warehousearea.simpan');
					});
					
					// Warehouse Pallet
					Route::group(['prefix' => 'pallet'], function(){
	        	Route::get('/', 'Warehouse\PalletController@index')->name('pallet.index');
		        Route::get('/trash', 'Warehouse\PalletController@index')->name('pallet.trash');
	          Route::get('/{id}/edit', 'Warehouse\PalletController@edit')->name('pallet.edit');
	          Route::patch('/{id}/edit', 'Warehouse\PalletController@perbarui')->name('pallet.perbarui');
	          Route::patch('{id}/restore', 'Warehouse\PalletController@restore')->name('pallet.restore');
	          Route::delete('{id}/hapus', 'Warehouse\PalletController@hapus')->name('pallet.hapus');
	          Route::post('/datatables', 'Warehouse\PalletController@datatables')->name('pallet.datatables');
	          Route::post('/simpan', 'Warehouse\PalletController@simpan')->name('pallet.simpan');
	        });

	      });

    });

});
