@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier le véhicule</h2>
    <form action="{{ route('vehicules.update', $vehicule) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Client</label>
            <select name="client_id" class="form-control" required>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ $vehicule->client_id == $client->id ? 'selected' : '' }}>
                        {{ $client->prenom }} {{ $client->nom }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Marque</label>
            <input type="text" name="marque" class="form-control" value="{{ $vehicule->marque }}" required>
        </div>
        <div class="mb-3">
            <label>Modèle</label>
            <input type="text" name="modele" class="form-control" value="{{ $vehicule->modele }}" required>
        </div>
        <div class="mb-3">
            <label>Immatriculation</label>
            <input type="text" name="immatriculation" class="form-control" value="{{ $vehicule->immatriculation }}" required>
        </div>
        <div class="mb-3">
            <label>Année</label>
            <input type="number" name="annee" class="form-control" value="{{ $vehicule->annee }}">
        </div>
        <button type="submit" class="btn btn-primary">💾 Enregistrer</button>
    </form>
</div>
@endsection
