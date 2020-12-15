@extends('main')
@section('content')
    @php
        use App\Utils\SessionManager;
    @endphp
    @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{Session::get('message')}}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-dismissible alert-danger">
            {{$errors->first()}}
        </div>
    @endif
    <div class="container">
        <h1>Bienvenue a PPE-Parking </h1>
        @if (!SessionManager::isLogged())
            <p>Ceci est un projet personnalisé encadré qui a été codé avec le Framework Laravel.<br>
                Vous pouvez trouver les consignes du projet en cliquant sur le lien suivant <a href="http://enseignement.alexandre-mesle.com/PPE/parking/">PPE-Parking</a></p>
        @elseif (SessionManager::isAdmin())
            @if($users->isEmpty())
                <p class="h3 text-center text-info">Aucune demande d'inscription</p>
            @else
                <p>Voici la liste des demandes d'inscription pour réaliser une demande de réservation.</p>
                <table class="table table-hover">
                    <thead>
                    <tr class="table-primary">
                        <td>Pseudo</td>
                        <td>Nom</td>
                        <td>Prénom</td>
                        <td>Email</td>
                        <td>Telephone</td>
                        <td>Ligue</td>
                        <td>Accepter</td>
                        <td>Refuser</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->pseudo}}</td>
                            <td>{{$user->nom}}</td>
                            <td>{{$user->prenom}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->telephone}}</td>
                            <td>{{$user->ligue->nomligue}}</td>
                            <td><a class="btn btn-link" href={{route('valider',['id'=>$user->id])}}>✔️</a></td> <!--Créer un lien dynamic-->
                            <td><a class="btn btn-link" href={{route('refuser',['id'=>$user->id])}}>❌</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        @elseif (SessionManager::isPersV())
            <p>Vous êtes connecté en tant que personnel</p>
            <p class="h3">Ici, vous pouvez :</p>
            <ul>
                <li>Réserver un place de parking</li>
                <li> Consulter toutes les réservations que vous avez effectué</li>
                <li>Consulter votre profil (modification non possible pour l'instant)</li>
            </ul>
            <p class="h3">Informations concernant la réservation d'une place de parking :<p>
            <p>Vous ne pouvez effectuer qu'une seule réservation à la fois. blabla écrire ici comment la réservation fonctionne<br>
                Pour avoir plus d'information veuillez télécharger <a href="#">la documentation utilisateur</a></p>
        @elseif(SessionManager::isPersNV())
            <p>Bienvenue</p>
            <p>Votre compte est en attente de validation.</p>
        @endif
    </div>
@endsection

