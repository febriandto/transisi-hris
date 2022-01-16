<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItCctv extends Model
{
    //
    
    protected $table = 'hris_it_cctv';

    protected $primaryKey = 'id_cctv';

    public $timestamps = false;

    protected $fillable = [ 'id_cctv','cctv_name','cctv_location','dvr_location','ip_address','cctv_type','cctv_status','cctv_remarks','input_by','input_date','edit_by','edit_date','is_delete'];
    
}
