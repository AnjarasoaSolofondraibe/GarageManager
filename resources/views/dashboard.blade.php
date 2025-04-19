@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tableau de bord</h2>

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Clients</h5>
                    <p class="card-text fs-4">{{ $clients }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Véhicules</h5>
                    <p class="card-text fs-4">{{ $vehicules }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Réparations</h5>
                    <p class="card-text fs-4">{{ $reparations }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Mécaniciens</h5>
                    <p class="card-text fs-4">{{ $mecaniciens }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title">Réparations par mois</h5>
        <canvas id="reparationsChart" height="100"></canvas>
    </div>
</div>

<script>
    const ctx = document.getElementById('reparationsChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($moisLabels),
            datasets: [{
                label: 'Réparations',
                data: @json($moisData),
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>

@endsection
