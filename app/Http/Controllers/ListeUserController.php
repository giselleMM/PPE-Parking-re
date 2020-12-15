<?php

namespace App\Http\Controllers;


use App\Enums\AccountEnum;
use App\ligue;
use App\personnel;
use App\utilisateur;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ListeUserController extends Controller
{
    public function getAllPersonnel(){
        $users = utilisateur::where('role','!=' ,AccountEnum::ACC_ADMIN)
            ->get();
        Return view('/pages/admin/ListeUtilisateur')->with(compact("users"));
    }

    public function redirectModifier($id){
        $user = utilisateur::find($id);
        $ligues = ligue::all();
        return view('/pages/admin/modifierUtilisateur')->with(compact("user", "ligues"));
    }

    public function saveUpdate(){
        $data = Request::all();

        $user = utilisateur::find($data['id']);
        $user->pseudo = $data['pseudo'];
        $user->nom = $data['nom'];
        $user->prenom = $data['prenom'];
        $user->email = $data['email'];
        $user->telephone = $data['telephone'];
        $user->ligue_id =  $data['ligue'];
        $user->role = $data['etat'];
        $user->save();
        if($user)
            return self::getAllPersonnel();
        return Redirect::back()->withErrors("Probleme de modification");
    }
}
