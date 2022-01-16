<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterBpjsCategory extends Model
{
    //
    
    protected $table = 'hris_m_bpjs_category';

    protected $primaryKey = 'id_bpjs';

    public $timestamps = false;

    protected $fillable = ['id_bpjs_cat','bpjs_catname','tax_emp','tax_corp','tax_total','is_delete'];
    
}
