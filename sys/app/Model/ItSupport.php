<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItSupport extends Model
{
    //
    
    protected $table = 'hris_it_support';

    protected $primaryKey = 'support_id';

    public $timestamps = false;

    protected $fillable = ['support_id',   'support_cat_id',  'id_user', 'support_req_date',    'support_title',   'support_detail',  'support_status',  'supported_by',    'input_by',    'input_date',  'edit_by', 'edit_date',   'is_delete'];
    
}
