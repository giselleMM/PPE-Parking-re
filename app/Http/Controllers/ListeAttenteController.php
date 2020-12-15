<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\reservation;
use App\utilisateur;


class ListeAttenteController extends Controller
{
    public function getAttente(){
        $reservations = reservation::where('statut', 'attente')->get();
        $utilisateurs = utilisateur::whereNotNull('rang')->get()->sortBy('rang');
        return view('/pages/admin/ListeAttente')->with(compact("reservations","utilisateurs"));
    }

    public function augRang($id)
  {
        $utilisateur = utilisateur::find($id);
        $reservAvant = $utilisateur->where('rang',$utilisateur->rang-1)->first();
        if($reservAvant)
        {
            $reservAvant->rang = $reservAvant->rang + 1;
            $reservAvant->save();
            $utilisateur->rang = $utilisateur->rang - 1;
            $utilisateur->save();
            return redirect()->back()->with('message',"Changement réussi");
        } return redirect()->back()->with('message',"La réservation est en premiére position");

    }

    public function baissRang($id)
    {
        $utilisateur = utilisateur::find($id);
        $reservApres = $utilisateur->where('rang',$utilisateur->rang+1)->first();
        if($reservApres)
        {
            $reservApres->rang = $reservApres->rang - 1;
            $reservApres->save();
            $utilisateur->rang = $utilisateur->rang + 1;
            $utilisateur->save();
            return redirect()->back()->with('message',"Changement réussi");
        }return redirect()->back()->with('message',"La réservation est en derniere position");
    }

    public function suppRang($id)
    {
        $utilisateur = utilisateur::find($id);
        $nbUtilisateurAttente = utilisateur::whereNotNull('rang')->count();
        if($utilisateur->rang == $nbUtilisateurAttente)
        {
            $utilisateur->rang = NULL;
            $utilisateur->save();
        }
        else
        {
            $reservsApres = utilisateur::where('rang','>',$utilisateur->rang)->get();
            foreach($reservsApres as $reservApres)
            {
              $reservApres->rang = $reservApres->rang - 1;
              $reservApres->save();
            }
            $utilisateur->rang = NULL;
            $utilisateur->save();

        }
        $reservation = $utilisateur->reservations->where('statut','attente')->first();
        $reservation->statut = 'annulee';
        $reservation->save();
        return redirect()->back()->withErrors(["Vous avez bien annulé la réservation"]);
    }

}
