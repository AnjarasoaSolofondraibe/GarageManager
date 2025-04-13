<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Vehicule;
use App\Models\Reparation;
use App\Models\Mecanicien;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $clients = Client::count();
        $vehicules = Vehicule::count();
        $reparations = Reparation::count();
        $mecaniciens = Mecanicien::count();

        $reparationsParMois = Reparation::selectRaw('MONTH(created_at) as mois, COUNT(*) as total')
        ->groupBy('mois')
        ->orderBy('mois')
        ->pluck('total', 'mois')
        ->toArray();

        $moisLabels = [];
        $moisData = [];

        for ($i = 1; $i <= 12; $i++) {
            $moisLabels[] = date("F", mktime(0, 0, 0, $i, 10));
            $moisData[] = $reparationsParMois[$i] ?? 0;
        }

        return view('dashboard', compact(
            'clients',
            'vehicules',
            'reparations',
            'mecaniciens',
            'moisLabels',
            'moisData'
        ));
    }
}
