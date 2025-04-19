@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Réparations du véhicule</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $vehicule->marque }} - {{ $vehicule->modele }}</h5>
            <p class="card-text">
                <strong>Immatriculation :</strong> {{ $vehicule->immatriculation }}<br>
                <strong>Client :</strong> {{ $vehicule->client->name ?? 'N/A' }}
            </p>
        </div>
    </div>

    @if($reparations->isEmpty())
        <div class="alert alert-info">
            Aucune réparation enregistrée pour ce véhicule.
        </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Mécanicien</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reparations as $reparation)
                    <tr>
                        <td>{{ $reparation->created_at->format('d/m/Y') }}</td>
                        <td>{{ $reparation->description }}</td>
                        <td>{{ $reparation->mecanicien->name ?? 'Non assigné' }}</td>
                        <td>{{ ucfirst($reparation->statut ?? 'en attente') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('vehicules.index') }}" class="btn btn-secondary mt-3">← Retour aux véhicules</a>
</div>
@endsection
