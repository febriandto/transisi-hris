<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItWifi extends Model
{
    //
    
    protected $table = 'hris_it_wifi';

    protected $primaryKey = 'id_wifi';

    public $timestamps = false;

    protected $fillable = [ 'id_wifi', 'wifi_name',   'wifi_password',   'wifi_location',   'wifi_user',   'input_by',    'input_date',  'edit_by', 'edit_date',   'is_delete '];
    
}
