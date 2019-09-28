<?php

Route::get('/teams', "TeamController@index");

Route::get('/match', "MatchController@index");
Route::get('/match/{week}', "MatchController@index");

Route::get('/league', "ResultController@index");
Route::get('/allweek', "ResultController@allWeek");

Route::get('/week/{week}', "MatchController@index");
Route::get('/prediction', "ResultController@Prediction");
Route::get('/reset', "ResultController@reset");

Route::get('/grid', "TeamController@grid");
Route::get('/', "TeamController@grid");


