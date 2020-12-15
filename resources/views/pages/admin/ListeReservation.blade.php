@extends('main')
@section('content')
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
        <h1>Liste des réservations :</h1>
        @if($reservations->isEmpty())
            <p class="h4 text-info text-center">Aucune Réservation en cours</p>
        @else
        <p>Réservation en cours</p>
        <table class="table table-hover">
            <thead class="table table-primary">
            <td>IdRéservation</td>
            <td>Date Demande</td>
            <td>Date Début</td>
            <td>Date Fin</td>
            <td>Place </td>
            <td>De </td>
            <td> Email </td>
            <td>Annuler</td>
            </thead>
            <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{$reservation->id}}</td>
                    <td>{{$reservation->datedebut}}</td>
                    <td>{{$reservation->datedemande}}</td>
                    <td>{{$reservation->dateexpiree}}</td>
                    <td>{{$reservation->place_parking->libelle}}</td> <!--Mettre le relation model-->
                    <td>{{$reservation->utilisateur->pseudo}}</td>
                    <td>{{$reservation->utilisateur->email}}</td><!--Mettre le relation model-->
                    <td><a class="btn btn-link" href="{{route('annuler', ['id'=>$reservation->id])}}">❌</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @endif

        <h1>Historique des réservation</h1>
        <p>Annuler(gris); finie(normal)</p>
        <table class="table table-hover">
            <thead class="table table-primary">
            <td>IdRéservation</td>
            <td>De l'utilisateur :</td>
            <td>Date Demande</td>
            <td>Date Début</td>
            <td>Date Fin</td>
            <td>Place :</td>
            </thead>
            <tbody>
            @foreach($historiques as $historique)
                <tr @if($historique->statut === 'annulee') class="table-danger"@endif>
                    <td>{{$historique->id}}</td>
                    <td>{{$historique->utilisateur->pseudo}}</td> <!--Mettre le relation model-->
                    <td>{{$historique->datedebut}}</td>
                    <td>{{$historique->datedemande}}</td>
                    <td>{{$historique->dateexpiree}}</td>
                    <td>{{($historique->place_parking_id === null)? "etait en attente":$historique->place_parking->libelle}}</td> <!--Mettre le relation model-->
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>


@endsection
