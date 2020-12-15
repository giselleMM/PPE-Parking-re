<?php

namespace App\Http\Controllers;

use App\reservation;
use App\place_parking;
use App\utilisateur;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class CreateController extends Controller
{
    /*Rajouter a cette fonction la vérification de la date expirée des réservations (direct ou ds une autre fonction)
    * Si dateExpiree = dateAujourdhui : on fait une modif du statut = fini
    * Sinon rien
    */
    public function getInfosReservation()
    {
        $reservOccupée = reservation::where('statut','occupée')->where('utilisateur_id',session('id'))->first();
        $reservAttente = reservation::where('statut','attente')->where('utilisateur_id',session('id'))->first();
        return view('/pages/reservation')->with(compact('reservOccupée','reservAttente'));
    }

    public function CreateReservation()
    {
        $id = session('id');
        $currentDate = date('yy-m-d');
        $dateEnd = Carbon::now()->addMonths(1);
        $places = place_parking::all();
        $parking = self::verifyPlaceParking($places);
        $verifyAttente = utilisateur::where('rang','!=',NULL)->count();
        if(!$verifyAttente)
        {
            if(is_array($parking))// --------Suppression de cette partie du code
            {
                $occupee = self::verifyDateReservation($parking,$currentDate);
                if($occupee)
                    return self::insertReservation($id,$currentDate,$dateEnd,$occupee);
                return self::insertWaitingQueue($id,$currentDate);
            }// -------
            return self::insertReservation($id,$currentDate,$dateEnd,$parking);
        }
        return self::insertWaitingQueue($id,$currentDate);
    }

    private static function verifyPlaceParking($places)
    {
        $i = 1;
        foreach($places as $place)
        {
            $placeP = reservation::where([['place_parking_id',$place['id']],['statut','occupee']])->first();
            if(empty($placeP))
                return $i;
            $placeParking[] = $placeP;
            $i++;
        }
        return $placeParking;
    }

    private static function verifyDateReservation($placeParkings,$currentDate) //Modification ou suppresion de cette fonction
    {
        /*
        * Si dateExpiree = dateAujourdhui : on fait une modif du statut = fini
        * Sinon rien
        */
        foreach($placeParkings as $placeParking)
        {
            $occupee = $placeParking::where([['id',$placeParking['id']],['dateexpiree',$currentDate]])->first();
            if($occupee)
                return $occupee;
        }
        return $occupee;
    }

    private static function insertReservation($id,$currentDate,$dateEnd,$place)
    {
        $reservation = new reservation();
        $reservation -> id;
        $reservation -> datedebut = $currentDate;
        $reservation -> dateDemande = $currentDate;
        $reservation -> dateexpiree = $dateEnd;
        $reservation -> statut = 'occupee';
        $reservation -> place_parking_id = (is_int($place))?$place:$place['place_parking_id'];
        $reservation -> utilisateur_id = $id;
        $reservation->save();
        return redirect()->back()->with('message', 'Vous avez réussi à reserver une place !!');//Faire un msg de confirmation sur la page d'accueil avec l'affichage du rang (s'il est dans la file d'attente);
        //return view('/pages/reservation');//Retour form reservation en affichant l'erreur
    }

    private static function insertWaitingQueue($id,$currentDate)
    {
        $reservation = new reservation();
        $reservation -> id;
        $reservation -> datedebut = $currentDate;
        $reservation -> dateDemande = $currentDate;
        $reservation -> statut = 'attente';
        $reservation -> utilisateur_id = $id;
        $reservation->save();
        if($reservation)
        {
            $utilisateur = reservation::find($reservation->id)->utilisateur;
            $utilisateur -> rang = self::incrementsWaitingQueue();
            $utilisateur -> save();
            return redirect()->back()->with('message', 'Vous êtes en attente !!');//Faire un msg de confirmation sur la page d'accueil avec l'affichage du rang (s'il est dans la file d'attente);
        }
        return redirect()->back()->withErrors(['Probléme de traitement! Veuillez reéssayer']);//Retour form reservation en indiquant l'erreur
    }

    private static function incrementsWaitingQueue()
    {
        $rang = utilisateur::all()->where('rang')->count();
        if($rang)
            return $rang+1;
        return $rang = 1;
    }
}
