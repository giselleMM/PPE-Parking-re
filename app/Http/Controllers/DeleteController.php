<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\utilisateur;

class DeleteController extends Controller
{
    public function DeleteReservation()
    {
        $id = session('id');
        $currentDate = date('yy-m-d');
        $reservation = utilisateur::find($id)->reservations->last();
        $reservation->dateexpiree = $currentDate;
        $reservation->statut = 'annulee';
        //$reservation->place_parking_id = NULL;
        $reservation->save();
        if($reservation)
        {
            $utilisateur = utilisateur::find($id);
            $utilisateur->rang = NULL;
            $utilisateur->save();
            return redirect()->back()->with('message','Annulation Réussie');
        }
        return redirect()->back()->withErrors(['Annulation ratée']);
    }
}
