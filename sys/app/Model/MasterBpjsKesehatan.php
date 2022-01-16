<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterBpjsKesehatan extends Model
{
    //
    
    protected $table = 'hris_m_bpjs_kesehatan';

    protected $primaryKey = 'id_bpjs_kes';

    public $timestamps = false;

    protected $fillable = ['id_bpjs_kes','id_bpjs_cat','id_emp','id_faskes','id_card_no','bpjs_joindate','bpjs_class','bpjs_status','input_by','input_date','edit_by','edit_date'];
    
}
