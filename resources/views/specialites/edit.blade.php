@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($specialite) ? 'Modifier une spécialité' : 'Créer une spécialité' }}</h2>

    <form method="POST" action="{{ isset($specialite) ? route('specialites.update', $specialite) : route('specialites.store') }}">
        @csrf
        @if(isset($specialite))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="nom" class="form-label">Nom de la spécialité</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom', $specialite->nom ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">
            {{ isset($specialite) ? 'Mettre à jour' : 'Créer' }}
        </button>
    </form>
</div>
@endsection
