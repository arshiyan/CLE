<?php

use App\League;
use App\Team;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
