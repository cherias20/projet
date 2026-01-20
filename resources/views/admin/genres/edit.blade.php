@extends('layouts.admin')

@section('title', 'Éditer un Genre')

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
    <h1><i class="fas fa-tag"></i> Éditer un Genre</h1>
    <p class="page-subtitle">Modifiez les informations du genre: <strong>{{ $genre->nom }}</strong></p>
</div>

<div class="form-container">
    <form action="{{ route('admin.genres.update', $genre) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Informations du Genre -->
        <div class="form-section-title">
            <i class="fas fa-edit"></i> Informations du Genre
        </div>

        <div class="mb-3">
            <label for="nom" class="form-label">Nom du Genre <span style="color: #d32f2f;">*</span></label>
            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom', $genre->nom) }}" placeholder="Ex: Science-fiction, Romance..." required>
            @error('nom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="6" placeholder="Décrivez ce genre littéraire...">{{ old('description', $genre->description) }}</textarea>
            <small class="text-muted">Expliquez les caractéristiques et les thèmes principaux du genre</small>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Boutons d'Action -->
        <div class="button-group">
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Mettre à Jour
            </button>
            <a href="{{ route('admin.genres.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Retour à la Liste
            </a>
        </div>
    </form>
</div>

@endsection
