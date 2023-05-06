<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Historicterm;
use Illuminate\Support\Facades\DB;
class HistoricTermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $terms = DB::select('select * from HistoricTermPrice ORDER BY dateHistoricTermPrice DESC');

      return view('historicTerm.historicTermIndex', compact('terms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('historicTerm.historicTermCreate');
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
        'dateHistoricTermPrice' => 'required|date',
        'termPrice' => 'required|numeric',
      ];
      //Modification des messages d'erreurs
      $customMessages = [
      'required' => 'Veuillez rentrez la valeur : :attribute.',
      'numeric' => 'La valeur \':attribute\' doit être un nombre ',
      'date' => 'La valeur \':attribute\' doit être une date',
      ];

      $this->validate($request, $rules, $customMessages);

      $term = HistoricTerm::create([
        'dateHistoricTermPrice' => $request->dateHistoricTermPrice,
        'termPrice' => $request->termPrice]);
      return redirect('/historicTerm')->with('success', 'L\'historique d\'un prix terme a été ajouté');
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
      $term = HistoricTerm::find($id);
      return view('historicTerm.historicTermEdit', compact('term'));
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
        'dateHistoricTermPrice' => 'required|date',
        'termPrice' => 'required|numeric',
      ];
      //Modification des messages d'erreurs
      $customMessages = [
      'required' => 'Veuillez rentrez la valeur : :attribute.',
      'numeric' => 'La valeur \':attribute\' doit être un nombre ',
      'date' => 'La valeur \':attribute\' doit être une date',
      ];

      $this->validate($request, $rules, $customMessages);

      $term = HistoricTerm::find($id);
      $term->dateHistoricTermPrice = $request->get('dateHistoricTermPrice');
      $term->termPrice = $request->get('termPrice');
      $term->save();

      return redirect('historicTerm')->with('success', 'L\'historique d\'un prix terme a été mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $term = HistoricTerm::find($id);
      $term->delete();

      return redirect('/historicTerm')->with('success', 'L\'historique d\'un prix terme a été supprimé');
    }
}
