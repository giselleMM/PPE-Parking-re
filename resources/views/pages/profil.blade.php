@extends('main')
@section('content')
<div class="container p-2">
    <h2>Profil</h2>
    <P>Ici vous trouverez toutes vos informations sans pouvoir la régler. (Nous alons rajouter la possibilité de modifier le numéro
    de téléphone ainsi que le pseudo)</p>
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <table class="table table-striped">
        <tr>
             <td scope="col" class="text-center">Pseudo :</td>
             <td scope="col" class="text-center">{{$utilisateur->pseudo}}</td>
        </tr>
        <tr>
            <td scope="col" class="text-center">Nom : </td>
            <td scope="col" class="text-center">{{ $utilisateur->nom}}</td>
        </tr>
        <tr>
             <td scope="col" class="text-center">Prénom : </td>
             <td scope="col" class="text-center">{{ $utilisateur->prenom}}</td>
        </tr>
        <tr>
            <td scope="col" class="text-center">E-mail : </td>
            <td scope="col" class="text-center">{{ $utilisateur->email}}</td>
        </tr>
        <tr>
            <td scope="col" class="text-center">Téléphone : </td>
            <td scope="col" class="text-center">{{ $utilisateur->telephone}}</td>
        </tr>
        <tr>
            <td scope="col" class="text-center">Ligue : </td>
            <td scope="col" class="text-center">{{$utilisateur->ligue->nomligue}}</td>
        <tr>
    </table>
</div>

@endsection
