@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des spécialités</h2>

    <a href="{{ route('specialites.create') }}" class="btn btn-success mb-3">Ajouter une spécialité</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($specialites as $specialite)
                <tr>
                    <td>{{ $specialite->nom }}</td>
                    <td>
                        <a href="{{ route('specialites.edit', $specialite) }}" class="btn btn-warning btn-sm">Modifier</a>

                        <form action="{{ route('specialites.destroy', $specialite) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Confirmer la suppression ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="2">Aucune spécialité enregistrée.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $specialites->links() }}
</div>
@endsection
