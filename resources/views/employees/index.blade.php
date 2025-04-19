@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Liste des employés</h2>
    <a href="{{ route('employees.create') }}" class="btn btn-success mb-3">Ajouter un employé</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Poste</th>
                <th>Date d'embauche</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $e)
            <tr>
                <td>{{ $e->prenom }} {{ $e->nom }}</td>
                <td>{{ $e->email }}</td>
                <td>{{ $e->poste }}</td>
                <td>{{ \Carbon\Carbon::parse($e->date_embauche)->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('employees.edit', $e) }}" class="btn btn-sm btn-primary">Modifier</a>
                    <form action="{{ route('employees.destroy', $e) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet employé ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
