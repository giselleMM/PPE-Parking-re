@extends('main')
@section('content')
    <div class="container">
        <h3 class="p-2">Liste des utilisateurs</h3>
        <p>Vous pouvez modifier les informations suivantes : </p>
        <table class="table table-hover">
            <thead>
            <tr class="table-primary">
                <td>Pseudo</td>
                <td>Nom</td>
                <td>Prénom</td>
                <td>Email</td>
                <td>Telephone</td>
                <td>Ligue</td>
                <td>Etat</td>
                <td>Modifier</td>
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
                    <td>{{$user->role}}</td>
                    <td><a class="btn btn_link" href={{route('modifier',['id'=>$user->id])}}>✏️</a></td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
