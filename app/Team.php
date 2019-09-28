<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable=['name','power'];


    //return leagus
    public function leagues()
    {
        return $this->hasMany(League::class);
    }

    //retrun win matches
    public function winMatches()
    {
        return $this->hasMany(Match::class,'win_team_id','id');
    }

    //retrun lose matches
    public function loseMatches()
    {
        return  $this->hasMany(Match::class,'lose_team_id','id');
    }
}
