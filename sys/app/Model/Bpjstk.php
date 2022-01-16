<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bpjstk extends Model
{
    //
    
    protected $table = 'hris_bpjstk';

    protected $primaryKey = 'id_bpjstk';

    public $timestamps = false;

    protected $fillable = ['id_bpjstk', 'no_bpjstk', 'id_emp',  'bpjstk_joindate', 'bpjstk_status', 'input_by', 'input_date', 'edit_by', 'edit_date',   'is_delete'];
    
}
