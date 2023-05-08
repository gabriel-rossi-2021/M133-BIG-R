<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdateController extends Controller
{
    public function index()
    {
        return view('updateCompte');
    }

    public function update(Request $request){
        // VALIDE LES ENTREES
        $validateData = $request->validate([
            'username' => 'required|regex:/^[^A-Z@]*$/|max:20',
            'pwd' => 'required|regex:/^(?=.*[A-Z]).{8,}$/',
            'email' => 'required|regex:/^([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/',
            'civilite' => 'required'
        ], [
            // MESSAGE D'ERREUR EN CAS DE NON RESPECT DE LA REGEX
            'username.regex' => "Le nom d'utilisateur ne doit pas contenir de majusucules et de '@'.",
            'pwd.regex' => "Le mot de pase doit contenir au moins 8 caractère et une majuscule.",
            'email.regex' => "L'email doit contenir un '@' et un '.'"
        ]);

        // RECUPERER LES DONNEES
        $login = $validateData['username'];
        $pwd = $validateData['pwd'];
        $email = $validateData['email'];
        $civilite = $validateData['civilite'];

        // HASHAGE MOT DE PASSE
        $pwdHash = Hash::make($pwd);

        // OUVRIR LE FICHIER DATA.TXT EN MODE ECRITURE
        $file = fopen(base_path('resources/data/data.txt'), "w");

        // CONCATENER LES DONNEES RECUPEREES SEPARER PAR DES :
        $data = $login . ":" . $pwdHash . ":" . $email . ":" . $civilite;

        // MODIFIER LE FICHIER
        fwrite($file, $data);

        // FERMER LE FICHIER
        fclose($file);

        // MESSAGE DE SUCCES
        return redirect()->route('vue_index')->with('success', 'Les informations ont été mises à jour');
    }
}
