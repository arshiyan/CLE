<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable=['winner_team_id','lost_team_id','result','week'];


    //return winner team
    public function winner_team()
    {
       return $this->hasOne(Team::class,'id','winner_team_id');
    }

    //return lose team
    public function lose_team()
    {
        return $this->hasOne(Team::class,'id','lost_team_id');
    }

    //split string by : and return array
    public function result()
    {
        return explode(':',$this->result);
    }





}
