<?php

namespace App\Http\Controllers;

use App\Enums\AccountEnum;
use App\utilisateur;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class InscriptionController extends Controller
{
    public function inscrire()
    {
        //Vérification que tous les champs sont correctement remplis
        $rules = ([
            'pseudo' => ['required'],
            'password' => ['required'/*, 'min:8', 'confirmed'*/],
            'password_confirmation' => ['required'],
            'nom' => ['required'],
            'prenom' => ['required'],
            'email' => ['required', 'email'],
            'telephone' => ['required', 'digits:10'],
            'ligue' => ['required']
        ]);
        $validator = Validator::make(\Illuminate\Support\Facades\Request::all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors(["Votre formulaire n'est pas bien renseigné"]);
        }
        // Ici, on récupere tous les inputs dans un tableau --> $data
        $data = [
            'pseudo' => request('pseudo'),
            'mdp' => request('password'),
            'nom' => request('nom'),
            'prenom' => request('prenom'),
            'email' => request('email'),
            'telephone' => request('telephone'),
            'ligue' => request('ligue')
        ];
        return self::verifyUniqueData($data);
    }

    //On retrouve ds la bdd ds champs unique, cette fonction permet d'eviter l'affiche d'erreur "duplicate"
    private static function verifyUniqueData($data)
    {
        $id_exists = utilisateur::where('pseudo', $data['pseudo'])->exists();
        $email_exists = utilisateur::where('email', $data['email'])->exists();
        $tel_exists = utilisateur::where('telephone', $data['telephone'])->exists();

        if ($id_exists)
            return Redirect::back()->withErrors(['Cet indentifiant existe déjà!']);
        if ($email_exists)
            return Redirect::back()->withErrors(['Cet email existe déjà!']);
        if ($tel_exists)
            return Redirect::back()->withErrors(['Ce numero de telephone existe déjà!']);
        return self::saveUser($data);
    }
    //Sauvegarde d'un tuilisateur
    private static function saveUser($data){
        $session_exists = session('id');

        $user = new utilisateur();
        $user->id;
        $user->pseudo = $data['pseudo'];
        $user->mdp = Hash::make($data['mdp']); //Le Hash permet de hasher le mot de passe
        $user->nom = $data['nom'];
        $user->prenom = $data['prenom'];
        $user->email = $data['email'];
        $user->telephone = $data['telephone'];
        $user->ligue_id = $data['ligue'];
        $user->role = ($session_exists)?AccountEnum::ACC_PERSOV : AccountEnum::ACC_PERSONV;
        $user->save();

        if ($user)
            if($session_exists)
                return Redirect::to('/listeUtilisateur');
            return Redirect('/connexion');
        return Redirect::back()->withErrors(["Probleme d'inscription de l'utilisateur dans la base de donnée"]);
    }

}
