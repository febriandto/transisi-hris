<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
 
class HashingController extends Controller
{
	public function hash(){
		$hash_password_saya = Hash::make('admin123');
		echo $hash_password_saya;
	}
 
}