<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\utilisateur;

class ProfilController extends Controller
{
    public function getprofil()
    {
        $utilisateur = utilisateur::where('id',session('id'))->first();
        return view('/pages/profil')->with(compact('utilisateur'));
    }
}
