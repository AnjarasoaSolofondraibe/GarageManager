@extends('layouts.app')

@section('content')
<div class="container">
    <h2>🚧 Réparations en cours</h2>

    @forelse ($vehicules as $vehicule)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $vehicule->marque }} {{ $vehicule->modele }} ({{ $vehicule->immatriculation }})</h5>
                <p class="card-text">Client : {{ $vehicule->client->nom }}</p>
                <p class="card-text">
                    Réparations en cours : <strong>{{ $vehicule->reparations->count() }}</strong>
                </p>
                <p><strong>Mécaniciens :</strong>
                    @php
                        $mecaniciens = collect();
                        foreach ($vehicule->reparations as $rep) {
                            $mecaniciens = $mecaniciens->merge($rep->mecaniciens);
                        }
                        $mecaniciens = $mecaniciens->unique('id');
                    @endphp
                
                    @foreach($mecaniciens as $mec)
                        {{ $mec->nom }}{{ !$loop->last ? ', ' : '' }}
                    @endforeach
                </p>

                <a href="{{ route('vehicules.reparations.index', $vehicule) }}" class="btn btn-info">
                    🔍 Détails des réparations
                </a>
            </div>
        </div>
    @empty
        <p>Aucune réparation en cours.</p>
    @endforelse
</div>
@endsection
