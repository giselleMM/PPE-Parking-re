<?php

namespace App\Http\Controllers;

use App\place_parking;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;


class ListePlaceController extends Controller
{
    public function getListePlace(){
        $places = place_parking::all();
        Return view('/pages/admin/listePlace')->with(compact("places"));
    }

    public function ajouterPlace(){
        $libelle = Request::input('libelle');

        $place = new place_parking();
        $place->id;
        $place->libelle = $libelle;
        $place->save();

        if($place)
            return Redirect::back()->with('message', "Vous avez ajouté une place de parking");
        return Redirect::back()->withErrors(["Nous n'avons pas pu ajouter la place parking"]);
    }

    public function supprimerPlace($id_place){
        $delete = place_parking::find($id_place)->delete();
        if($delete)
            return Redirect::back()->with('message', "Vous avez supprimez la place ");
        return Redirect::back()->withErrors(['Probleme de suppression']);
    }


}
