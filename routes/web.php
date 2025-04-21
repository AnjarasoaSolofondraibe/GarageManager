<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReparationController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\MecanicienController;
use App\Http\Controllers\SpecialiteController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\TravailController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('clients', ClientController::class);
Route::get('/clients/{client}/vehicules', [ClientController::class, 'vehicules'])->name('clients.vehicules');

Route::resource('employes', EmployeController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//Auth::routes();

Route::resource('vehicules', App\Http\Controllers\VehiculeController::class);
Route::resource('mecaniciens', MecanicienController::class);
Route::resource('specialites', SpecialiteController::class);

Route::resource('reparations', ReparationController::class);

//Route::get('/vehicules/{vehicule}/reparations', [ReparationController::class, 'index'])->name('vehicules.reparations');
Route::resource('vehicules.reparations', ReparationController::class)->shallow();


//Route::get('/reparations/create', [ReparationController::class, 'create'])->name('reparations.create');
//Route::post('/reparations', [ReparationController::class, 'store'])->name('reparations.store');
Route::get('/reparations/en-cours', [ReparationController::class, 'enCours'])->name('reparations.en_cours');

Route::prefix('vehicules/{vehicule}')->group(function () {
    Route::resource('reparations', ReparationController::class)->shallow();
});


Route::get('/vehicules/{vehicule}/reparations', [ReparationController::class, 'vehiculeReparations'])
    ->name('vehicules.reparations');
    Route::get('/vehicules/{vehicule}/reparations/create', [ReparationController::class, 'vehiculeReparations'])
    ->name('vehicules.reparations.create');


//Route::resource('factures', FactureController::class);
//Route::resource('users', UserController::class);
//Route::resource('devis', DevisController::class);

// Accès réservé à l'admin uniquement
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});

// Admin et secrétaire
Route::middleware(['auth', 'role:admin,secretaire'])->group(function () {
    Route::resource('clients', ClientController::class);
    Route::resource('reparations', ReparationController::class);
});

// Tous les rôles peuvent accéder à leurs réparations
Route::middleware(['auth', 'role:admin,secretaire,chef_mecanicien'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/reparations/{reparation}/travaux/create', [TravailController::class, 'create'])->name('travaux.create');

Route::get('/reparations/{reparation}/Travaux', [TravailController::class, 'store'])->name('travaux.store');


