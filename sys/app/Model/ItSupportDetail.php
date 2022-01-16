<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItSupportDetail extends Model
{
    //
    
    protected $table = 'hris_it_support_detail';

    protected $primaryKey = 'support_detail_id';

    public $timestamps = false;

    protected $fillable = ['support_detail_id',    'support_id',  'support_detail_comment',  'support_detail_status',   'input_by',    'input_date',  'edit_by', 'edit_date',   'is_delete'];
    
}
