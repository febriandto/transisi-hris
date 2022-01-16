<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterIjinCategory extends Model
{
    //
    
    protected $table = 'hris_m_ijin_cat';

    protected $primaryKey = 'ijin_cat_id';

    public $timestamps = false;

    protected $fillable = [ 'ijin_cat_id','ijin_cat_name','is_delete'];
    
}
