<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function index()
    {
        return view('updateCompte');
    }

    public function update(Request $request){
        // RECUPERER LES DONNEES
        $login = $request->input('username');
        $pwd = $request->input('pwd');
        $email = $request->input('email');
        $civilite = $request->input('civilite');

        $pwdHash = bcrypt($pwd);

        // OUVRIR LE FICHIER DATA.TXT EN MODE ECRITURE
        $file = fopen(base_path('resources/data/data.txt'), "w");

        // CONCATENER LES DONNEES RECUPEREES SEPARER PAR DES :
        $data = $login . ":" . $pwdHash . ":" . $email . ":" . $civilite;

        // MODIFIER LE FICHIER
        fwrite($file, $data);

        // FERMER LE FICHIER
        fclose($file);


        return view('updateCompte', compact('login', 'pwd', 'email', 'civilite'));

    }
}
