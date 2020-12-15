<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\place_parking;
use Carbon\Carbon;
use App\reservation;
use App\utilisateur;

class AttribuerPlaceController extends Controller
{
    public function AttribuerPlace($id)
    {
        $places = place_parking::all();
        $currenteDate = date('yy-m-d');
        $dateFin = Carbon::now()->addMonths(1);
        $reservaVerifs = self::verifyPlaceParking($places);
        /*Ici 2 cas possible : s'il y a une place qui est vide alors je renvois l'id de la place
        *pour pouvoir attribuer une place à une demande de réservation
        *Si c'est une place qui est déjà utilisée alors je renvois un tableau
        *contenant les infos de cette reservation et je vérifie les dates pour voir si elle arrive à sa fin
        */
        if(is_array($reservaVerifs))
        {
            /*Après avoir vérifier le statut, on vérifie la date courante et la date limite(dateexpiree) pour voir s'il est libre ou pas */
            $reservationOccu = self::verifyDateReservation($reservaVerifs,$currenteDate);
            if($reservationOccu)
                return self::attribPlace($id,$reservationOccu,$currenteDate,$dateFin);
            return redirect()->back()->with('alert','Pas de place dispo');
        }
        return self::attribPlace($id,$reservaVerifs,$currenteDate,$dateFin);
    }

    private static function verifyPlaceParking($places)
    {
        $idPlace = 1;
        foreach($places as $place)
        {
            $reservOccupée = reservation::where('place_parking_id',$place['id'])
                                        ->where('statut','occupee')
                                        ->first();
            if(empty($reservOccupée))
                return $idPlace;
            $reservOccupées[] = $reservOccupée;
            $idPlace++;
        }
        return $reservOccupées;
    }

    private static function verifyDateReservation($reservaVerifs,$currenteDate)
    {
        foreach($reservaVerifs as $reservaVerif)
        {
            $occupee = $reservaVerif::where('id',$reservaVerif['id'])
                                    ->where('dateexpiree',$currenteDate)
                                    ->first();
            if($occupee)
                return $occupee;
                
        }
        return $occupee;
    }

    private static function attribPlace($id,$idparking,$currenteDate,$dateFin)
    {
        $reservation = reservation::where('utilisateur_id',$id)
                                    ->where('statut','attente')
                                    ->first();
        $reservChanger = $reservation::find($reservation->id);
        $reservChanger->statut = 'occupee';
        $reservChanger->place_parking_id = (is_int($idparking))?$idparking:$idparking['place_parking_id'];
        $reservChanger->datedebut = $currenteDate;
        $reservChanger->dateexpiree = $dateFin;
        $reservChanger->save();
        $utilisateur = utilisateur::find($id);
        $FileAttente = utilisateur::where('rang','>',$utilisateur->rang)->get();
        foreach($FileAttente as $attente)
        {
            $attente->rang = $attente->rang-1;
            $attente->save();
        }
        $utilisateur->rang = NULL;
        $utilisateur->save();
        if(!is_int($idparking))
        {
            $reservFin = reservation::find($idparking->id);
            $reservFin->statut = 'terminee';
            $reservFin->save();
            return redirect()->back()->with('message', 'Vous avez réussi à reserver une place !!');
            
        }
        return redirect()->back()->with('message', 'Vous avez réussi à reserver une place !!');
        
    }
}
