<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    protected $fillable=['team_id','point','play','win','lose','draw','gd'];

    //return team
    public function team()
    {
        return $this->hasOne(Team::class,'team_id','id');
    }
}
