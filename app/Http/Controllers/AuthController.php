<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function index(){
        return view('connexion');
    }

    public function store(Request $request){
        $login = $request->input('username');
        $pwd = $request->input('password');

        // SI LE LOGIN ET MDP CORRESPOND
        if ($login == "test" && $pwd == "test"){
            return redirect()->intended('/compte');
        }
        else{
            // Si les informations d'identification ne sont pas valides, l'utilisateur est redirigé vers la page de connexion avec un message d'erreur
            return redirect()->back()->withInput($request->only('email'))->withErrors([
                'error' => "L'email et/ou le mot de passe ne sont pas valides."
            ]);
        }

        return view('index');
    }
}
