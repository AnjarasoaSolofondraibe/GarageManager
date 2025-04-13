@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier la réparation : {{ $reparation->description }}</h2>

    <form action="{{ route('reparations.update', $reparation) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $reparation->description) }}" required>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $reparation->date) }}" required>
        </div>

        <div class="mb-3">
            <label for="vehicule_id" class="form-label">Véhicule</label>
            <select class="form-control" id="vehicule_id" name="vehicule_id" required>
                @foreach ($vehicules as $vehicule)
                    <option value="{{ $vehicule->id }}" {{ $vehicule->id == $reparation->vehicule_id ? 'selected' : '' }}>
                        {{ $vehicule->marque }} - {{ $vehicule->modele }} ({{ $vehicule->immatriculation }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="mecaniciens" class="form-label">Mécaniciens</label>
            <select class="form-control" id="mecaniciens" name="mecaniciens[]" multiple>
                @foreach ($mecaniciens as $mec)
                    <option value="{{ $mec->id }}" 
                        {{ in_array($mec->id, $reparation->mecaniciens->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $mec->nom }} - {{ $mec->specialite->nom ?? 'Aucune spécialité' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="etat" class="form-label">État</label>
            <input type="text" class="form-control" id="etat" name="etat" value="{{ old('etat', $reparation->etat) }}">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('vehicules.reparations.index', $reparation->vehicule_id) }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
