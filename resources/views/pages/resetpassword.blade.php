<div class="container">
    <h2>Mot de passe oublié ?</h2>
    @if($errors->any())
        <div class="alert alert-dismissible alert-danger">
            {{$errors->first()}}
        </div>
    @endif
    <form method="post">
        @csrf
        <fieldset>
            <div class="form-group">
                <label for="email">Email* :</label>
                <input type="text" class="form-control" name="email" placeholder="Email" >
                @if ($errors->has('email'))
                    <p>{{ $errors->first('email') }}</p>
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
            <button style="float: right;" class="btn btn-primary">Modifier le mot de passe</button>
        </fieldset>
    </form>
    <a href="/connexion">Connexion</a>
</div>

@php
echo session('id');
@endphp