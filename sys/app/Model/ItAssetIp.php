<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItAssetIp extends Model
{
    //
    
    protected $table = 'hris_it_asset_ip';

    protected $primaryKey = 'ip_id';

    public $timestamps = false;

    protected $fillable = [ 'ip_id', 'asset_id', 'ip_address', 'mac_address', 'host_name', 'domain_name', 'ip_status', 'ip_remark', 'input_by', 'input_date', 'edit_by', 'edit_date', 'is_delete'];
    
}
