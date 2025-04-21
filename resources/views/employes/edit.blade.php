@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Modifier l'employé</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oups !</strong> Il y a eu des erreurs avec vos entrées :<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employes.update', $employe->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="nom" class="form-label">Prénom</label>
                <input type="text" name="nom" class="form-control" value="{{ old('nom',$employe->nom ?? '') }}">
            </div>
            <div class="col-md-5">
                <label for="prenom" class="form-label">Nom</label>
                <input type="text" name="prenom" class="form-control" value="{{ old('prenom',$employe->prenom ?? '') }}">
            </div>
        </div>

        <div class="mb-3 col-md-9">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="exemple@email.com" value="{{ old('email',$employe->email ?? '') }}">
        </div>

        <div class="mb-3 col-md-9">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" name="telephone" class="form-control" placeholder="034XXXXXXX/032XXXXXX/033XXXXX" value="{{ old('phone',$employe->telephone ?? '') }}">
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="poste" class="form-label">Poste</label>
                <input type="text" name="poste" class="form-control" placeholder="Ex: Mécanicien" value="{{ old('poste',$employe->poste ?? '') }}">
            </div>
            <div class="col-md-3">
                <label for="date_embauche" class="form-label">Date d'embauche</label>
                <input type="date" name="date_embauche" class="form-control" value="{{ old('date_embauche', $employe->date_embauche ?? '') }}">
            </div>
        </div>
        <div class="mb-3">
            <label for="specialites" class="form-label">Spécialités</label>
            <select name="specialites[]" multiple class="form-select">
                @foreach($specialites as $specialite)
                    <option value="{{ $specialite->id }}"
                        {{ isset($employe) && $employe->specialites->contains($specialite->id) ? 'selected' : '' }}>
                        {{ $specialite->nom }}
                    </option>
                @endforeach
            </select>
        </div>    
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('employes.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
