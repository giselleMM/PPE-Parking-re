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
    <div class="container p-2">
        @if($reservOccupée || $reservAttente)
            @if($reservAttente)
                <h2>Votre reservation n° : {{$reservAttente['id']}}  est en attente</h2>
                <h2>Votre rang de la liste d'attente : {{$reservAttente::find($reservAttente->id)->utilisateur->rang}}</h2>
            @else
                <h2 class="text-center">Détail de la réservation :</h2>
                <table class="table table-hover">
                    <tr>
                        <td class="text-center">Vous occupez la place :</td>
                        <td>{{$reservOccupée::find($reservOccupée->id)->place_parking->libelle}}</td>
                    </tr>
                    <tr>
                        <td class="text-center">l'id réservation : </td>
                        <td>{{$reservOccupée['id']}}</td>
                    </tr>
                    <tr>
                        <td class="text-center">Date début de la réservation : </td>
                        <td>{{$reservOccupée['datedebut']}}</td>
                    </tr>
                    <tr>
                        <td class="text-center">Date demande de la réservation : </td>
                        <td>{{$reservOccupée['datedemande']}}</td>
                    <tr>
                    <tr>
                        <td class="text-center">Date expiration de la réservation : </td>
                        <td>{{$reservOccupée['dateexpiree']}}</td>
                    <tr>
                </table>
            @endif
            <h2 class="text-center">Annuler votre réservation</h2>
            <div class="text-center">
                <a class="btn btn-primary" href="{{route('delete')}}">Annuler une place</a>
            </div>
        @else
            <h2>Réserver votre place de parking</h2>
            <p>Pour éviter le stationnement sauvage dans le labyrinthe</p>
            <div class="text-center">
                <a class="btn btn-primary" href="{{route('create')}}">Réserver une place</a>
            </div>
        @endif
    </div>
@endsection
