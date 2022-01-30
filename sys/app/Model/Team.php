<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    
    protected $table = 'hris_t_team';

    protected $primaryKey = 'team_id';

    protected $keyType = "string";

    public $timestamps = false;

    protected $fillable = ['team_id','team_leader_id','team_leader','input_by','input_date','update_by','update_date','is_delete'];
}
