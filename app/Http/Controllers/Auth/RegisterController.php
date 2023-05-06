<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
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

        return Validator::make($data, [
          'pseudoUser' => 'required|string|max:255|unique:cerealusers',
          'email' => 'nullable|string|email|max:255|unique:cerealusers',
          'password' => 'required|string|min:6|confirmed',
        ], $customMessages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'pseudoUser' => $data['pseudoUser'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'isAdmin' => isset($data['isAdmin']),
            'isFarmer' => isset($data['isFarmer']),
        ]);
    }
}
