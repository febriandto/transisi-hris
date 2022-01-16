<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItMasterLocation extends Model
{
    //
    
    protected $table = 'hris_it_m_loc';

    protected $primaryKey = 'loc_id';

    public $timestamps = false;

    protected $fillable = ['loc_id','loc_room','loc_floor','input_by','input_date','edit_by','edit_date','is_delete'];
    
}
