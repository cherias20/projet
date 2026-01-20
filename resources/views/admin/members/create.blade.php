@extends('layouts.admin')

@section('title', 'Créer un Membre')

@section('content')
<style>
    :root {
        --primary-blue: #1e3c72;
        --secondary-blue: #2a5298;
        --light-blue: #f0f4f8;
        --text-dark: #2d3436;
        --text-light: #636e72;
        --border-color: #e0e6ed;
    }

    .page-header {
        margin-bottom: 2rem;
    }

    .page-header h1 {
        font-size: 2rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0;
    }

    .page-header .page-subtitle {
        color: var(--text-light);
        font-size: 0.95rem;
        margin-top: 0.5rem;
    }

    .form-container {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        border: 1px solid var(--border-color);
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
    }

    .form-section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary-blue);
        margin-top: 1.5rem;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--light-blue);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-section-title i {
        font-size: 1.3rem;
    }

    .form-label {
        color: var(--primary-blue);
        font-weight: 700;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .form-control, .form-select {
        border: 2px solid var(--border-color);
        border-radius: 8px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--secondary-blue);
        box-shadow: 0 0 0 0.2rem rgba(42, 82, 152, 0.1);
    }

    .is-invalid {
        border-color: #d32f2f !important;
    }

    .invalid-feedback {
        color: #d32f2f;
        font-weight: 600;
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }

    .button-group {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 700;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(30, 60, 114, 0.3);
        color: white;
    }

    .btn-back {
        background: var(--light-blue);
        color: var(--secondary-blue);
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 700;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-back:hover {
        background-color: var(--secondary-blue);
        color: white;
    }
</style>

<div class="page-header">
    <h1><i class="fas fa-user-plus"></i> Créer un Membre</h1>
    <p class="page-subtitle">Ajouter un nouveau membre à la bibliothèque</p>
</div>

<div class="form-container">
    <form action="{{ route('admin.members.store') }}" method="POST">
        @csrf

        <!-- Informations Personnelles -->
        <div class="form-section-title">
            <i class="fas fa-id-card"></i> Informations Personnelles
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom <span style="color: #d32f2f;">*</span></label>
                    <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" placeholder="Ex: Dupont" required>
                    @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom <span style="color: #d32f2f;">*</span></label>
                    <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" value="{{ old('prenom') }}" placeholder="Ex: Jean" required>
                    @error('prenom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Informations de Contact -->
        <div class="form-section-title">
            <i class="fas fa-envelope"></i> Informations de Contact
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email <span style="color: #d32f2f;">*</span></label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="exemple@mail.com" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{ old('telephone') }}" placeholder="+33 6 XX XX XX XX">
            @error('telephone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse <span style="color: #d32f2f;">*</span></label>
            <input type="text" class="form-control @error('adresse') is-invalid @enderror" id="adresse" name="adresse" value="{{ old('adresse') }}" placeholder="123 Rue de la Paix" required>
            @error('adresse')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Informations d'Adhésion -->
        <div class="form-section-title">
            <i class="fas fa-ticket-alt"></i> Informations d'Adhésion
        </div>

        <div class="mb-3">
            <label for="numero_carte" class="form-label">Numéro de Carte <span style="color: #d32f2f;">*</span></label>
            <input type="text" class="form-control @error('numero_carte') is-invalid @enderror" id="numero_carte" name="numero_carte" value="{{ old('numero_carte') }}" placeholder="EX-2025-001" required>
            @error('numero_carte')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Boutons d'Action -->
        <div class="button-group">
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Créer le Membre
            </button>
            <a href="{{ route('admin.members.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Retour à la Liste
            </a>
        </div>
    </form>
</div>

@endsection