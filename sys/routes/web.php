<?php

use App\Model\Tally\Tally;
use App\Model\Tally\TallyDetail;
use App\Model\Putaway\Putaway;
use App\Model\Putaway\PutawayDetail;
use App\Model\Picking\Picking;
use App\Model\Picking\PickingDetail;
use App\Model\Loading\Loading;
use App\Model\Loading\LoadingDetail;
use App\Model\Loading\CancelLoading;
use App\Model\Loading\CancelLoadingDetail;
use App\Model\Warehouse\PalletMovement;
use App\Model\MovementHistory;
use App\Model\Stock\MPalletStock;
use App\Model\Warehouse\Pallet;
use App\Model\Warehouse\Warehouselocation;
use App\Model\Warehouse\Warehousezone;

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

// Middleware
Route::group(['middlewareGroup' => ['web']], function () {

	// Autentikasi
	Auth::routes();

	// Logout
	Route::get('/logout', 'BerandaController@logout')->name('logout');

		// If Success Login Below Here
		Route::group(['middleware' => 'auth'], function () {

				// Dashboard
				Route::get('/', 'BerandaController@dashboard')->name('beranda.dashboard');
				Route::get('/home', 'BerandaController@dashboard')->name('beranda.dashboard');
				Route::get('/dashboard', 'BerandaController@dashboard')->name('beranda.dashboard');

				// Employees
				Route::group(['prefix' => 'employee'], function(){

					Route::get('/', 'EmployeeController@index')->name('employee.index');
					Route::get('/local', 'EmployeeController@index')->name('employee.local');
					Route::get('/foreign', 'EmployeeController@index')->name('employee.foreign');
					Route::get('/bod', 'EmployeeController@index')->name('employee.bod');
					Route::get('/resign', 'EmployeeController@index')->name('employee.resign');
					Route::get('/detail', 'EmployeeController@detail')->name('employee.detail');

					Route::get('/add', 'EmployeeController@add')->name('employee.add');
					Route::post('/save', 'EmployeeController@save')->name('employee.save');
					Route::get('/detail/{id}', 'EmployeeController@detail')->name('employee.detail');
					Route::get('/edit/{id}', 'EmployeeController@edit')->name('employee.edit');
					Route::post('/update', 'EmployeeController@update')->name('employee.update');
					Route::post('/delete', 'EmployeeController@delete')->name('employee.delete');
					Route::post('/ganti_foto', 'EmployeeController@ganti_foto')->name('employee.ganti_foto');

					Route::get('/export', 'EmployeeController@export')->name('employee.export');

					Route::group(['prefix' => 'emp_list'], function(){
						Route::get('/', 'EmployeeController@emp_list')->name('emp_list.index');
						Route::get('/detail/{id}', 'EmployeeController@emp_list_detail')->name('emp_list.detail');
					});

				});

				// accident employee
				Route::group(['prefix' => 'accident_employee'], function(){

					Route::get('/', 'AccidentEmployeeController@index')->name('accident.index');
					Route::get('/add', 'AccidentEmployeeController@add')->name('accident.add');
					Route::post('/save', 'AccidentEmployeeController@save')->name('accident.save');
					Route::get('/edit/{accident}', 'AccidentEmployeeController@edit')->name('accident.edit');
					Route::post('/update', 'AccidentEmployeeController@update')->name('accident.update');

				});

				//Profile
				Route::group(['prefix' => 'profile'], function () {
						Route::get('/', 'ProfileController@index')->name('profile.index');
						Route::post('/update', 'ProfileController@update')->name('profile.update');
						Route::post('/passwordreset', 'ProfileController@passwordreset')->name('profile.passwordreset');
				});

				// Contract
				Route::group(['prefix' => 'contract'], function () {

					Route::get('/', 'ContractController@index')->name('contract.index');

				});

				// Resign
				Route::group(['prefix' => 'resign'], function () {

					Route::get('/', 'ResignController@index')->name('resign.index');

				});

				// Team
				Route::group(['prefix' => 'team'], function () {

					Route::get('/', 'TeamController@index')->name('team.index');
					Route::get('/add', 'TeamController@add')->name('team.add');
					Route::post('/save', 'TeamController@save')->name('team.save');
					Route::get('/view/{team}', 'TeamController@view')->name('team.view');
					Route::get('/view/{team}/add_team', 'TeamController@add_team')->name('team.add_team');
					Route::post('/save_team', 'TeamController@save_team')->name('team.save_team');
					Route::get('/delete', 'TeamController@delete')->name('team.delete');
					Route::get('/delete_team', 'TeamController@delete_team')->name('team.delete_team');


				});

				// Sp
				Route::group(['prefix' => 'sp'], function(){

					Route::get('/', 'SpController@index')->name('sp.index');
					Route::get('/add', 'SpController@add')->name('sp.add');
					Route::post('/save', 'SpController@save')->name('sp.save');
					Route::get('/edit/{sp}', 'SpController@edit')->name('sp.edit');
					Route::post('/update', 'SpController@update')->name('sp.update');
					Route::get('/delete', 'SpController@delete')->name('sp.delete');

				});


				Route::group(['prefix' => 'mutasi'], function(){

					Route::get('/', 'MutasiController@index')->name('mutasi.index');
					Route::get('/add', 'MutasiController@add')->name('mutasi.add');
					Route::post('/save', 'MutasiController@save')->name('mutasi.save');

				});

				

		});

});
