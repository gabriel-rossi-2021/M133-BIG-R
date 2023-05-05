<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function index(){
        return view('connexion');
    }

    public function store(Request $request){
        // RECUPERER LES DONNEES
        $login = $request->input('username');
        $pwd = $request->input('password');

        // HASH DU MOT DE PASSE
        $pwdHash = Hash::make($pwd);

        // LECTURE DU FICHIER DATA.TXT
        $users = file_get_contents(base_path('resources/data/data.txt'));

        // PARCOURS CHAQUE LIGNE DU FICHIER
        foreach(explode("\n", $users) as $user){
            // SÉPARER LE NOM D'UTILISATEUR ET LE MOT DE PASSE PAR LE CARACTÈRE DE DEUX POINTS (:)
            $credentials = explode(':', $user);

            // VÉRIFIER SI LE LOGIN ET LE MDP CORRESPOND
            if ($login == $credentials[0] && Hash::check($pwd, $pwdHash) == $credentials[1]){
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
