@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Réparations - {{ $vehicule->marque }} {{ $vehicule->modele }} ({{ $vehicule->immatriculation }})</h1>

    <a href="{{ route('reparations.create') }}" class="btn btn-primary mb-3">➕ Ajouter une réparation</a>

    @if($reparations->isEmpty())
        <div class="alert alert-info">
            Aucune réparation enregistrée pour ce véhicule.
        </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Coût (€)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reparations as $rep)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($rep->date)->format('d/m/Y') }}</td>
                        <td>{{ $rep->description }}</td>
                        <td>{{ number_format($rep->cout, 2, ',', ' ') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
