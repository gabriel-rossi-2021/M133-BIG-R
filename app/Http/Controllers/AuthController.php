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

        // LECTURE DU FICHIER DATA.TXT
        $users = file_get_contents(base_path('resources/data/data.txt'));

        // PARCOURS CHAQUE LIGNE DU FICHIER
        foreach(explode("\n", $users) as $user){
            // SÉPARER LE NOM D'UTILISATEUR ET LE MOT DE PASSE PAR LE CARACTÈRE DE DEUX POINTS (:)
            $credentials = explode(':', $user);

            // VÉRIFIER SI LE LOGIN ET LE MDP CORRESPOND
            if ($login == $credentials[0] && $pwd == $credentials[1]){
                //@Auth::login($user);

                return redirect()->intended('/compte');
            }
        }

        // Si les informations d'identification ne sont pas valides, l'utilisateur est redirigé vers la page de connexion avec un message d'erreur
        return redirect()->back()->withInput($request->only('email'))->withErrors([
            'error' => "L'email et/ou le mot de passe ne sont pas valides."
        ]);
    }



}
