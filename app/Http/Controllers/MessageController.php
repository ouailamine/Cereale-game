<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Illuminate\Support\Facades\DB;
use App\Providers\AppServiceProvider;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $messages = DB::select('select * from Message ORDER BY ecartGlobalMin DESC');

      return view('message.messageIndex', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('message.messageCreate');
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
        'nameMessage' => 'required|max:200',
        'descriptionMessage' => 'required|max:1000',
        'ecartGlobalMin'=> 'required|numeric',
        'ecartGlobalMax'=> 'required|numeric|greater_than_field:ecartGlobalMin',
      ];

      //Modification des messages d'erreurs
      $customMessages = [
        'required' => 'Veuillez rentrez la valeur : :attribute.',
        'numeric' => 'La valeur \':attribute\' doit être un nombre.',
        'date' => 'La valeur \':attribute\' doit être une date.',
        'max' => 'Le nom ne peut pas contenir plus de 200 caractères et la description plus de 1000.',
        'greater_than_field' => 'Le prix de vente maximum doit être supérieur au prix de vente minimum',
      ];

      $this->validate($request, $rules, $customMessages);

      $message = Message::create([
        'nameMessage' => $request->nameMessage,
        'descriptionMessage' => $request->descriptionMessage,
        'ecartGlobalMin' => $request->ecartGlobalMin,
        'ecartGlobalMax' => $request->ecartGlobalMax,
      ]);
      return redirect('/message')->with('success', 'Un message a été ajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $message = Message::find($id);
      return view('message.messageShow', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $message = Message::find($id);
      return view('message.messageEdit', compact('message'));
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
        'nameMessage' => 'required|max:200',
        'descriptionMessage' => 'required|max:1000',
        'ecartGlobalMin'=> 'required|numeric',
        'ecartGlobalMax'=> 'required|numeric|greater_than_field:ecartGlobalMin',
      ];

      //Modification des messages d'erreurs
      $customMessages = [
        'required' => 'Veuillez rentrez la valeur : :attribute.',
        'numeric' => 'La valeur \':attribute\' doit être un nombre.',
        'date' => 'La valeur \':attribute\' doit être une date.',
        'max' => 'Le nom ne peut pas contenir plus de 200 caractères et la description plus de 1000.',
        'greater_than_field' => 'Le prix de vente maximum doit être supérieur au prix de vente minimum',
      ];

      $this->validate($request, $rules, $customMessages);


      $message = Message::find($id);
      $message->nameMessage = $request->get('nameMessage');
      $message->descriptionMessage = $request->get('descriptionMessage');
      $message->ecartGlobalMin = $request->get('ecartGlobalMin');
      $message->ecartGlobalMax = $request->get('ecartGlobalMax');
      $message->save();

      return redirect('message')->with('success', 'Le message a été mis à jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $message = Message::find($id);
      $message->delete();

      return redirect('/message')->with('success', ' Le message a été supprimé ');
    }
}
