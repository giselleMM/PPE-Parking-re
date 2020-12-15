<?php

namespace App\Http\Controllers;


use App\Enums\AccountEnum;
use App\personnel;
use App\utilisateur;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class UserStateController extends Controller
{
    public function getPersonnelNV()
    {
        $users = utilisateur::where('role', AccountEnum::ACC_PERSONV)->get();
        return view('/pages/accueil')->with(compact("users"));
    }

    public function valider($id){
        $user = utilisateur::find($id);
        $user->role = AccountEnum::ACC_PERSOV;
        $user->save();
        if($user)
            return back()->with('message', "Vous avez bien valider l'utilisateur : $user->pseudo");
        return Redirect::to('/');
    }

    public function refuser($id){
        $user = utilisateur::find($id);
        $user->role = AccountEnum::ACC_REFUSER;
        $user->save();
        if($user)
            return back()->withErrors(["Vous avez bien refusé l'utilisateur : $user->pseudo"]);
        return Redirect::to('/');
    }

}
