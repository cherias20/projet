@extends('layouts.admin')

@section('title', 'Créer un Livre')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h1 class="page-title">
            <i class="fas fa-book"></i> Créer un Livre
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-plus"></i> Nouveau Livre
            </div>
            <div class="card-body">
        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="titre" class="form-label">Titre</label>
                <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre" name="titre" value="{{ old('titre') }}" required>
                @error('titre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="editeur" class="form-label">Éditeur</label>
                <input type="text" class="form-control @error('editeur') is-invalid @enderror" id="editeur" name="editeur" value="{{ old('editeur') }}" required>
                @error('editeur')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="annee_publication" class="form-label">Année de Publication</label>
                <input type="number" class="form-control @error('annee_publication') is-invalid @enderror" id="annee_publication" name="annee_publication" value="{{ old('annee_publication', date('Y')) }}" min="1000" max="{{ date('Y') }}" required>
                @error('annee_publication')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="resume" class="form-label">Résumé</label>
                <textarea class="form-control @error('resume') is-invalid @enderror" id="resume" name="resume" rows="4">{{ old('resume') }}</textarea>
                @error('resume')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="images" class="form-label">Couverture du Livre</label>
                <input type="file" class="form-control @error('images') is-invalid @enderror" id="images" name="images" accept="image/*">
                <small class="text-muted">Format: JPG, PNG, GIF (Taille max: 2MB)</small>
                @error('images')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="exemplaires" class="form-label">Nombre d'exemplaires</label>
                <input type="number" class="form-control @error('exemplaires') is-invalid @enderror" id="exemplaires" name="exemplaires" value="{{ old('exemplaires', 1) }}" min="1">
                @error('exemplaires')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="authors" class="form-label">Auteur(s)</label>
                <select class="form-select @error('authors') is-invalid @enderror" id="authors" name="authors[]" multiple>
                    <option value="">-- Sélectionner un auteur --</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id_auteur }}" @if(in_array($author->id_auteur, old('authors', []))) selected @endif>
                            {{ $author->nom }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted d-block mt-1">Maintenez Ctrl (ou Cmd) pour sélectionner plusieurs auteurs</small>
                @error('authors')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="genres" class="form-label">Genre(s)</label>
                <select class="form-select @error('genres') is-invalid @enderror" id="genres" name="genres[]" multiple>
                    <option value="">-- Sélectionner un genre --</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id_genre }}" @if(in_array($genre->id_genre, old('genres', []))) selected @endif>
                            {{ $genre->nom }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted d-block mt-1">Maintenez Ctrl (ou Cmd) pour sélectionner plusieurs genres</small>
                @error('genres')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Créer
                </button>
                <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </form>
            </div>
        </div>
    </div>
</div>
@endsection
