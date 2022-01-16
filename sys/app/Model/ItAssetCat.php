<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItAssetCat extends Model
{
    //
    
    protected $table = 'hris_it_asset_cat';

    protected $primaryKey = 'asset_cat_id';

    public $timestamps = false;

    protected $fillable = ['asset_cat_id','asset_cat_name','asset_cat_remark','input_by','input_date','edit_by','edit_date','is_delete'];
    
}
