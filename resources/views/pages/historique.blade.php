@extends('main')
@section('content')
<div class="container p-2">
    <h2>Historique des réservations</h2>
    <table class="table table-hover">
        <thead class="table table-primary">
            <th class="text-center">#</th>
            <th class="text-center">Place attribuée</th>
            <th class="text-center">Date demande de la réservation</th>
            <th class="text-center">Date début de la réservation</th>
            <th class="text-center">Date fin de la réservation</th>

        </thead>
        <tbody>
        @foreach($reservTerminée as $historique)
            <tr>
                <td class="text-center">{{ $i++ }}</td>
                <td class="text-center">{{ $historique->place_parking->libelle}}</td>
                <td class="text-center">{{ $historique->datedemande }}</td>
                <td class="text-center">{{ $historique->datedebut}}</td>
                <td class="text-center">{{ $historique->dateexpiree}}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
