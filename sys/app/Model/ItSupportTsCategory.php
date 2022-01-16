<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItSupportTsCategory extends Model
{
    //
    
    protected $table = 'hris_it_ts_cat';

    protected $primaryKey = 'ts_cat_id';

    public $timestamps = false;

    protected $fillable = [ 'ts_cat_id','ts_cat_name','ts_remarks','is_delete'];
    
}
