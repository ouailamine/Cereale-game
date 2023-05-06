<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use App\Period;
use Session;
use App\TypeInformation;
use App\EditableParameter;
//use App\Http\Controller\PeriodController\store;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $games = Game::all();
      $periods = Period::all();
      $nbrPeriodes = DB::table('EditableParameter')->select('nbrPeriodes')->where('idParam','=',1)->first()->nbrPeriodes;
      
      return view('game.gameIndex', compact('games','periods','nbrPeriodes'));
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //cf edit
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //creation d'une variable session pour la quantite restante
      $quantiteRestante = DB::table('EditableParameter')->select('quantite')->where('idParam','=',1)->first()->quantite;
      Session::put('quantiteRestante',$quantiteRestante);
      
      //creation d'une variable session pour les contrats 
      $contratsRestante = DB::table('EditableParameter')->select('levierEBM')->where('idParam','=',1)->first()->levierEBM;
      Session::put('contratsRestante', $contratsRestante);
      
      
      //Validation formulaire
      $rules = [
        'nameGame' => 'max:20',
        'objectivePrice' => 'required|numeric',
        'idUser' => 'required|int',
        'priceTermGame' => 'numeric',
        'priceSportGame' => 'numeric',
      ];
      //Modification des messages d'erreurs
      $customMessages = [
      'required' => 'Veuillez rentrez la valeur : :attribute.',
      'numeric' => 'La valeur \':attribute\' doit être un nombre.',
      'date' => 'La valeur \':attribute\' doit être une date.',
      'max' => 'La valeur \':attribute\' ne peut contenir que 20 caractères.',
      'int' => 'La valeur \':attribute\' doit être un nombre entier'
      ];

      $this->validate($request, $rules, $customMessages);

      $date = date('Y-m-d');
      $nameGame = $request->nameGame;
      
      //CREATION DE LA PARTIE :
      

        $game = Game::create([
        'nameGame' => $nameGame,
        'objectivePrice' => $request->objectivePrice,
        'dateGame' => $date,
        'salePriceMax' => $request->salePriceMax,
        'userId' => $request->idUser,
        'priceTermGame' => $request->termPrice,
        'priceSpotGame' => $request->spotPrice,
        'replay' => $request->idGame,
      ]);

      //CREATION DE LA PREMIERE PERIODE
      $period = Period::create([
        'numberPeriod' => 1,
        'idGame' => $game->idGame,
      ]);

      $types = TypeInformation::all();
      //AFFECTATION INFORMATION A LA PERIODE
      if($game->replay != NULL){ //Si la cette partie est rejouée
        $infos = DB::select('SELECT idInformation FROM Information WHERE idInformation IN (SELECT hi.idInformation FROM haveInformation hi, Period p, Information i WHERE hi.idPeriod = p.idPeriod and hi.idInformation = i.idInformation and p.numberPeriod = ? and p.idGame = ?)', [1, $game->replay] );
        for ($i = 0; $i <= 2; $i++) {
            $info = $infos[$i]->idInformation;
            //Affectation des informations à la nouvelle partie
            DB::insert('insert into haveInformation (idPeriod, idInformation) values (?, ?)', [
                $period->idPeriod,
                $info,
            ]);
        }
      }else{//Si cette partie n'est pas rejouer
        foreach ($types as $type) {
          $infos = DB::select('SELECT idInformation FROM Information WHERE typeInfoId = ? and idInformation NOT IN ( SELECT i.idInformation FROM Information i, Period p, haveInformation hi WHERE p.idGame = ? and hi.idPeriod = p.idPeriod and hi.idInformation = i.idInformation and i.typeInfoId = ?)', [$type->idTypeInfo, $game->idGame, $type->idTypeInfo]);
          if ($infos == null){
            $infos = DB::select('SELECT idInformation FROM Information WHERE typeInfoId = ?', [$type->idTypeInfo]);
          }
          $rand = array_rand($infos);
          $random = $infos[$rand]->idInformation;
          DB::insert('insert into haveInformation (idPeriod, idInformation) values (?, ?)', [
              $period->idPeriod,
              $random,
          ]);

        }
      }


      $nbrPeriodes = DB::table('EditableParameter')->select('nbrPeriodes')->where('idParam','=',1)->first()->nbrPeriodes;
      
      //$idUser = auth()->user()->idUser;
      $numMax = DB::table('Period')->where('idGame','=',$game->idGame)->max('numberPeriod');
      $idMax = DB::table('Period')->select('idPeriod')->where('numberPeriod','=',$numMax)->where('idGame','=',$game->idGame)->first()->idPeriod;
      $informations = DB::select('SELECT * FROM Information WHERE idInformation IN ( SELECT i.idInformation FROM Information i, haveInformation hi WHERE hi.idPeriod = ? and hi.idInformation = i.idInformation)', [$idMax]);
      $periodsMail = DB::select('select * from Period p where p.idGame = ? ORDER BY numberPeriod DESC', [$game->idGame]);
      $periods = DB::select('select * from Period p where p.idGame = ? ORDER BY numberPeriod DESC', [$game->idGame]);
      return view('game.gameShow', compact('game','periods','periodsMail','idMax','informations','nbrPeriodes'));
      //return redirect('/game.show')->with('success', 'Un partie a été ajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id game
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $nbrPeriodes = DB::table('EditableParameter')->select('nbrPeriodes')->where('idParam','=',1)->first()->nbrPeriodes;
      
      $idGame =$id;
      $game = DB::table('Game')->where('idGame','=',$id)->first();
      $periods = DB::select('select * from Period p where p.idGame = ? ORDER BY numberPeriod DESC', [$id]);
      $periodsMail = DB::select('select * from Period p where p.idGame = ? ORDER BY numberPeriod DESC', [$id]);
      $numMax = DB::table('Period')->where('idGame','=',$id)->max('numberPeriod');
      $idMax = DB::table('Period')->select('idPeriod')->where('numberPeriod','=',$numMax)->where('idGame','=',$id)->first()->idPeriod;
      return view('game.gameShow', compact('game','periods', 'periodsMail','idMax','numMax','nbrPeriodes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id User
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $nbrPeriodes = DB::table('EditableParameter')->select('nbrPeriodes')->where('idParam','=',1)->first()->nbrPeriodes;
      
      $editParam = DB::table('EditableParameter')->first();
      $plancher = $editParam->plancher;
      $plafond = $editParam->plafond;
      $spread = $editParam->spread;
      $termMean = $editParam->prixTermeEsperance;
      $spotMean = $editParam->prixSpotEsperance;
      $termStd = $editParam->prixTermeEcartType;
      $spotStd = $editParam->prixSpotEcartType;
      $idGame = null;

      return view('game.gameCreate',compact('id', 'plancher', 'plafond', 'spread', 'termMean', 'spotMean', 'termStd', 'spotStd', 'idGame','nbrPeriodes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     *
     * @param  int  $id du game à replay
     * @return \Illuminate\Http\Response
     */
    public function replay($idGame){
      //TO DO :
      //Créer une nouvelle partie vide mais avec l'attribut $idGameReplay = $idGame
      //Recupérer l'id du joueur pour créer une nouvelle partie
      //Ajouter à la création d'une partie  paramètre qui
      $game = Game::find($idGame);
      $id = $game->userId;


      return view('game.gameCreateReplay',compact('idGame','game','id'));
    }
}
