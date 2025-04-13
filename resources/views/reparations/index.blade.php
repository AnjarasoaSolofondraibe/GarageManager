@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Réparations pour le véhicule : {{ $vehicule->marque }} {{ $vehicule->modele }}</h2>

    <a href="{{ route('vehicules.reparations.create', $vehicule->id) }}" class="btn btn-primary mb-3">Ajouter une réparation</a>

    <table class="table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Coût (€)</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicule->reparations as $rep)
                <tr>
                    <td>{{ $rep->description }}
                        <div>
                            <strong>Mécaniciens :</strong>
                            @forelse($rep->mecaniciens as $mec)
                                {{ $mec->nom }}{{ !$loop->last ? ', ' : '' }}
                            @empty
                                Aucun
                            @endforelse
                        </div>
                    </td>
                    <td>{{ $rep->cout ?? '—' }}</td>
                    <td>{{ $rep->date }}</td>
                    <td>
                        <a href="{{ route('reparations.edit', $rep) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('reparations.destroy', $rep) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Supprimer cette réparation ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                
            @endforeach
        </tbody>
    </table>
</div>
@endsection
