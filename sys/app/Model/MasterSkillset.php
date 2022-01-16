<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterSkillset extends Model
{
    //
    
    protected $table = 'hris_m_skillset';

    protected $primaryKey = 'id_skillset';

    public $timestamps = false;

    protected $fillable = ['id_skillset','skillset_name','skillset_desc','is_delete'];
}
