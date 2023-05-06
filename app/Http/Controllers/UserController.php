<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Game;
use App\Periode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /*public function __construct()
    {
      if(auth()->user()->id() == true) {
        $this->middleware('auth');
        $this->middleware('admin');
      } else {
        $this->middleware('auth');
        $this->middleware('farmer');
      }
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = DB::select('select * from cerealusers where isAdmin = ?', [0]);
      return view('user.userIndex', compact('users'));
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
     * @param  int  $id user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $exist = User::exists($id);

      if($exist){
        $pseudoUser = DB::table('cerealusers')->select('pseudoUser')->where('idUser','=',$id)->first()->pseudoUser;
        $games = DB::select('select * from Game where userId = ?', [$id]);
        $periods = DB::select('select * from Game g, Period p where g.userId = ? and g.idGame = p.idGame', [$id]);
        return view('user.userShow', compact('games','periods','id','pseudoUser'));
      } else {
        abort('404');
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $exist = User::exists($id);
      if($exist){
        return view('user.changePassword', compact('id'));
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
    public function update(Request $request, $id)
    {
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

        $customMessages = [
        'required' => 'Veuillez rentrez la valeur : :attribute.',
        'string' => 'Le champ :attribute doit être une chaîne de caractères.',
        'min' => 'Le champ :attribute doit faire au minimum :min caractères.',
        'confirmed' => 'Les mots de passe ne correspondent pas.',
        ];

        $this->validate($request, $rules, $customMessages);

        $request->password = Hash::make($request->password);

        $user->password = $request->password;
        $user->save();

        return redirect()->route('user.show', ['id' => $user->idUser]);

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
        //
    }
}
