<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterCutiKhususCategory extends Model
{
    //
    
    protected $table = 'hris_m_cuti_khusus_cat';

    protected $primaryKey = 'cuti_k_cat_id';

    public $timestamps = false;

    protected $fillable = ['cuti_k_cat_id','cuti_k_cat_name','cuti_k_cat_desc','is_delete'];
    
}
