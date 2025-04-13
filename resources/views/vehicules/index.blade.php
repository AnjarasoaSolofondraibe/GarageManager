@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Liste des véhicules</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('vehicules.create') }}" class="btn btn-primary mb-3">➕ Ajouter un véhicule</a>

    <form method="GET" action="{{ route('vehicules.index') }}" class="mb-3">
        <div class="row g-2 align-items-end">
            <div class="col-md-4">
                <label>Filtrer par client</label>
                <select name="client_id" class="form-control">
                    <option value="">-- Tous les clients --</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                            {{ $client->prenom }} {{ $client->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary">Filtrer</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Client</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Immatriculation</th>
                <th>Année</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicules as $vehicule)
                <tr>
                    <td>{{ $vehicule->client->prenom }} {{ $vehicule->client->nom }}</td>
                    <td>{{ $vehicule->marque }}</td>
                    <td>{{ $vehicule->modele }}</td>
                    <td>{{ $vehicule->immatriculation }}</td>
                    <td>{{ $vehicule->annee }}</td>
                    <td>
                        <a href="{{ route('vehicules.edit', $vehicule) }}" class="btn btn-sm btn-warning">✏️ Modifier</a>
                        <!-- Bouton de suppression -->
                        <button 
                            class="btn btn-sm btn-danger" 
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteModal" 
                            data-id="{{ $vehicule->id }}" 
                            data-nom="{{ $vehicule->marque }} {{ $vehicule->modele }} {{ $vehicule->immatriculation }}">
                            🗑️ Supprimer
                        </button>
                    </td>
                    <!-- Modal de suppression -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <form method="POST" id="deleteForm">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">
                                <p>Voulez-vous vraiment supprimer le véhicule <strong id="vehiculeName"></strong> ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-danger">Oui, supprimer</button>
                            </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $vehicules->links() }}
</div>
@endsection
