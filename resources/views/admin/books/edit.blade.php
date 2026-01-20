@extends('layouts.admin')

@section('title', 'Éditer un Livre')

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

    .checkbox-group {
        background: var(--light-blue);
        border: 2px solid var(--border-color);
        border-radius: 8px;
        padding: 1rem;
        max-height: 300px;
        overflow-y: auto;
    }

    .form-check {
        margin-bottom: 0.75rem;
    }

    .form-check-input {
        width: 20px;
        height: 20px;
        margin-top: 0.25rem;
        border: 2px solid var(--border-color);
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .form-check-input:checked {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        border-color: var(--secondary-blue);
    }

    .form-check-label {
        cursor: pointer;
        font-weight: 500;
        color: var(--text-dark);
        margin-left: 0.5rem;
    }

    .form-check-label:hover {
        color: var(--secondary-blue);
    }

    .current-image {
        max-width: 200px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-bottom: 1rem;
    }

    .image-label {
        font-size: 0.85rem;
        color: var(--text-light);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .file-input-wrapper {
        position: relative;
    }

    .file-input-label {
        display: inline-block;
        padding: 0.75rem 1rem;
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        color: white;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .file-input-label:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(30, 60, 114, 0.3);
    }

    .small {
        color: var(--text-light);
        font-weight: 500;
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
    <h1><i class="fas fa-edit"></i> Éditer le Livre</h1>
    <p class="page-subtitle">Modifiez les informations du livre: <strong>{{ $book->titre }}</strong></p>
</div>

<div class="form-container">
    <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Informations Principales -->
        <div class="form-section-title">
            <i class="fas fa-info-circle"></i> Informations Principales
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="titre" class="form-label">Titre <span style="color: #d32f2f;">*</span></label>
                    <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre" name="titre" value="{{ old('titre', $book->titre) }}" required>
                    @error('titre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="editeur" class="form-label">Éditeur <span style="color: #d32f2f;">*</span></label>
                    <input type="text" class="form-control @error('editeur') is-invalid @enderror" id="editeur" name="editeur" value="{{ old('editeur', $book->editeur) }}" required>
                    @error('editeur')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="annee_publication" class="form-label">Année de Publication <span style="color: #d32f2f;">*</span></label>
                    <input type="number" class="form-control @error('annee_publication') is-invalid @enderror" id="annee_publication" name="annee_publication" value="{{ old('annee_publication', $book->annee_publication) }}" min="1000" max="{{ date('Y') }}" required>
                    @error('annee_publication')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exemplaires" class="form-label">Nombre d'exemplaires</label>
                    <input type="number" class="form-control @error('exemplaires') is-invalid @enderror" id="exemplaires" name="exemplaires" value="{{ old('exemplaires', 1) }}" min="1">
                    @error('exemplaires')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="resume" class="form-label">Résumé</label>
            <textarea class="form-control @error('resume') is-invalid @enderror" id="resume" name="resume" rows="4">{{ old('resume', $book->resume) }}</textarea>
            @error('resume')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Image de Couverture -->
        <div class="form-section-title">
            <i class="fas fa-image"></i> Couverture du Livre
        </div>

        @if($book->images)
            <div class="mb-3">
                <p class="image-label">Image Actuelle</p>
                <img src="{{ asset('storage/' . $book->images) }}" alt="{{ $book->titre }}" class="current-image">
            </div>
        @endif

        <div class="mb-3">
            <label for="images" class="form-label">Modifier l'Image de Couverture</label>
            <div class="file-input-wrapper">
                <input type="file" class="form-control @error('images') is-invalid @enderror" id="images" name="images" accept="image/*" style="display: none;" onchange="updateFileName(this)">
                <label for="images" class="file-input-label">
                    <i class="fas fa-cloud-upload-alt"></i> Sélectionner une nouvelle image
                </label>
                <small class="d-block mt-2">Format: JPG, PNG, GIF • Taille max: 2MB</small>
                <span id="fileName" style="color: var(--text-light); font-weight: 500; display: none; margin-top: 0.5rem;"></span>
            </div>
            @error('images')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Auteurs et Genres -->
        <div class="form-section-title">
            <i class="fas fa-users"></i> Auteurs et Genres
        </div>

        <div class="row">
            <div class="col-md-6">
                <label class="form-label">Auteur(s)</label>
                <div class="checkbox-group">
                    @forelse($authors as $author)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="author_{{ $author->id_auteur }}" name="authors[]" value="{{ $author->id_auteur }}" @if($book->authors->contains($author->id_auteur)) checked @endif>
                            <label class="form-check-label" for="author_{{ $author->id_auteur }}">
                                {{ $author->nom }}
                            </label>
                        </div>
                    @empty
                        <p class="text-muted mb-0">Aucun auteur disponible</p>
                    @endforelse
                </div>
                @error('authors')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Genre(s)</label>
                <div class="checkbox-group">
                    @forelse($genres as $genre)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="genre_{{ $genre->id_genre }}" name="genres[]" value="{{ $genre->id_genre }}" @if($book->genres->contains($genre->id_genre)) checked @endif>
                            <label class="form-check-label" for="genre_{{ $genre->id_genre }}">
                                {{ $genre->nom }}
                            </label>
                        </div>
                    @empty
                        <p class="text-muted mb-0">Aucun genre disponible</p>
                    @endforelse
                </div>
                @error('genres')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Boutons d'Action -->
        <div class="button-group">
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Mettre à Jour
            </button>
            <a href="{{ route('admin.books.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Retour à la Liste
            </a>
        </div>
    </form>
</div>

<script>
    function updateFileName(input) {
        const fileNameSpan = document.getElementById('fileName');
        if (input.files && input.files[0]) {
            fileNameSpan.textContent = '✓ ' + input.files[0].name;
            fileNameSpan.style.display = 'block';
            fileNameSpan.style.color = '#43e97b';
        }
    }
</script>

@endsection
