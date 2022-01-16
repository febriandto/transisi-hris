<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItSupportCategory extends Model
{
    //
    
    protected $table = 'hris_it_support';

    protected $primaryKey = 'support_cat_id';

    public $timestamps = false;

    protected $fillable = [ 'support_cat_id',  'support_cat_name',    'support_cat_desc',    'support_cat_status',  'input_by',    'input_date',  'edit_by', 'edit_date',   'is_delete'];
    
}
