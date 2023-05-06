<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Period;
use App\Message;
use App\Game;
use Session;
use App\TypeInformation;
use App\HaveInformation;
use App\EditableParameter;
use Illuminate\Support\Facades\DB;
use Validator;


class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $periods = Period::all();
      return view('period.periodIndex', compact('periods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //
    }

    /* Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
     $EBM = DB::table('EditableParameter')->select('levierEBM')->where('idParam','=',1)->first()->levierEBM;
     $Quantite = DB::table('EditableParameter')->select('quantite')->where('idParam','=',1)->first()->quantite;
     
     /*$quantiteRestante = $request->quantiteRestante;
     $contratsRestante = $request->contratsRestante;
     Session::put('quantiteRestante',$quantiteRestante);
     Session::put('contratsRestante',$contratsRestante);*/
     
      //Validation formulaire
      $rules = [
        'isSold' => 'required|boolean',
        'vente'=>'required',
        'quantite' => 'numeric|min:0|max:'.$Quantite,
        'contratPosition' => 'numeric|min:0|max:'.$EBM,
        'idGame' => 'required|numeric',
        'priceTermPeriod' => 'numeric',
        'priceSportPeriod' => 'numeric',
        'gainCumul' => 'numeric',
        'priceGap' => 'numeric',
        'globalGap' => 'numeric',
      ];

      //Modification des messages d'erreurs
      $customMessages = [
        'required' => 'Veuillez rentrez la valeur : :attribute.',
        'numeric' => 'La valeur \':attribute\' doit être un nombre.',
        'boolean' => 'La valeur \':attribute\' doit être un boolean (VRAI/FAUX)',
        'max' => 'MAX Vous devez rentrez un nombre entre 0 et '.$EBM.' correspondant au nombre de contrat que vous achetez ou que vous vendez.',
        'min' => 'MIN Vous devez rentrez un nombre entre 0 et '.$EBM.' correspondant au nombre de contrat que vous achetez ou que vous vendez.',
        'required_if' => 'La valeur position du contrat est nécéssaire si vous souhaitez vendre ou acheter',
      ];//Fin modification messages d'erreurs
      $this->validate($request, $rules, $customMessages);
      //Fin validation formulaire

      //Controle contrat position
       if($request->vente==0){
         $request->contratPosition = 0;
       }else if ($request->vente==-1){
         $request->contratPosition = $request->contratPosition*(-1);
       }//Fin controle contrat position

     //Num max = numéro max de la période (pour update)
     $numMax = DB::table('Period')->where('idGame','=',$request->idGame)->max('numberPeriod');
     //id de la période avec le numéro max (pour update)
     $idMax = DB::table('Period')->select('idPeriod')->where('numberPeriod','=',$numMax)->where('idGame','=',$request->idGame)->first()->idPeriod;

     //Récupération des information de la partie (utile pour savoir si la partie est rejouée ou non)
     $game = Game::find($request->idGame);

     //UPDATE
     if($game->replay != NULL){
       $prixTermPeriod = DB::select('SELECT priceTermPeriod FROM Period WHERE idGame = ? and numberPeriod = ?' , [$game->replay, $numMax] )[0]->priceTermPeriod;
       $prixSpotPeriod = DB::select('SELECT priceSpotPeriod FROM Period WHERE idGame = ? and numberPeriod = ?' , [$game->replay, $numMax] )[0]->priceSpotPeriod;
       $p = Period::find($idMax);
       $p->contratPosition = $request->contratPosition;
       $p->quantite = $request->quantite;
       $p->objectivePrice = $game->objectivePrice;
       $p->isSold = $request->get('isSold');
       $p->priceTermPeriod = $prixTermPeriod;
       $p->priceSpotPeriod = $prixSpotPeriod;
       $p->gainCumul = $request->gainCumul;
       $p->priceGap = $request->priceGap;
       $p->globalGap = $request->globalGap;
       $p->save();
     }else{
       $p = Period::find($idMax);
       $p->contratPosition = $request->contratPosition;
       $p->quantite = $request->quantite;
       $p->objectivePrice = $game->objectivePrice;
       $p->isSold = $request->get('isSold');
       $p->priceTermPeriod = $request->termPrice;
       $p->priceSpotPeriod = $request->spotPrice;
       $p->gainCumul = $request->gainCumul;
       $p->priceGap = $request->priceGap;
       $p->globalGap = $request->globalGap;
       $p->save();
     }
     //FIN UPDATE


     //AFFECTATION de message :
     $messageDefaut = DB::table('Message')->where('nameMessage','=','Défaut')->first();
     //variable permettant de savoir si un message a été affecté à une periode ou non (utile pour envoyer le message par défaut si aucun message n'a été affecté)
     $messageAffecte = false;
     if ($p->globalGap != null){ //Si le contrat poistion a une valeur : on doit lui affecter un message
       //Récupération de tous les messages
       $messages = Message::all();
       foreach ($messages as $mes) {
         //Si le l'écart global est compris entre ecartGlobalMin et ecartGlobalMax du message. Le message est affecté à la période.
         if ($mes->ecartGlobalMin <= $p->globalGap && $mes->ecartGlobalMax >$p->globalGap){
           $p->idMessage = $mes->idMessage;
           $p->save();
           $message = $mes;

           $messageAffecte = true;
         }
       }
       //Si aucun message n'a été affecté, on affecte le message par défaut.
       if (!$messageAffecte){
         $p->idMessage = $messageDefaut->idMessage;
         $p->save();
         $message = $messageDefaut;
       }
     }else{//Si le global gap n'a pas de valeur : on doit lui affecter le message par défaut
       $p->idMessage = $messageDefaut->idMessage;
       $p->save();
       $message = $messageDefaut;
     }
     //FIN affectation de message
     $nbrPeriodes = DB::table('EditableParameter')->select('nbrPeriodes')->where('idParam','=',1)->first()->nbrPeriodes;
      
     if($numMax != $nbrPeriodes ){
       //CREATION d'une nouvelle période
       $numMax += 1;
       $period = Period::create([
         'numberPeriod' => $numMax,
         'idGame' => $request->idGame,
       ]);
       //FIN CREATION nouvelle période



       //AFFECTATION informations
       $types = TypeInformation::all();
       if($game->replay != NULL){
         $infos = DB::select('SELECT idInformation FROM Information WHERE idInformation IN (SELECT hi.idInformation FROM haveInformation hi, Period p, Information i WHERE hi.idPeriod = p.idPeriod and hi.idInformation = i.idInformation and p.numberPeriod = ? and p.idGame = ?)', [1, $game->replay] );
         for ($i = 0; $i <= 2; $i++) {
             $info = $infos[$i]->idInformation;
             //Affectation des informations à la nouvelle partie
             DB::insert('insert into haveInformation (idPeriod, idInformation) values (?, ?)', [
                 $period->idPeriod,
                 $info,
             ]);
         }
       }else {
         foreach ($types as $type) {
           $infos = DB::select('SELECT idInformation FROM Information WHERE typeInfoId = ? and idInformation NOT IN ( SELECT i.idInformation FROM Information i, Period p, haveInformation hi WHERE p.idGame = ? and hi.idPeriod = p.idPeriod and hi.idInformation = i.idInformation and i.typeInfoId = ?)', [$type->idTypeInfo, $request->idGame, $type->idTypeInfo]);
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

       //FIN AFFECTATION Information
     }

     return redirect()->route('period.show', ['id' => $idMax]);
   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id period
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
      // recuperation de la quantité et contrats restante
      /*$quantiteRestante = Session::get('quantiteRestante');
      $contratsRestante = Session::get('contratsRestante');*/
      // //Récupération nombre de partie max 
      $nbrPeriodes = DB::table('EditableParameter')->select('nbrPeriodes')->where('idParam','=',1)->first()->nbrPeriodes;
      //Récupération de la partie dans game
      $idGame = DB::table('Period')->select('idGame')->where('idPeriod', '=', $id)->first()->idGame;
      $game = DB::table('Game')->where('idGame','=',$idGame)->first();

      //Récupération des période de la partie
      $periods = DB::select('select * from Period p where p.idGame = ? ORDER BY numberPeriod ASC', [$idGame]);
      $periodsMail = DB::select('select * from Period p where p.idGame = ? ORDER BY numberPeriod DESC', [$idGame]);
      //Récupération de l'id de la période max
      $numMax = DB::table('Period')->where('idGame','=',$idGame)->max('numberPeriod');
      $idMax = DB::table('Period')->select('idPeriod')->where('numberPeriod','=',$numMax)->where('idGame','=',$idGame)->first()->idPeriod;

      //Récupération des informations de la période ayant l'idPeriod : id
      $informations = DB::select('SELECT * FROM Information WHERE idInformation IN ( SELECT i.idInformation FROM Information i, haveInformation hi WHERE hi.idPeriod = ? and hi.idInformation = i.idInformation)', [$id]);

      //Récupération du message de la période :
      $message = DB::select('SELECT * FROM Message m,Period p WHERE m.idMessage=p.idMessage and p.idPeriod = ?', [$id])[0];

      //Bilan de la période
      $bilan = DB::table('Period')->select('gainCumul','priceGap','globalGap', 'priceSpotPeriod', 'priceTermPeriod','objectivePrice')->where('idPeriod', '=', $id)->first();
      $isSold = false;
      $numberContrat = 0;
      foreach ($periods as $period) {
        if($period->isSold==1){
          $isSold = true;
        }
        if ($period->numberPeriod != $numMax){
          $numberContrat += $period->contratPosition;
        }
      }
      return view('period.periodShow', compact('game','periods','periodsMail','idMax','id','informations', 'message', 'numMax', 'bilan','nbrPeriodes','period'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id du Game
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
       //Récupération de la partie dans game
      $idGame = $id;
      //Recuperation de la quantité total autorise 
      $quantiteTotal = Db::table('EditableParameter')->select('quantite')->where('idParam','=',1)->first()->quantite;
      
      //Recuperation du nombre des periodes total d'un game 
      $nbrPeriodes = DB::table('EditableParameter')->select('nbrPeriodes')->where('idParam','=',1)->first()->nbrPeriodes;
      
      //Récupératipn de la variable EBM qui permet de bloquer le nombre de contrats que l'user peut acheter.
      $EBM = DB::table('EditableParameter')->select('levierEBM')->where('idParam','=',1)->first()->levierEBM;

     //Récupération des période de la partie
      $periods = DB::select('select * from Period p where p.idGame = ? ORDER BY numberPeriod ASC', [$id]);
      $periodsMail = DB::select('select * from Period p where p.idGame = ? ORDER BY numberPeriod DESC', [$id]);
      //Récupération de l'id de la période max :
      $numMax = DB::table('Period')->where('idGame','=',$id)->max('numberPeriod');
   
      $idMax = DB::table('Period')->select('idPeriod')->where('numberPeriod','=',$numMax)->where('idGame','=',$id)->first()->idPeriod;
   
      //Variable isSold = false si la production n'a pas déjà été vendu et true sinon
      $isSold = false;
      $numberContrat = 0;
       $quantite = 0;
      foreach ($periods as $period) {
        if($period->isSold==1){
          $isSold = true;
        }
        if ($period->numberPeriod != $numMax && $period->quantite != $quantiteTotal ){
          $numberContrat += $period->contratPosition;
          $quantite += $period->quantite;
        }
      }

      //Récupération des informations de la période ayant l'idPeriod : id
      $informations = DB::select('SELECT * FROM Information WHERE idInformation IN ( SELECT i.idInformation FROM Information i, haveInformation hi WHERE hi.idPeriod = ? and hi.idInformation = i.idInformation)', [$idMax]);

      //Récupération de la partie dans game
      $game = DB::table('Game')->where('idGame','=',$id)->first();

      //Récupération paramètres utiles pour le calcul de prix
      $editParam = DB::table('EditableParameter')->first();
      $objectivePrice = DB::table('Game')->select('objectivePrice')->where('idGame','=',$id)->first()->objectivePrice;

      if($numMax == 1){
        $termPrice = DB::table('Game')->select('priceTermGame')->where('idGame','=',$id)->first()->priceTermGame;
        $spotPrice = DB::table('Game')->select('priceSpotGame')->where('idGame','=',$id)->first()->priceSpotGame;
        $gainCumul = 0;
      } else {
        $termPrice = DB::table('Period')->select('priceTermPeriod')->where('numberPeriod','=',$numMax-1)->where('idGame','=',$id)->first()->priceTermPeriod;
        $spotPrice = DB::table('Period')->select('priceSpotPeriod')->where('numberPeriod','=',$numMax-1)->where('idGame','=',$id)->first()->priceSpotPeriod;
        $gainCumul = DB::table('Period')->select('gainCumul')->where('numberPeriod','=',$numMax-1)->where('idGame','=',$id)->first()->gainCumul;
      }
      /*$quantiteRestante = Session::get('quantiteRestante');
      $contratsRestante = Session::get('contratsRestante');*/
      return view('period.periodEdit', compact('game','periods','periodsMail','idMax','isSold', 'informations', 'editParam', 'termPrice', 'gainCumul','numMax','numberContrat','nbrPeriodes','spotPrice','EBM','quantiteTotal','quantite'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id de la période à update
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
}
