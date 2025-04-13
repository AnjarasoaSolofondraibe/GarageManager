@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des clients</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('clients.create') }}" class="btn btn-success mb-3">➕ Nouveau client</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom complet</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Adresse</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->prenom }} {{ $client->nom }}</td>
                    <td>{{ $client->telephone }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->adresse }}</td>
                    <td>
                      

                        <!-- Bouton Voir véhicules -->
                        <a href="{{ route('clients.vehicules', $client) }}" class="btn btn-info btn-sm">🚗 Voir les véhicules</a>

                        <!-- Modal pour les véhicules du client -->
                        <div class="modal fade" id="vehiculesModal{{ $client->id }}" tabindex="-1" aria-labelledby="vehiculesModalLabel{{ $client->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="vehiculesModalLabel{{ $client->id }}">
                                    Véhicules de {{ $client->prenom }} {{ $client->nom }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                </div>
                                <div class="modal-body">
                                @if ($client->vehicules->isEmpty())
                                    <p>Aucun véhicule enregistré.</p>
                                @else
                                    <table class="table table-sm table-striped">
                                        <thead>
                                            <tr>
                                                <th>Marque</th>
                                                <th>Modèle</th>
                                                <th>Immatriculation</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($client->vehicules as $vehicule)
                                                <tr>
                                                    <td>{{ $vehicule->marque }}</td>
                                                    <td>{{ $vehicule->modele }}</td>
                                                    <td>{{ $vehicule->immatriculation }}</td>
                                                    <td>
                                                        <a href="{{ route('vehicules.show', $vehicule) }}" class="btn btn-sm btn-secondary">🔍 Détails</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                                </div>

                                <div class="modal-footer">
                                    @if ($client->vehicules->isEmpty())
                                        <form action="{{ route('clients.destroy', $client) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">🗑️ Confirmer la suppression</button>
                                        </form>
                                    @else
                                        <div class="alert alert-warning mb-0 w-100 text-start">
                                            <strong>Impossible de supprimer ce client :</strong> il possède encore des véhicules enregistrés.
                                        </div>
                                    @endif
                                
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                            </div>
                        </div>

                        <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-warning">✏️ Modifier</a>

                        <!-- Bouton qui ouvre la modale de confirmation -->
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#vehiculesModal{{ $client->id }}">
                            🗑️ Supprimer
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Aucun client enregistré.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        {{ $clients->links() }}
    </div>
</div>
@endsection
