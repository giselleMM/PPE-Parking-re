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
    <div class="container">
        <h3 class="p-2">Liste des places de parking</h3>
        Voici la liste des places de parking :
        <table class="table table-hover">
            <thead class="table table-primary">
            <tr>
                <td>Place de parking</td>
                <td>Disponible</td>
                <td>Supprimer la place</td>
            </tr>
            </thead>
            <tbody>
            @foreach($places as $place)
            <tr>
                <td>{{$place->id}}</td>
                <td>{{$place->libelle}}</td>
                <td><a class="btn btn_link" href="{{route('supprimer',['id'=>$place->id])}}">❌</a></td>
            </tr>
                @endforeach
            </tbody>
        </table>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Ajouter une place</button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Formulaire d'ajout d'une place</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            @csrf
                            <div class="form-group">
                                <label for="libelle">Libelle : </label>
                                <input class="form-control" type="text" name="libelle" placeholder="Libelle de la place">
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Ajouter</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
