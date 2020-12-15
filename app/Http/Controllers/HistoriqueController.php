<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\reservation;

class HistoriqueController extends Controller
{
    public function getMesReservations()
    {
        $reservTerminée = reservation::where([['statut','terminee'],['utilisateur_id',session('id')]])->get();
        $i = 1;
        return view('/pages/historique')->with(compact('reservTerminée','i'));
    }
}
