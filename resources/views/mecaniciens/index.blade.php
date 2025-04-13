@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des mécaniciens</h2>

    <a href="{{ route('mecaniciens.create') }}" class="btn btn-success mb-3">Ajouter un mécanicien</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Spécialités</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mecaniciens as $mecanicien)
                <tr>
                    <td>{{ $mecanicien->nom }}</td>
                    <td>{{ $mecanicien->email }}</td>
                    <td>{{ $mecanicien->telephone }}</td>
                    <td>
                        @foreach($mecanicien->specialites as $spec)
                            <span class="badge bg-secondary">{{ $spec->nom }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('mecaniciens.edit', $mecanicien) }}" class="btn btn-warning btn-sm">Modifier</a>

                        <form action="{{ route('mecaniciens.destroy', $mecanicien) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Confirmer la suppression ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">Aucun mécanicien enregistré.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $mecaniciens->links() }}
</div>
@endsection
