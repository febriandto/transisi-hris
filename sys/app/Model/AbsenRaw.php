<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AbsenRaw extends Model
{
    //
    
    protected $table = 'hris_absen_raw';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [ 'id', 'nik', 'waktu', 'f_key', 'machine_id', 'sync_date'];
    
}
