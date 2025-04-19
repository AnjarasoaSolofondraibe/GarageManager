@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter une réparation</h1>

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

    <form action="{{ route('reparations.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="vehicule_id" class="form-label">Véhicule</label>
            <select name="vehicule_id" class="form-select" required>
                <option value="">-- Sélectionner un véhicule --</option>
                @foreach($vehicules as $vehicule)
                    <option value="{{ $vehicule->id }}">
                        {{ $vehicule->immatriculation }} - {{ $vehicule->marque }} {{ $vehicule->modele }} ({{ $vehicule->client->prenom }} {{ $vehicule->client->nom }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="mecanicien" class="form-label">Mécanicien</label>
            <select name="mecaniciens[]" multiple class="form-control" required>
                @foreach($mecaniciens as $mecanicien)
                    <option value="{{ $mecanicien->id }}">
                        {{ $mecanicien->nom }}
                    </option>
                @endforeach
            </select>
            <small>Maintenez Ctrl ou Cmd pour sélectionner plusieurs</small>
        </div>


        <div class="mb-3">
            <label for="cout" class="form-label">Coût (Ariary)</label>
            <input type="number" step="0.01" name="cout" class="form-control" value="{{ old('cout') }}" required>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date de la réparation</label>
            <input type="date" name="date" class="form-control" value="{{ old('date') ?? date('Y-m-d') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Créer la réparation</button>
        <a href="{{ route('reparations.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
