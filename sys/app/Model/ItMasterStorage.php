<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItMasterStorage extends Model
{
    //
    
    protected $table = 'hris_it_m_storage';

    protected $primaryKey = 'storage_id';

    public $timestamps = false;

    protected $fillable = [ 'storage_id','storage_brand','storage_type','storage_interface','storage_size','storage_remark','input_by','input_date','edit_by','edit_date'];
    
}
