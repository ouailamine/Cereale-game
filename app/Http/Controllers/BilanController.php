<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use App\User;
use App\Period;
use App\TypeInformation;
use App\EditableParameter;
use Illuminate\Support\Facades\DB;

class BilanController extends Controller
{
  /**
   * Display the specified resource.
   *
   * @param  int  $id period
   * @return \Illuminate\Http\Response
   */
  public function show($idGame){
   
    $allgames = DB::select('(select p.idGame ,sum(p.gainCumul) AS total from Period p GROUP BY idGame)ORDER BY total DESC');
    $countgames = DB::select('select count(idGame) from game');
    $gameranking  = array_search($idGame, array_column($allgames, 'idGame'));
    
    $allgamesusers = DB::select(' (select g.userId ,sum(p.gainCumul) AS total from game g, Period p where g.idGame = p.idGame GROUP BY userId)ORDER BY total DESC');
    $idGamer = DB::table('game')->select('userId')->where('idGame','=',$idGame)->first()->userId;
    $playerranking = array_search($idGamer, array_column($allgamesusers, 'userId'));
    $countGamers = DB::select('select COUNT(*)  cerealusers');
    
   
  
    $nbrPeriodes = DB::table('EditableParameter')->select('nbrPeriodes')->where('idParam','=',1)->first()->nbrPeriodes;
    //Récupération de toutes les informations de la partie
    $game = Game::find($idGame);
    $id = $game->userId;
    //Récupération des périodes de la partie
    $periods = DB::select('select * from Period p where p.idGame = ? ORDER BY numberPeriod', [$idGame]);

    //Récupération du lien vers le questionnaire
    $surveyLink = DB::table('EditableParameter')->select('surveyLink')->where('idParam','=',1)->first()->surveyLink;

    return view('game.gameBilan', compact('game','id','periods', 'surveyLink','allgames','gameranking','countgames','nbrPeriodes','countGamers','playerranking','allgamesusers'));
  
  
  
 
  }
}
