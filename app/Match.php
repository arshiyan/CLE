<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable=['winner_team_id','lost_team_id','result','week'];


    //return winner team
    public function winner_team()
    {
       return $this->belongsTo(Team::class,'win_team_id','id');
    }

    //return lose team
    public function lose_team()
    {
        return $this->belongsTo(Team::class,'lose_team_id','id');
    }

    //split string by : and return array
    public function result()
    {
        return explode(':',$this->result);
    }





}
