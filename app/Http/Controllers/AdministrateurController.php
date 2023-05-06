<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class AdministrateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = auth()->user();
      $admins = DB::select('select * from cerealusers where isAdmin = ?', [1]);

      return view('administrateur.administrateurIndex', compact('admins','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrateur.administrateurCreate');
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
        'pseudoUser' => 'required|string|max:255|unique:cerealusers',
        'email' => 'nullable|string|email|max:255|unique:cerealusers',
        'password' => 'required|string|min:6|confirmed',
      ];
      //Modification des messages d'erreurs
      $customMessages = [
          'required' => 'Le champ :attribute est obligatoire.',
          'email' => "Cette adresse email n'est pas valide.",
          'string' => 'Le champ :attribute doit être une chaîne de caractères.',
          'max' => 'Le champ :attribute doit faire au maximum :max caractères.',
          'min' => 'Le champ :attribute doit faire au minimum :min caractères.',
          'boolean' => 'Le champ :attribute doit être vrai ou faux.',
          'confirmed' => 'Les mots de passe ne correspondent pas.',
          'unique' => 'Déjà utilisé.',
      ];

      $this->validate($request, $rules, $customMessages);

      $request->password = Hash::make($request->password);

      DB::insert('insert into cerealusers (pseudoUser, password, isAdmin, isFarmer, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [
          $request->pseudoUser,
          $request->password,
          true,
          false,
          Carbon::now()->toDateTimeString(),
          Carbon::now()->toDateTimeString()
      ]);
      return redirect('/administrateur')->with('success', 'Un compte administrateur a été ajouté !');
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
     * @param  int  $id user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $exist = User::exists($id);
      if($exist){
        return view('administrateur.changePassword', compact('id'));
      } else {
        abort('404');
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id of the user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      //Validation formulaire
      $exist = User::exists($id);
      if($exist){
        $user = User::find($id);
        $rules = [
          'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
          if (!\Hash::check($value, $user->password)) {
              return $fail(__('The current password is incorrect.'));
          }}],
          'password' => 'required|string|min:6|confirmed',
        ];
        //Modification des messages d'erreurs
        $customMessages = [
        'required' => 'Veuillez rentrez la valeur : :attribute.',
        'string' => 'Le champ :attribute doit être une chaîne de caractères.',
        'min' => 'Le champ :attribute doit faire au minimum :min caractères.',
        'confirmed' => 'Les mots de passe ne correspondent pas.',
        ];

        $this->validate($request, $rules, $customMessages);

        $request->password = Hash::make($request->password);

        $admin = User::find($id);
        $admin->password = $request->password;
        $admin->save();

        return redirect('/administrateur')->with('success', 'Le mot de passe a bien été mis à jour');
      }else{
        abort('404');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $message = User::find($id);
      $message->delete();

      return redirect('/administrateur')->with('success', ' Un compte administrateur a été supprimé !');
    }

}
