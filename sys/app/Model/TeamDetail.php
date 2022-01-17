<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TeamDetail extends Model
{
    //
    
    protected $table = 'hris_t_team_detail';

    protected $primaryKey = 'team_id';

    public $timestamps = false;

    protected $fillable = ['team_detail_id','team_leader_id','team_id','id_emp','input_by','input_date','update_by','update_date','is_delete'];
}
