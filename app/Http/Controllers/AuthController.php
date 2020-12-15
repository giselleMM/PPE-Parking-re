<?php

namespace App\Http\Controllers;

use App\admin;
use App\Enums\AccountEnum;
use App\Enums\AuthEnum;
use App\personnel;
use App\utilisateur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request;

class AuthController extends Controller
{
    public function connexion()
    {
        $rules = [
            'pseudo' => 'required',
            'mdp' => 'required'
        ];
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors(["Votre formulaire n'est pas bien renseigné"]);
        }
        $data = [
            'pseudo'=> Request::input('pseudo'),
            'password' => Request::input('mdp')
        ];
        //vérification de l'existence identifiant
        $user = utilisateur::where('pseudo', $data['pseudo'])->first();
        if($user === NULL)
            return Redirect::back()->withErrors(["Vous devez vous inscrire"]);
        return self::verifyPassword($user, $data);
    }

    private static function verifyPassword($user, $data){
        $password = Hash::check($data['password'], $user->mdp);
        if($password)
            return self::getRoleUser($user);
        return Redirect::back()->withErrors(["Votre pseudo et mot de passe ne sont pas cohérents"]);
    }

    private static function getRoleUser($user){
        $id = $user->id;
        $admin = $user->role === AccountEnum::ACC_ADMIN;
        $personnelV = $user->role === AccountEnum::ACC_PERSOV;
        $personnelNV = $user->role === AccountEnum::ACC_PERSONV;
        if($admin)
            return self::logIn($id, AuthEnum::AUTH_ADMIN);
        if ($personnelV || $personnelNV){
            if($personnelV)
                return self::logIn($id, AuthEnum::AUTH_PERSV );
            return self::logIn($id, AuthEnum::AUTH_PERSNV);
        }
        return Redirect::back()->withErrors(['Votre compte à été refuser']);
    }

    //Fonction qui met l'pseudo de l'utilisateur en session
    private static function logIn($id, $auth){
        Request::session()->put('id', $id);
        Request::session()->put('type', $auth);
        return redirect('/')->with('message', 'Vous vous êtes bien connecté');
    }
    /*---------------------------------------------------------------------------------------------------*/
    //Fonction qui vérifie les champs et qui va changer le mdp
    public function ResetPassword()
    {
        $rules = [
            'email' => 'required',
            'password' => 'required '/*| confirmed | min:8'*/,
            'password_confirmation' => 'required'
        ];
        $validator = Validator::make(Request::all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors(["Votre formulaire n'est pas bien renseigné"]);
        }
        $data = [
            'email'=> Request::input('email'),
            'password' => Request::input('password')
        ];
        $user = utilisateur::where('email',$data['email'])->first();
        if($user === NULL)
            return Redirect::back()->withErrors(["L'email que vous avez saisi n'est pas reconnu"]);
        return self::ChangePassword($user, $data);
    }

    //Fonction qui permet de changer de mot de passe
    private static function ChangePassword($user, $data)
    {
        $password = Hash::make($data['password']);
        $user->where('email',$data['email'])
             ->update(['mdp'=>$password]);
        if($user)
            return redirect('/connexion');
        return "failed";
    }

}
