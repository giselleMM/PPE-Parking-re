<?php

namespace App\Http\Controllers;

use App\reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class listeReservationController extends Controller
{
    public function getAllReservation(){
        $reservations = reservation::where('statut', 'occupee')
            ->get();

        $historiques = reservation::where('statut', 'terminee')
            ->orWhere('statut', 'annulee')
            ->get();
        Return view('/pages/admin/ListeReservation')->with(compact("reservations", "historiques"));
    }

    public function annulerReservation($id){
        $resAnnulée = reservation::find($id);
        $resAnnulée->dateexpiree = date('yy-m-d');
        $resAnnulée->statut = 'annulee';
        $resAnnulée->save();
        if($resAnnulée)
            return Redirect::back()->withErrors(['Vous avez annulé la reservation']);
        return Redirect::back()->withErrors(["Probleme d'annulation de la réservation"]);
    }
}
