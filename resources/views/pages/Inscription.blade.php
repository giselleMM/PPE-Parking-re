@extends('main')
@section('content')
<div class="container">
    <h2>Inscription</h2>
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
                <input type="text" class="form-control" name="pseudo" placeholder="Pseudo" value="{{ old('pseudo') }}">
                @if ($errors->has('pseudo'))
                    <p>{{ $errors->first('pseudo') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="mdp">Mot de passe* :</label>
                <input type="password" class="form-control" name="password" placeholder="Mot de passe" >
                @if ($errors->has('password'))
                    <p>{{ $errors->first('password') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="password_confirmation">Verification du Mot de passe* :</label>
                <input type="password" class="form-control" name="password_confirmation" placeholder="Vérification Mot de passe" >
                @if ($errors->has('password_confirmation'))
                    <p>{{ $errors->first('password_confirmation') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="nom">Nom* :</label>
                <input type="text" class="form-control" name="nom" placeholder="Nom" value="{{ old('nom') }}">
                @if ($errors->has('nom'))
                    <p>{{ $errors->first('nom') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="prenom">Prenom* :</label>
                <input type="text" class="form-control" name="prenom" placeholder="Prenom" value="{{ old('prenom') }}">
                @if ($errors->has('prenom'))
                    <p>{{ $errors->first('prenom') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="email">E-mail* :</label>
                <input type="email" class="form-control" name="email" placeholder="E-mail" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <p>{{ $errors->first('email') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="telephone">Téléphone* :</label>
                <input type="tel" class="form-control" name="telephone" placeholder="06********" maxlength="10" value="{{ old('telephone') }}">
                @if ($errors->has('telephone'))
                    <p>{{ $errors->first('telephone') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="Ligue">Ligue* :</label>
                <select name="ligue" class="form-control">
                    <option value="">Choissir une ligue...</option>
                    <option value="1">Ligue de Karate</option>
                    <option value="2">Ligue de Judo</option>
                    <option value="3">Ligue de Yoga</option>
                    <option value="4">Ligue de Athletisme</option>
                    <option value="5">Ligue de Rugby</option>
                    <option value="6">Ligue de Babyfoot</option>
                    <option value="7">Ligue de Natation</option>
                </select>
                @if ($errors->has('Ligue'))
                    <p>{{ $errors->first('Ligue') }}</p>
                @endif
            </div>

            <button type="submit" class="btn btn-primary" style="float:right;">Valider</button>
        </fieldset>
    </form>
</div>
    @endsection
