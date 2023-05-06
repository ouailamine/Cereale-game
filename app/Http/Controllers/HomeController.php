<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except("sendMail");
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nbrPeriodes = DB::table('EditableParameter')->select('nbrPeriodes')->where('idParam','=',1)->first()->nbrPeriodes;
      
        return view('home',compact('nbrPeriodes'));
    }


    public function sendMail()
    {
        
        request()->validate([
            'email' => ['email', 'required', 'max:255'],
            'name' => ['required', 'string'],
            'subject' => ['required', 'string'],
            'message' => ['required', 'string']
          ]);

    Mail::to("narjiss.araba@umontpellier.fr")->send(new ContactMail(request()->input()));
    return back()->with("mail envoyer");

    }
}
