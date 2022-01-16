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

				Route::get('/', 'BerandaController@dashboard')->name('beranda.dashboard');
				Route::get('/home', 'BerandaController@dashboard')->name('beranda.dashboard');
				Route::get('/dashboard', 'BerandaController@dashboard')->name('beranda.dashboard');


				//Profile
				Route::group(['prefix' => 'profile'], function () {
						Route::get('/', 'ProfileController@index')->name('profile.index');
						Route::post('/update', 'ProfileController@update')->name('profile.update');
						Route::post('/passwordreset', 'ProfileController@passwordreset')->name('profile.passwordreset');
				});
				

		});

});
