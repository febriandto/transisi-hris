<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItAssetOther extends Model
{
    //
    
    protected $table = 'hris_it_asset_other';

    protected $primaryKey = 'asset_other_id';

    public $timestamps = false;

    protected $fillable = [ 'asset_other_id','asset_cat_id','loc_id','asset_other_brand','asset_other_name','asset_other_type','asset_other_qty','asset_other_remark','asset_other_status','input_by','input_date','edit_by','edit_date','is_delete'];
    
}
