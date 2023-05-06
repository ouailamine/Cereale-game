<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EditableParameter;

class EditableParameterController extends Controller
{
    /*
    *Show the form to edit the editable parameter
    *
    * @return
    */
    public function index(){
      $id = 1;
      $exist = EditableParameter::exists($id);

      if($exist){
        $editableParam = EditableParameter::find($id);
        return view('editableParameter.editableParameterIndex', compact('editableParam'));

      } else {
        abort('404');
      }
    }

    /*
    *Show the form to edit the editable parameter
    *
    * @return
    */
    public function edit($id){
      $exist = EditableParameter::exists($id);

      if($exist){
        $editableParam = EditableParameter::find($id);
        return view('editableParameter.editableParameterEdit', compact('editableParam'));

      } else {
        abort('404');
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
      //Validation formulaire
      $rules = [
        'plancher'=>'required|numeric',
        'plafond'=> 'required|numeric',
        'levierEBM' => 'required|numeric',
        'nbrPeriodes' => 'required|numeric',
        'quantite' => 'required|numeric',
        'prixTermeEsperance' => 'required|numeric',
        'prixTermeEcartType' => 'required|numeric',
        'prixSpotEsperance' => 'required|numeric',
        'prixSpotEcartType' => 'required|numeric',
        'spread' => 'required|numeric',
        'surveyLink' => 'required|max:500',
      ];
      //Modification des messages d'erreurs
      $customMessages = [
      'required' => 'Veuillez rentrez la valeur : :attribute.',
      'max' => 'Le lien vers le questionnaire ne peut pas contenir plus de 500 caractères.',
      'numeric' => 'La valeur \':attribute\' doit être un nombre ',
      ];

      $this->validate($request, $rules, $customMessages);

      $param = EditableParameter::find($id);
      $param->plancher = $request->get('plancher');
      $param->plafond = $request->get('plafond');
      $param->levierEBM = $request->get('levierEBM');
      $param->nbrPeriodes = $request->get('nbrPeriodes');
      $param->quantite = $request->get('quantite');
      $param->prixTermeEsperance = $request->get('prixTermeEsperance');
      $param->prixTermeEcartType = $request->get('prixTermeEcartType');
      $param->prixSpotEsperance = $request->get('prixSpotEsperance');
      $param->prixSpotEcartType = $request->get('prixSpotEcartType');
      $param->spread = $request->get('spread');
      $param->surveyLink = $request->get('surveyLink');
      $param->save();

     
      return redirect('/editableParameter')->with('success', 'Les paramètres modifiables ont été mis à jour');
    }

}
