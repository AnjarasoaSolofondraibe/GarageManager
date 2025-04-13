@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter un véhicule</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erreur !</strong> Veuillez corriger les champs suivants :<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vehicules.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="client_id" class="form-label">Client</label>
            <select name="client_id" class="form-select" required>
                <option value="">-- Sélectionner un client --</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                        {{ $client->prenom }} {{ $client->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="marque" class="form-label">Marque</label>
            <input type="text" name="marque" class="form-control" value="{{ old('marque') }}" required>
        </div>

        <div class="mb-3">
            <label for="modele" class="form-label">Modèle</label>
            <input type="text" name="modele" class="form-control" value="{{ old('modele') }}" required>
        </div>

        <div class="mb-3">
            <label for="immatriculation" class="form-label">Immatriculation</label>
            <input type="text" name="immatriculation" class="form-control" value="{{ old('immatriculation') }}" required>
        </div>

        <div class="mb-3">
            <label for="annee" class="form-label">Année</label>
            <input type="number" name="annee" class="form-control" value="{{ old('annee') }}">
        </div>

        <div class="mb-3">
            <label for="couleur" class="form-label">Couleur</label>
            <input type="text" name="couleur" class="form-control" value="{{ old('couleur') }}">
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
