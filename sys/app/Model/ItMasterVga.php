<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItMasterVga extends Model
{
    //
    
    protected $table = 'hris_it_m_vga';

    protected $primaryKey = 'vga_id';

    public $timestamps = false;

    protected $fillable = [ 'vga_id','vga_brand','vga_type','vga_ddr','vga_size','vga_remark','input_by','input_date','edit_by','edit_date','is_delete'];
    
}
