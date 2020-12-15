@extends('main')
@section('content')
<div class="container">
    <h2>Connexion</h2>
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-dismissible alert-danger">
            {{$errors->first()}}
        </div>
    @endif
    <form method="post">
        @csrf
        <fieldset>
            <div class="form-group">
                <label for="id">Pseudo* :</label>
                <input type="text" class="form-control" name="pseudo" placeholder="pseudo" >
            </div>
            <div class="form-group">
                <label for="mdp">Mot de passe* :</label>
                <input type="password" class="form-control" name="mdp" placeholder="Mot de passe" >
            </div>
            <a href="/resetpassword">Mot de passe oublié ?</a>
            <button style="float: right;" class="btn btn-primary">Valider</button>
        </fieldset>
    </form>
    <a href="/Inscription">Inscription</a>
</div>
@php
echo session('id');
@endphp
@endsection
