<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\ReparationController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\MecanicienController;
use App\Http\Controllers\SpecialiteController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('clients', ClientController::class);
Route::get('/clients/{client}/vehicules', [ClientController::class, 'vehicules'])->name('clients.vehicules');
//Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
/*::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');*/

Route::resource('vehicules', VehiculeController::class);
Route::get('/vehicules/{vehicule}/reparations', [ReparationController::class, 'index'])->name('vehicules.reparations');
Route::resource('vehicules.reparations', ReparationController::class)->shallow();

Route::resource('reparations', ReparationController::class);
//Route::get('/reparations/create', [ReparationController::class, 'create'])->name('reparations.create');
//Route::post('/reparations', [ReparationController::class, 'store'])->name('reparations.store');
Route::get('/reparations/en-cours', [ReparationController::class, 'enCours'])->name('reparations.en_cours');
//Route::get('/reparations/{reparation}/edit', [ReparationController::class, 'edit'])->name('reparations.edit');
//Route::put('/reparations/{reparation}', [ReparationController::class, 'update'])->name('reparations.update');

/*Route::prefix('vehicules/{vehicule}')->group(function () {
    Route::resource('reparations', ReparationController::class)->shallow();
});*/

Route::resource('mecaniciens', MecanicienController::class);
Route::resource('specialites', SpecialiteController::class);

Route::resource('factures', FactureController::class);
Route::resource('users', UserController::class);
Route::resource('devis', DevisController::class);