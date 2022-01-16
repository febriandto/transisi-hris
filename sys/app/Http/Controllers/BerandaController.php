<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Tally\Tally;
use App\Model\Picking\Picking;
use App\Model\Warehouse\PalletItems;
use App\Model\Deliverynote;
use Auth;
use DB;
use App\Model\MPalletStock;


class BerandaController extends Controller
{

    public function dashboard(){

        return view('dashboard.index');

    }

    public function logout () {
          //logout user
          auth()->logout();
          
          // redirect to homepage
          return redirect('/');
    }

}
