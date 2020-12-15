@section('main')
<html lang="fr">
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        use \App\Utils\SessionManager;
    @endphp
</head>
<body>
    <div class="jumbotron text-center">
        <h1>PPE-PARKING</h1>
    </div>
    @if (SessionManager::isLogged())
        <div class="text-center mb-2">
            <span class="h3">Vous êtes connecté en tant que {{ \App\Utils\SessionManager::getFullTypeName() }}</span>
        </div>
    @endif
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        @if (!SessionManager::isLogged())
            <a class="btn btn-primary" href="/">Accueil</a>
            <a class="btn btn-primary" href="/connexion"></i>Connexion</a>
        @elseif (SessionManager::isAdmin())
            <a class="btn btn-primary" href="/">Accueil</a>
            <div class="dropdown show">
                <a class="btn btn-primary" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Utilisateur
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="/Inscription">Inscrire</a>
                    <a class="dropdown-item" href="/listeUtilisateur">Consulter la liste</a>
                </div>
            </div>
            <a class="btn btn-primary" href="/listePlace">Liste Place</a>
            <!--<div class="dropdown show">
                <a class="btn btn-primary" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Réservation
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#">Consulter la liste</a>
                    <a class="dropdown-item" href="/admin/HistoriqueParking">Historique</a>
                </div>
            </div>-->
            <a class="btn btn-primary" href="/listeReservation">Réservation</a>
            <a class="btn btn-primary" href="/listeAttente">Liste d'attente</a>
            <a class="btn btn-primary" href="/deconnexion">Deconnexion</a>

        @elseif (SessionManager::isPersV())
            <a class="btn btn-primary" href="/">Accueil</a>
            <a class="btn btn-primary" href="/reservation">Réservation</a>
            <a class="btn btn-primary" href="/historique">Historique</a>
            <a class="btn btn-primary" href="/profil">Profil</a>
            <a class="btn btn-primary" href="/deconnexion">Deconnexion</a>
        @else
            <a class="btn btn-primary" href="/">Accueil</a>
            <!--<a class="btn btn-primary" href="">Profil</a>-->
            <a class="btn btn-primary" href="/deconnexion">Deconnexion</a>
        @endif
    </nav>
</body>
</html>
@show
@yield('content')
