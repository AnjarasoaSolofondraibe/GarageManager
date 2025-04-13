@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($mecanicien) ? 'Modifier un mécanicien' : 'Créer un mécanicien' }}</h2>

    <form method="POST" action="{{ isset($mecanicien) ? route('mecaniciens.update', $mecanicien) : route('mecaniciens.store') }}">
        @csrf
        @if(isset($mecanicien))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom', $mecanicien->nom ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $mecanicien->email ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" name="telephone" class="form-control" value="{{ old('telephone', $mecanicien->telephone ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="specialites" class="form-label">Spécialités</label>
            <select name="specialites[]" multiple class="form-select">
                @foreach($specialites as $specialite)
                    <option value="{{ $specialite->id }}"
                        {{ isset($mecanicien) && $mecanicien->specialites->contains($specialite->id) ? 'selected' : '' }}>
                        {{ $specialite->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            {{ isset($mecanicien) ? 'Mettre à jour' : 'Créer' }}
        </button>
    </form>
</div>
@endsection
