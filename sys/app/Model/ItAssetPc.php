<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItAssetPc extends Model
{
    //
    
    protected $table = 'hris_it_asset_pc';

    protected $primaryKey = 'asset_pc_id';

    public $timestamps = false;

    protected $fillable = [ 'asset_pc_id','po_number','id_emp','emp_wna_name','asset_cat_id','loc_id','monitor_id','cpu_id','ram_id','storage_id','os_id','vga_id','asset_pc_brand','asset_pc_type','asset_pc_remark','asset_pc_status','input_by','input_date','edit_by','edit_date','is_delete'];
    
}
