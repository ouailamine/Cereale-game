<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HistoricSpot;
use Illuminate\Support\Facades\DB;

class HistoricSpotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //$spots = HistoricSpot::all();
      $spots = DB::select('select * from HistoricSpotPrice ORDER BY dateHistoricSpotPrice DESC');
      return view('historicSpot.historicSpotIndex', compact('spots'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('historicSpot.historicSpotCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //Validation formulaire
      $rules = [
        'dateHistoricSpotPrice' => 'required|date',
        'spotPrice' => 'required|numeric',
      ];
      //Modification des messages d'erreurs
      $customMessages = [
      'required' => 'Veuillez rentrez la valeur : :attribute.',
      'numeric' => 'La valeur \':attribute\' doit être un nombre ',
      'date' => 'La valeur \':attribute\' doit être une date',
      ];

      $this->validate($request, $rules, $customMessages);

      $spot = HistoricSpot::create([
        'dateHistoricSpotPrice' => $request->dateHistoricSpotPrice,
        'spotPrice' => $request->spotPrice]);
      return redirect('/historicSpot')->with('success', 'L\'historique d\'un prix spot a été ajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $spot = HistoricSpot::find($id);
      return view('historicSpot.historicSpotEdit', compact('spot'));
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
      //Validation formulaire
      $rules = [
        'dateHistoricSpotPrice'=>'required|date',
        'spotPrice'=> 'required|numeric',
      ];
      //Modification des messages d'erreurs
      $customMessages = [
      'required' => 'Veuillez rentrez la valeur : :attribute.',
      'numeric' => 'La valeur \':attribute\' doit être un nombre ',
      'date' => 'La valeur \':attribute\' doit être une date',
      ];

      $this->validate($request, $rules, $customMessages);

      $spot = HistoricSpot::find($id);
      $spot->dateHistoricSpotPrice = $request->get('dateHistoricSpotPrice');
      $spot->spotPrice = $request->get('spotPrice');
      $spot->save();

      return redirect('historicSpot')->with('success', 'L\'historique d\'un prix spot a été mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $spot = HistoricSpot::find($id);
      $spot->delete();

      return redirect('/historicSpot')->with('success', 'L\'historique d\'un prix spot a été suprimé');
    }
}
