<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use Response;
class TeamController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $teams = Team::all();
        return Response::json($teams);
    }

    public function grid()
    {

        return view('home');
    }
}
