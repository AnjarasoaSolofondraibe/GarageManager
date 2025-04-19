@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Créer un nouvel utilisateur</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oups !</strong> Il y a eu des erreurs avec vos entrées :<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nom complet</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select name="role" class="form-control" required>
                <option value="">-- Sélectionner un rôle --</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="secretaire" {{ old('role') == 'secretaire' ? 'selected' : '' }}>Secrétaire</option>
                <option value="mecanicien" {{ old('role') == 'mecanicien' ? 'selected' : '' }}>Chef Mécanicien</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Créer</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
