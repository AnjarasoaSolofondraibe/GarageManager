@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Liste des véhicules & réparations</h2>

    <div class="row">
        @foreach ($vehicules as $vehicule)
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">{{ $vehicule->marque }} {{ $vehicule->modele }} <span class="text-light small">({{ $vehicule->immatriculation }})</span></h5>
                    </div>
                    <div class="card-body">
                        @if ($vehicule->reparations->count())
                            <ul class="list-group list-group-flush">
                                @foreach ($vehicule->reparations as $rep)
                                    <li class="list-group-item">
                                        <strong>{{ $rep->description }}</strong><br>
                                        <span class="text-muted">Coût : {{ $rep->cout ?? '—' }} € | Date : {{ $rep->date }}</span><br>
                                        <span class="text-muted">Statut : {{ ucfirst($rep->status) }}</span><br>
                                        <small>
                                            <strong>Mécaniciens :</strong>
                                            @forelse($rep->mecaniciens as $mec)
                                                {{ $mec->nom }}{{ !$loop->last ? ', ' : '' }}
                                            @empty
                                                Aucun
                                            @endforelse
                                        </small>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted mb-0">Aucune réparation enregistrée.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
