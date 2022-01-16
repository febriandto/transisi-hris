<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterAbsenOnline extends Model
{
    //
    
    protected $table = 'hris_m_absen_online_cat';

    protected $primaryKey = 'absen_online_cat_id';

    public $timestamps = false;

    protected $fillable = ['absen_online_cat_id','absen_online_cat_name','absen_online_cat_alias','absen_online_cat_desc','update_by','update_date','is_delete'];
    
}
