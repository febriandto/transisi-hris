<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //
    
    protected $table = 'hris_note';

    protected $primaryKey = 'id_notes';

    public $timestamps = false;

    protected $fillable = ['id_notes','notes_deadline','notes_detail','priority','notes_status','input_date','input_by','is_delete'];
}
