<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItMasterMotherBoard extends Model
{
    //
    
    protected $table = 'hris_it_m_mb';

    protected $primaryKey = 'ram_id';

    public $timestamps = false;

    protected $fillable = ['ram_id', 'ram_type', 'ram_size', 'ram_brand', 'ram_channel', 'ram_speed', 'ram_remark', 'input_by', 'input_date', 'edit_by', 'edit_date', 'is_delete'];
    
}
