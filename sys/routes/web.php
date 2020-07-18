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


Route::get('/hash', 'HashingController@hash');

Route::get('/forgotpassword', function(){
	return view('auth.passwords.reset');
});

Route::get('/register', function(){
	return view('auth.regitser');
});

//Profile
Route::group(['prefix' => 'profile'], function () {
		Route::get('/', 'ProfileController@index')->name('profile.index');
		Route::post('/perbarui', 'ProfileController@perbarui')->name('profile.perbarui');
		Route::post('/passwordreset', 'ProfileController@passwordreset')->name('profile.passwordreset');
});

// Middleware
Route::group(['middlewareGroup' => ['web']], function () {

	// Autentikasi
	Auth::routes();

	// Logout
	Route::get('/logout', 'BerandaController@logout')->name('logout');

		// sukses login goes here
    Route::group(['middleware' => 'auth'], function () {

        Route::get('/', 'BerandaController@dashboard')->name('beranda.dashboard');
        Route::get('/home', 'BerandaController@dashboard')->name('beranda.dashboard');
        Route::get('/dashboard', 'BerandaController@dashboard')->name('beranda.dashboard');

        // master
        Route::group(['prefix' => 'master'], function () {

        	
        	// master/barang
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


	        // master/user
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
					
					// All Tally Data
					Route::get('/', 'Tally\AllController@index')->name('tally.index');
					
					// Edit and Update data
					Route::get('/edit/{tally}', 'Tally\AllController@edit')->name('tally.edit');

					// update tally 
					Route::post('/edit', 'Tally\AllController@update')->name('tally.update');
					
					// Add new Tally and save it
					Route::get('/add', 'Tally\AllController@add')->name('tally.add');

					// Save new tally
					Route::post('/add', 'Tally\AllController@save')->name('tally.save');

					// Tally Detail
					Route::get('/detail/{tally}', 'Tally\AllController@show')->name('tally.show');

					// Filter tally by date
					Route::get('/filter', 'Tally\AllController@filter_date')->name('tally.filter_date');

					// Add item to tally
					Route::get('/add_item/{tally}', 'Tally\AllController@add_item')->name('tally.add_item');

					// Save an item
					Route::post('/save_item', 'Tally\AllController@save_item')->name('tally.save_item');

					// Edit item page
					Route::get('/edit_item/{tally}/{item}', 'Tally\AllController@edit_item')->name('tally.edit_item');

					// Update an item
					Route::post('/add_item', 'Tally\AllController@update_item')->name('tally.update_item');

					// Delete an item
					Route::post('/detail', 'Tally\AllController@delete_item')->name('tally.delete_item');

					// Set status tally to 'finish_tally'
					Route::post('/finish_tally', 'Tally\AllController@finish_tally')->name('tally.finish_tally');

				});



				// Putaway
				Route::group(['prefix' => 'putaway'], function(){

					// Show all putaway
					Route::get('/', 'Putaway\PutawayController@index')->name('putaway.index');
					
					// Putaway Detail
					Route::get('/putaway_detail/{putaway}/{tally}', 'Putaway\PutawayController@detail')->name('putaway.detail');

					// Add new putaway page
					Route::get('/add/{tally}', 'Putaway\PutawayController@add')->name('putaway.add');

					// Save putaway
					Route::post('/add', 'Putaway\PutawayController@save')->name('putaway.save');

					// Add item / Do Putaway page
					Route::get('/add_item/{tally_detail}/{tally}/{putaway}', 'Putaway\PutawayController@add_item')->name('putaway.add_item');

					// Save
					Route::post('/add_item', 'Putaway\PutawayController@save_item')->name('putaway.save_item');

					// Finish Putaway
					Route::post('/finish_putaway', 'Putaway\PutawayController@finish_putaway')->name('putaway.finish_putaway');

					// Filter tally by date
					Route::get('/filter', 'Putaway\PutawayController@filter_date')->name('putaway.filter_date');

				});



				// Picking
				Route::group(['prefix' => 'picking'], function(){

					// Show all picking
					Route::get('/', 'Picking\PickingController@index')->name('picking.index');

					// Show all picking
					Route::get('/filter', 'Picking\PickingController@filter_date')->name('picking.filter_date');

					// Add new
					Route::get('/add', 'Picking\PickingController@add')->name('picking.add');

					// Save new
					Route::post('/add', 'Picking\PickingController@save')->name('picking.save');

					// Detail
					Route::get('/detail/{picking}', 'Picking\PickingController@detail')->name('picking.detail');

					// Save Picking
					Route::post('/save_item', 'Picking\PickingController@save_item')->name('picking.save_item');

					// Edit Item
					Route::get('/edit_item/{picking_detail}', 'Picking\PickingController@edit_item')->name('picking.edit_item');

					// Update Item
					Route::post('/edit_item', 'Picking\PickingController@update_item')->name('picking.update_item');

					// Delete Item
					Route::post('/delete_item', 'Picking\PickingController@delete_item')->name('picking.delete_item');

					// Finish Picking
					Route::post('/finish_picking', 'Picking\PickingController@finish_picking')->name('picking.finish_picking');

				});



				// Loading
				Route::group(['prefix' => 'loading'], function(){

					// Show all
					Route::get('/', 'Loading\LoadingController@index')->name('loading.index');

					// Add page
					Route::get('/add/{picking}', 'Loading\LoadingController@add')->name('loading.add');

					// Save it
					Route::post('/save', 'Loading\LoadingController@save')->name('loading.save');

					// Loading Detail
					Route::get('/detail/{loading}', 'Loading\LoadingController@detail')->name('loading.detail');

					// Edit
					Route::get('/edit/{loading}', 'Loading\LoadingController@edit')->name('loading.edit');

					// Update
					Route::post('/edit', 'Loading\LoadingController@update')->name('loading.update');

					// Finish Loading
					Route::post('/finish_loading', 'Loading\LoadingController@finish_loading')->name('loading.finish_loading');

					// edit item
					Route::get('/edit_item/{loading_detail}', 'Loading\LoadingController@edit_item')->name('loading.edit_item');

					// update item
					Route::post('/edit_item', 'Loading\LoadingController@update_item')->name('loading.update_item');

					// delete item
					Route::post('/delete_item', 'Loading\LoadingController@delete_item')->name('loading.delete_item');

					// Do Loading
					Route::get('/do_loading/{picking_detail}/{loading}', 'Loading\LoadingController@do_loading')->name('loading.do_loading');

					// Do loading save
					Route::post('/do_loading', 'Loading\LoadingController@do_loading_save')->name('loading.do_loading_save');

					// Finish Loading
				});


				// Customer
				Route::group(['prefix' => 'customer'], function () {
					// Customer Master
	        Route::group(['prefix' => 'master'], function () {
	            Route::get('/', 'Customer\CustomerMasterController@index')->name('customermaster.index');
	            Route::get('/add', 'Customer\CustomerMasterController@add')->name('customermaster.add');
	            Route::post('/add', 'Customer\CustomerMasterController@save')->name('customermaster.save');

	            Route::get('/edit/{customermaster}', 'Customer\CustomerMasterController@edit')->name('customermaster.edit');
	            Route::post('/edit', 'Customer\CustomerMasterController@update')->name('customermaster.update');

	            Route::post('/delete', 'Customer\CustomerMasterController@delete')->name('customermaster.delete');

	            Route::get('/detail/{customermaster}', 'Customer\CustomerMasterController@detail')->name('customermaster.detail');

	            // Route::get('/inventory_monitor/{customermaster}', 'Customer\CustomerMasterController@inventory_monitor')->name('customermaster.inventory_monitor');

	            // Customer Address
	            Route::group(['prefix' => 'address'], function(){
								
								Route::get('/', 'Customer\CustomerAddressController@index')->name('customeraddress.index');
								Route::get('/add', 'Customer\CustomerAddressController@add')->name('customeraddress.add');
								Route::post('/add', 'Customer\CustomerAddressController@save')->name('customeraddress.save');
								Route::get('/edit/{customeraddress}', 'Customer\CustomerAddressController@edit')->name('customeraddress.edit');
								Route::post('/edit', 'Customer\CustomerAddressController@update')->name('customeraddress.update');
								Route::post('/', 'Customer\CustomerAddressController@delete')->name('customeraddress.delete');

	            });

	        });
				});

				// Item Master
				Route::group(['prefix' => 'item'], function () {
	        Route::get('/', 'Item\ItemMasterController@index')->name('itemmaster.index');
	        
	        Route::get('/add', 'Item\ItemMasterController@add')->name('itemmaster.add');
	        Route::post('/add', 'Item\ItemMasterController@save')->name('itemmaster.save');

	        Route::get('/edit/{ItemMaster}', 'Item\ItemMasterController@edit')->name('itemmaster.edit');
	        Route::post('/edit', 'Item\ItemMasterController@update')->name('itemmaster.update');
	        Route::post('/', 'Item\ItemMasterController@delete')->name('itemmaster.delete');
	        Route::get('/detail/{item_number}', 'Item\ItemMasterController@detail')->name('itemmaster.detail');

	        // Item Category
					Route::group(['prefix' => 'category'], function () {
			        Route::get('/', 'Item\ItemCategoryController@index')->name('itemcategory.index');
			        
			        Route::get('/add', 'Item\ItemCategoryController@add')->name('itemcategory.add');
			        Route::post('/add', 'Item\ItemCategoryController@save')->name('itemcategory.save');

			        Route::get('/edit/{ItemCategory}', 'Item\ItemCategoryController@edit')->name('itemcategory.edit');
			        Route::post('/edit', 'Item\ItemCategoryController@update')->name('itemcategory.update');
			        Route::post('/', 'Item\ItemCategoryController@delete')->name('itemcategory.delete');
					});

				});

				// UOM
				Route::group(['prefix' => 'uom'], function () {
			    Route::get('/', 'Uom\UomController@index')->name('uom.index');
			        
			    Route::get('/add', 'Uom\UomController@add')->name('uom.add');
			    Route::post('/add', 'Uom\UomController@save')->name('uom.save');

			    Route::get('/edit/{uom}', 'Uom\UomController@edit')->name('uom.edit');
			    Route::post('/edit', 'Uom\UomController@update')->name('uom.update');
			    Route::post('/', 'Uom\UomController@delete')->name('uom.delete');
				});

				
				// Warehouse
        Route::group(['prefix' => 'warehouse'], function(){

        	// Warehouse Plant
					Route::group(['prefix' => 'plant'], function(){
	        	Route::get('/', 'Warehouse\WarehousePlantController@index')->name('warehouseplant.index');
	        	Route::get('/add', 'Warehouse\WarehousePlantController@add')->name('warehouseplant.add');
	        	Route::post('/add', 'Warehouse\WarehousePlantController@save')->name('warehouseplant.save');
	        	Route::get('/edit/{warehouseplant}', 'Warehouse\WarehousePlantController@edit')->name('warehouseplant.edit');
	        	Route::post('/edit', 'Warehouse\WarehousePlantController@update')->name('warehouseplant.update');
	        	Route::post('/delete', 'Warehouse\WarehousePlantController@delete')->name('warehouseplant.delete');
	        });

	        // Warehouse Zone
	        Route::group(['prefix' => 'zone'], function(){
	        	Route::get('/', 'Warehouse\WarehouseZoneController@index')->name('warehousezone.index');
	        	Route::get('/add', 'Warehouse\WarehouseZoneController@add')->name('warehousezone.add');
	        	Route::post('/add', 'Warehouse\WarehouseZoneController@save')->name('warehousezone.save');
	        	Route::get('/edit/{warehousezone}', 'Warehouse\WarehouseZoneController@edit')->name('warehousezone.edit');
	        	Route::post('/edit', 'Warehouse\WarehouseZoneController@update')->name('warehousezone.update');
	        	Route::post('/', 'Warehouse\WarehouseZoneController@delete')->name('warehousezone.delete');
	        });

	        // Warehouse Row
	        Route::group(['prefix' => 'row'], function(){
	        	Route::get('/', 'Warehouse\WarehouseRowController@index')->name('warehouserow.index');
	        	Route::get('/add', 'Warehouse\WarehouseRowController@add')->name('warehouserow.add');
	        	Route::post('/add', 'Warehouse\WarehouseRowController@save')->name('warehouserow.save');
	        	Route::get('/edit/{warehouserow}', 'Warehouse\WarehouseRowController@edit')->name('warehouserow.edit');
	        	Route::post('/edit', 'Warehouse\WarehouseRowController@update')->name('warehouserow.update');
	        	Route::post('/', 'Warehouse\WarehouseRowController@delete')->name('warehouserow.delete');
	        });

	        // Warehouse Name
	        Route::group(['prefix' => 'name'], function(){
	        	Route::get('/', 'Warehouse\WarehouseNameController@index')->name('warehousename.index');
	        	Route::get('/add', 'Warehouse\WarehouseNameController@add')->name('warehousename.add');
	        	Route::post('/add', 'Warehouse\WarehouseNameController@save')->name('warehousename.save');
	        	Route::get('/edit/{warehousename}', 'Warehouse\WarehouseNameController@edit')->name('warehousename.edit');
	        	Route::post('/edit', 'Warehouse\WarehouseNameController@update')->name('warehousename.update');
	        	Route::post('/', 'Warehouse\WarehouseNameController@delete')->name('warehousename.delete');
	        });

	        // Warehouse Bin
	        Route::group(['prefix' => 'bin'], function(){
	        	Route::get('/', 'Warehouse\WarehouseBinController@index')->name('warehousebin.index');
	        	Route::get('/add', 'Warehouse\WarehouseBinController@add')->name('warehousebin.add');
	        	Route::post('/add', 'Warehouse\WarehouseBinController@save')->name('warehousebin.save');
	        	Route::get('/edit/{warehousebin}', 'Warehouse\WarehouseBinController@edit')->name('warehousebin.edit');
	        	Route::post('/edit', 'Warehouse\WarehouseBinController@update')->name('warehousebin.update');
	        	Route::post('/', 'Warehouse\WarehouseBinController@delete')->name('warehousebin.delete');
					});

					// Warehouse Area
	        Route::group(['prefix' => 'area'], function(){
	        	Route::get('/', 'Warehouse\WarehouseAreaController@index')->name('warehousearea.index');
	        	Route::get('/add', 'Warehouse\WarehouseAreaController@add')->name('warehousearea.add');
	        	Route::post('/add', 'Warehouse\WarehouseAreaController@save')->name('warehousearea.save');
	        	Route::get('/edit/{warehousearea}', 'Warehouse\WarehouseAreaController@edit')->name('warehousearea.edit');
	        	Route::post('/edit', 'Warehouse\WarehouseAreaController@update')->name('warehousearea.update');
	        	Route::post('/', 'Warehouse\WarehouseAreaController@delete')->name('warehousearea.delete');
					});
					
					// Warehouse Pallet
					Route::group(['prefix' => 'pallet'], function(){
	        	Route::get('/', 'Warehouse\PalletController@index')->name('pallet.index');
	        	Route::get('/add', 'Warehouse\PalletController@add')->name('pallet.add');
	        	Route::post('/add', 'Warehouse\PalletController@save')->name('pallet.save');
	        	Route::get('/edit/{pallet}', 'Warehouse\PalletController@edit')->name('pallet.edit');
	        	Route::post('/edit', 'Warehouse\PalletController@update')->name('pallet.update');
	        	Route::post('/', 'Warehouse\PalletController@delete')->name('pallet.delete');
	        });

	        // Level
					Route::group(['prefix' => 'level'], function(){
	        	Route::get('/', 'Warehouse\LevelController@index')->name('level.index');
	        	Route::get('/add', 'Warehouse\LevelController@add')->name('level.add');
	        	Route::post('/save', 'Warehouse\LevelController@save')->name('level.save');
	        	Route::get('/edit/{level}', 'Warehouse\LevelController@edit')->name('level.edit');
	        	Route::post('/edit', 'Warehouse\LevelController@update')->name('level.update');
	        	Route::post('/', 'Warehouse\LevelController@delete')->name('level.delete');
	        });

	        // Column
					Route::group(['prefix' => 'column'], function(){
	        	Route::get('/', 'Warehouse\ColumnController@index')->name('column.index');
	        	Route::get('/add', 'Warehouse\ColumnController@add')->name('column.add');
	        	Route::post('/add', 'Warehouse\ColumnController@save')->name('column.save');
	        	Route::get('/edit/{column}', 'Warehouse\ColumnController@edit')->name('column.edit');
	        	Route::post('/edit', 'Warehouse\ColumnController@update')->name('column.update');
	        	Route::post('/', 'Warehouse\ColumnController@delete')->name('column.delete');
	        });

	        // Location
					Route::group(['prefix' => 'location'], function(){
	        	Route::get('/', 'Warehouse\WarehouseLocationController@index')->name('location.index');
	        	Route::get('/add', 'Warehouse\WarehouseLocationController@add')->name('location.add');
	        	Route::post('/add', 'Warehouse\WarehouseLocationController@save')->name('location.save');
	        	Route::get('/edit/{location}', 'Warehouse\WarehouseLocationController@edit')->name('location.edit');
	        	Route::post('/edit', 'Warehouse\WarehouseLocationController@update')->name('location.update');
	        	Route::post('/', 'Warehouse\WarehouseLocationController@delete')->name('location.delete');
	        });


	      });

    });

});
