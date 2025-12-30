@extends('layouts.app')

@section('title', 'Ajouter un Membre')

@section('content')
<h1 class="mb-4"><i class="fas fa-user-plus"></i> Ajouter un Membre</h1>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.members.store') }}">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="prenom" class="form-label">Prénom *</label>
                            <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" required>
                            @error('prenom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="nom" class="form-label">Nom *</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" required>
                            @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse *</label>
                        <input type="text" class="form-control @error('adresse') is-invalid @enderror" id="adresse" name="adresse" required>
                        @error('adresse') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="telephone" class="form-label">Téléphone</label>
                        <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone">
                        @error('telephone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="numero_carte" class="form-label">Numéro de Carte *</label>
                        <input type="text" class="form-control @error('numero_carte') is-invalid @enderror" id="numero_carte" name="numero_carte" placeholder="MB-XXXXXXXX" required>
                        @error('numero_carte') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="role" class="form-label">Rôle *</label>
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                            <option value="membre">Membre</option>
                            <option value="admin">Administrateur</option>
                        </select>
                        @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="biographie" class="form-label">Biographie</label>
                        <textarea class="form-control @error('biographie') is-invalid @enderror" id="biographie" name="biographie" rows="3"></textarea>
                        @error('biographie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Enregistrer
                        </button>
                        <a href="{{ route('admin.members.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
