@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Véhicules de {{ $client->prenom }} {{ $client->nom }}</h1>

    <a href="{{ route('vehicules.create') }}" class="btn btn-primary mb-3">➕ Ajouter un véhicule</a>

    @if($vehicules->isEmpty())
        <div class="alert alert-info">
            Aucun véhicule enregistré pour ce client.
        </div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Marque</th>
                    <th>Modèle</th>
                    <th>Immatriculation</th>
                    <th>Année</th>
                    <th>Couleur</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vehicules as $vehicule)
                    <tr>
                        <td>{{ $vehicule->marque }}</td>
                        <td>{{ $vehicule->modele }}</td>
                        <td>{{ $vehicule->immatriculation }}</td>
                        <td>{{ $vehicule->annee }}</td>
                        <td>{{ $vehicule->couleur }}</td>
                        <td><a href="{{ route('vehicules.reparations', $vehicule->id) }}" class="btn btn-sm btn-outline-dark">
                            🔧 Réparations
                        </a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
