<?php

namespace App\Http\Controllers;

use App\League;
use App\Match;
use App\Team;
use Illuminate\Http\Request;
use Response;

class ResultController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $this->reset();
        $results = League::with('team')->get();

        return Response::json($results);
    }

    public function Week()
    {

        $results = Match::with('winner_team','lose_team')->get();

        return Response::json($results);
    }

    public function Prediction()
    {
        $total = League::sum('point');

        $teams = Team::all();

        foreach ($teams as $team)
        {
            if($total <=0) $total=1;
            $pre =($team->power/$total) * 100;
            //dd($total);
            $team->power = $pre;
            $team->save();
        }
        $teams = Team::all();
        return Response::json($teams);
    }

    public function reset()
    {
        Team::truncate();
        League::truncate();

        Team::create(
            [
                'name'=>"Chelsea",
                'power'=>"45",
            ]
        );
        Team::create(
            [
                'name'=>"Arsenal",
                'power'=>"25",
            ]
        );
        Team::create(
            [
                'name'=>"Manchester City",
                'power'=>"25",
            ]
        );
        Team::create(
            [
                'name'=>"Liverpool",
                'power'=>"5",
            ]
        );

        League::create(
            [
                "team_id"=>1,
                "point"=>10,
                "play"=>2,
                "win"=>3,
                "lose"=>0,
                "draw"=>1,
                "gd"=>11
            ]
        );

        League::create(
            [
                "team_id"=>2,
                "point"=>8,
                "play"=>4,
                "win"=>2,
                "lose"=>0,
                "draw"=>2,
                "gd"=>6
            ]
        );

        League::create(
            [
                "team_id"=>3,
                "point"=>6,
                "play"=>4,
                "win"=>2,
                "lose"=>0,
                "draw"=>2,
                "gd"=>4
            ]
        );

        League::create(
            [
                "team_id"=>4,
                "point"=>4,
                "play"=>4,
                "win"=>1,
                "lose"=>2,
                "draw"=>1,
                "gd"=>0
            ]
        );
    }
}
