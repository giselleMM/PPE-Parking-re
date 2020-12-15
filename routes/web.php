<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

// Accueil
Route::view('/', '/pages/accueil');
Route::redirect('/accueil', '/');
Route::get('/', 'UserStateController@getPersonnelNV');
Route::get('/accueil/valider/{id}', 'UserStateController@valider')->name('valider');
Route::get('/accueil/refuser/{id}', 'UserStateController@refuser')->name('refuser');

//Inscription / Connexion / Deconnexion
Route::view('/Inscription', '/pages/Inscription');
Route::post('/Inscription', 'InscriptionController@inscrire');

Route::view('/connexion', '/pages/connexion');
Route::post('/connexion', 'AuthController@connexion');

Route::get('/deconnexion', function() {
    Request::session()->flush();
    return redirect('/');
});

//Mot de passe oublié
Route::post('/resetpassword','AuthController@ResetPassword');

//Reservation
Route::get('/reservation','CreateController@getInfosReservation');
Route::get('/reservation/create','CreateController@CreateReservation')->name('create');
Route::get('/reservation/delete','DeleteController@DeleteReservation')->name('delete');

//Profil
Route::get('/profil','ProfilController@getprofil');

//Historique
Route::get('/historique','HistoriqueController@getMesReservations');

//Liste des utilisateurs (Admin)
Route::view('/listeUtilisateur', '/pages/admin/ListeUtilisateur');
Route::get('/listeUtilisateur', 'ListeUserController@getAllPersonnel');
Route::get('/listeUtilisateur/modifier/{id}', 'ListeUserController@redirectModifier')->name('modifier');
Route::post('/listeUtilisateur/modifier/{id}', 'ListeUserController@saveUpdate');

//Liste des places parking (Admin)
Route::view('/listePlace', '/pages/admin/ListePlace');
Route::get('/listePlace', 'ListePlaceController@getListePlace');
Route::get('/listePlace/supprimer/{id}', 'ListePlaceController@supprimerPlace')->name('supprimer');
Route::post('/listePlace', 'ListePlaceController@ajouterPlace');

//Liste des réservations
Route::view('/listeReservation', '/pages/admin/ListeReservation');
Route::get('/listeReservation', 'ListeReservationController@getAllReservation');
Route::get('/listeReservation/annuler/{id}', 'ListeReservationController@annulerReservation')->name('annuler');

//File d'attente (Admin)
Route::view('/listeAttente', '/pages/admin/ListeAttente');
Route::get('/listeAttente', 'ListeAttenteController@getAttente');
Route::get('/listeAttente/aug/{id}', 'ListeAttenteController@augRang')->name('augmenter');
Route::get('/listeAttente/baiss/{id}', 'ListeAttenteController@baissRang')->name('baisser');
Route::get('/listeAttente/attribuer/{id}', 'AttribuerPlaceController@AttribuerPlace')->name('attribuer');
Route::get('/listeAttente/supp/{id}', 'ListeAttenteController@suppRang')->name('supp');