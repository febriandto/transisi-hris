<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItMasterBrand extends Model
{
    //
    
    protected $table = 'hris_it_m_brand';

    protected $primaryKey = 'brand_id';

    public $timestamps = false;

    protected $fillable = ['brand_id', 'brand_name',  'brand_remark', 'input_by', 'input_date', 'edit_by', 'edit_date', 'is_delete'];
    
}
