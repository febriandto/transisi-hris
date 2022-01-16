<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bpjsk extends Model
{
    //
    
    protected $table = 'hris_bpjsk';

    protected $primaryKey = 'id_bpjsk';

    public $timestamps = false;

    protected $fillable = ['id_bpjsk', 'no_bpjs', 'id_emp',  'id_faskes',   'bpjsk_joindate',  'bpjsk_class', 'bpjsk_status', 'input_by', 'input_date',  'edit_by', 'edit_date', 'is_delete'];
    
}
