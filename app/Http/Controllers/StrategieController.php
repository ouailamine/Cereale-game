<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Illuminate\Support\Facades\DB;
class StrategieController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
         return view("strategie.strategieWelcome");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function date(Request $request)
    {
        return view("strategie.strategieEditDate");
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function echeance(Request $request)
    {
        $date = $request->date;
        Session::put('date',$date);

        $dateS = implode('/',array_reverse  (explode('/',$date)));
        $echeances = DB::select('select DISTINCT DATE_FORMAT(echeance, "%d/%m/%Y") as echeanceFr FROM strategie where date = ?', [$dateS]);
         return view('strategie.strategieEditEcheance',compact('echeances'));
    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function prix(Request $request )
    {
        
       $date = Session::get('date');
       $echeance = $request->echeance;
       Session::put('echeance',$echeance);
       
       $dateS = implode('/',array_reverse  (explode('/',$date)));
       $echeanceS = implode('-',array_reverse  (explode('/',$echeance)));
       $prixx = DB::select('select DISTINCT prix from strategie where date=? and echeance = ?', [$dateS,$echeanceS]);

         return view('strategie.strategieEditPrix',compact('prixx'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resultats(Request $request)
    {
       
        $prix = $request->prix;
        $date = Session::get('date');
        $echeance = Session::get('echeance');
        
        $dateS = implode('/',array_reverse  (explode('/',$date)));
        $echeanceS = implode('-',array_reverse  (explode('/',$echeance)));
        $resultats = DB::select('select tresorieMax,tresorieMin,prixAchatPut,prixVenteContrat,meileurSt from strategie where date = ? and echeance = ? and prix = ?', [$dateS,$echeanceS,$prix]);
        
        return view('strategie.strategieShow',compact('resultats','date','prix','echeance'));
    }


    



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }


     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       
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
