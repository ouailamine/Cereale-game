<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Information;
use App\TypeInformation;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $infos = Information::all();
      $typeInfos = TypeInformation::all();

      return view('information.informationIndex', compact('infos','typeInfos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $typeInfos = TypeInformation::all();
      return view('information.informationCreate', compact('typeInfos'));
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
        'deltaInformation' => 'required|numeric',
        'nameInformation' => 'required|max:200',
        'typeInfoId' => 'required|numeric'
      ];
      //Modification des messages d'erreurs
      $customMessages = [
        'required' => 'Veuillez rentrez la valeur : :attribute.',
        'numeric' => 'La valeur \':attribute\' doit être un nombre ',
        'date' => 'La valeur \':attribute\' doit être une date',
        'max' => 'La valeur \':attribute\' ne peut pas contenir plus de 200 caractères',
      ];

      $this->validate($request, $rules, $customMessages);

      $info = Information::create([
        'deltaInformation' => $request->deltaInformation,
        'nameInformation' => $request->nameInformation,
        'typeInfoId' => $request->typeInfoId
      ]);
      return redirect('/information')->with('success', 'L\'information a été ajouté');
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
      $info = Information::find($id);
      $typeInfos = TypeInformation::all();
      return view('information.informationEdit', compact('info','typeInfos'));
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
        'deltaInformation' => 'required|numeric',
        'nameInformation' => 'required|max:200',
        'typeInfoId' => 'required|numeric'
      ];
      //Modification des messages d'erreurs
      $customMessages = [
        'required' => 'Veuillez rentrez la valeur : :attribute.',
        'numeric' => 'La valeur \':attribute\' doit être un nombre ',
        'date' => 'La valeur \':attribute\' doit être une date',
        'max' => 'La valeur \':attribute\' ne peut pas contenir plus de 200 caractères',
      ];

      $this->validate($request, $rules, $customMessages);

      $info = Information::find($id);
      $info->deltaInformation = $request->get('deltaInformation');
      $info->nameInformation = $request->get('nameInformation');
      $info->typeInfoId = $request->get('typeInfoId');
      $info->save();

      return redirect('information')->with('success', 'L\'information a bien été mise à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $info = Information::find($id);
      $info->delete();

      return redirect('/information')->with('success', ' Une information a été supprimé');
    }
}
