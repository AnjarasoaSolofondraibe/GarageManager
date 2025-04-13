@extends('layouts.app')

@section('title', 'Modifier le client')

@section('content')
<div class="container">
    <h1>Modifier le client</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clients.update', $client) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" name="nom" value="{{ old('nom', $client->nom) }}" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" name="prenom" value="{{ old('prenom', $client->prenom) }}" required>
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" class="form-control" name="telephone" value="{{ old('telephone', $client->telephone) }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $client->email) }}">
        </div>

        <button type="submit" class="btn btn-primary">💾 Enregistrer</button>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary">↩️ Retour</a>
    </form>
</div>
@endsection
