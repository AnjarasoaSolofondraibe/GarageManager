<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title', 'Garage Manager')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body>
    
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">GarageManager</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                    <span class="navbar-toggler-icon"></span>
                </button>
    
                <div class="collapse navbar-collapse" id="navbarMain">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('clients*') ? 'active' : '' }}" href="{{ route('clients.index') }}">
                                Clients
                            </a>
                        </li>
    
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('vehicules*') ? 'active' : '' }}" href="{{ route('vehicules.index') }}">
                                Véhicules
                            </a>
                        </li>
    
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('reparations*') ? 'active' : '' }}" href="{{ route('reparations.index') }}">
                                 Réparations
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('employes*') ? 'active' : '' }}" href="{{ route('employes.index') }}">Employées</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('specialites*') ? 'active' : '' }}" href="{{ route('specialites.index') }}">Spécialités</a>
                        </li>
    
                        <!-- Tu peux en ajouter d'autres ici -->
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#">Factures</a>
                        </li> --}}
    
                    </ul>
                </div>
                <!-- Liens à droite : Connexion / Déconnexion -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Inscription</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ url('/admin') }}">Administration</a></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Déconnexion</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
    
        <div class="container">
            @yield('content')
        </div>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>