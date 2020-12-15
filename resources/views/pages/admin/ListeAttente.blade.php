@extends('main')
@section('content')
@if (Session::has('message'))
    <div class="alert alert-success" role="alert">
       {{Session::get('message')}}
    </div>
@endif
@if (Session::has('alert'))
    <div class="alert alert-success" role="alert">
       {{Session::get('alert')}}
    </div>
@endif
<div class="container">
    <h3 class="p-2">File d'attente :</h3>
    Voici la file d'attente pour les réservations qui n'ont pas eu leur place :
    <table class="table table-hover">
        <tr>
            <td>Rang</td>
            <td>Nom de l'utisateur</td>
        </tr>
        @foreach($utilisateurs as $utilisateur)
           <tr> 
            <td>{{$utilisateur->rang}}</td>
            <td>{{$utilisateur->nom}}</td>
                <td><a class="btn btn_link" href={{route('augmenter',['id'=>$utilisateur->id])}}>⬆️</a></td>
                <td><a class="btn btn_link" href={{route('baisser',['id'=>$utilisateur->id])}}>⬇️</a></td>
                <td><a class="btn btn_link" href={{route('supp',['id'=>$utilisateur->id])}}>❌</a></td>
                <td>
                    @if($utilisateur->rang == 1)
                        <a type="button" class="btn btn-primary" style="float:right" href={{route('attribuer',['id'=>$utilisateur->id])}}>Attribuer une place</a>
                    @endif
                </td>
           </tr> 
        @endforeach
    </table>
</div>
@endsection

