<?php

namespace App\Http\Controllers;

use App\League;
use App\Match;
use App\Team;
use Illuminate\Http\Request;
use Response;

class MatchController extends Controller
{
    public function __construct()
    {

    }

    public function index($weekindex = 4)
    {
        //refresh all match table
        Match::truncate();

        $matches = $this->makeLeague();

        foreach ($matches as $week => $contests) {
            if ($week == $weekindex) {

                foreach ($contests as $matchup) {


                    $resultMatch = $this->makeMatch($matchup['home'], $matchup['away']);


                    if ($resultMatch['draw'] == 1) {

                        Match::create([
                                "winner_team_id" => $matchup['away'],
                                "lost_team_id" => $matchup['home'],
                                "result" => $resultMatch['result'],
                                "week" => $week
                            ]


                        );
                    } else {
                        Match::create([
                                "winner_team_id" => $resultMatch['winner'],
                                "lost_team_id" => $resultMatch['lose'],
                                "result" => $resultMatch['result'],
                                "week" => $week
                            ]

                        );
                    }


                }
            }

        }

        $results = Match::with('winner_team','lose_team')->get();

        return Response::json($results);

    }

    public function makeMatch($team1, $team2)
    {
        if (!isset($team1) || !isset($team2))
            abort(404);


        //home
        $team_date1 = Team::find($team1);
        //away
        $team_date2 = Team::find($team2);

        //find team legue for update
        $team1info = League::where('team_id', $team1)->first();//home
        $team2info = League::where('team_id', $team2)->first();//away

        $team1_goalNumber = rand(0, 3);
        $team2_goalNumber = rand(0, 1);


        $result = $team1_goalNumber . ':' . $team2_goalNumber;

        $win_lose = [];

        //team1 is win
        if (($team1_goalNumber - $team2_goalNumber) > 0) {
            $team1info->point = $team1_goalNumber +3;
            $team1info->win += 1;
            $team2info->lose += 1;


            $win_lose['winner'] = $team1;
            $win_lose['lose'] = $team2;
            $win_lose['draw'] = 0;
            $win_lose['result'] = $result;


        } //draw
        elseif (($team1_goalNumber - $team2_goalNumber) == 0) {
            $team1info->point = $team1_goalNumber +1;
            $team2info->point = $team2_goalNumber +1;
            $team1info->draw += 1;
            $team2info->draw += 1;
            $win_lose['draw'] = 1;
            $win_lose['result'] = $result;
        } //team2 is win
        else {
            $team2info->point = $team2_goalNumber +3;
            $team2info->win += 1;
            $team1info->lose += 1;

            $win_lose['winner'] = $team2;
            $win_lose['lose'] = $team1;
            $win_lose['draw'] = 0;
            $win_lose['result'] = $result;

        }

        //global var
        $team1info->play += 1;
        $team1info->gd = $team1info->gd + $team1_goalNumber;
        $team2info->gd = $team2info->gd + $team2_goalNumber;

        $team1info->save();
        $team2info->save();




        return $win_lose;
    }

    public function makeLeague()
    {

        $matches = [
            1 => [
                ["home" => 4, "away" => 1],
                ["home" => 3, "away" => 2],
            ],
            2 => [
                ["home" => 1, "away" => 3],
                ["home" => 2, "away" => 4],
            ],
            3 => [
                ["home" => 3, "away" => 4],
                ["home" => 1, "away" => 2],
            ],
            4 => [
                ["home" => 2, "away" => 1],
                ["home" => 4, "away" => 3],
            ],
            5 => [
                ["home" => 3, "away" => 1],
                ["home" => 4, "away" => 2],
            ],
            6 => [
                ["home" => 1, "away" => 4],
                ["home" => 2, "away" => 3],
            ]
        ];

        return $matches;
    }


    public function makeLeague_temp()
    {

        //get all teams
        $teams = Team::pluck('id')->toArray();

        //total weeks
        $weeks = 5;

        //make array for all weeks (need big array)
        $array = array_merge($teams, $teams);


        $matches = array();
        //fill chart
        while ($weeks) {
            foreach ($teams as $key => $team) {
                // index of array
                $link = $key + $weeks;

                // fill array by home team and away team
                $home = $team;
                $away = $array[$link];
                $matches[$team][$weeks] = array('home' => $home, 'away' => $away);
            }

            //next week
            $weeks--;
        }


        //sort by first week
        foreach ($matches as $team => $contests) {
            ksort($contests);
            $matches[$team] = $contests;
        }

        //return Response::json($matches);
        return $matches;
    }
}
