@extends('main')
@section('content')
    <a class="h4 p-4" href="/listeUtilisateur">Retour</a>

    @if (Session::has('alert'))
        <div class="alert alert-warning" role="alert">
            {{Session::get('alert')}}
        </div>
    @endif
    <div class="container">
        <h3>Modification des données de l'utilisateur : {{$user->pseudo}} (id : {{$user->id}})</h3>

        <form method="post">
            @csrf
            <fieldset>
                <input type="hidden" value="{{$user->id}}" name="id">
                <div class="form-group">
                    <label for="pseudo">Pseudo * :</label>
                    <input type="text" class="form-control" name="pseudo" placeholder="pseudo" value="{{ $user->pseudo }}">
                </div>

                <div class="form-group">
                    <label for="nom">Nom* :</label>
                    <input type="text" class="form-control" name="nom" placeholder="Nom" value="{{ $user->nom }}">
                </div>

                <div class="form-group">
                    <label for="prenom">Prenom* :</label>
                    <input type="text" class="form-control" name="prenom" placeholder="Prenom" value="{{ $user->prenom }}">
                </div>

                <div class="form-group">
                    <label for="email">E-mail* :</label>
                    <input type="email" class="form-control" name="email" placeholder="E-mail" value="{{ $user->email }}">
                </div>

                <div class="form-group">
                    <label for="telephone">Téléphone* :</label>
                    <input type="tel" class="form-control" name="telephone" placeholder="06********" maxlength="10" value="{{ $user->telephone}}">
                </div>

                <div class="form-group">
                    <label for="ligue">Ligue</label>
                    <select class="form-control" name="ligue" >
                        @foreach($ligues as $ligue)
                            <option value="{{$ligue->id}}" {{ $ligue->id !== $user->ligue_id ?: 'selected' }}>{{$ligue->nomligue}}
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="etat">Etat</label>
                    <select class="form-control" name="etat" >
                        <option value="Valide" {{"Valide" !== $user->role ?:'selected'}}>Valide
                        <option value="Non Valide" {{"Non Valide" !== $user->role ?: 'selected'}}>Non Valide
                        <option value="Refuser" {{"Refuser" !== $user->role ?: 'selected'}}> Refuser
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </fieldset>
        </form>

    </div>
@endsection
