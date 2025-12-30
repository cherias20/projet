@extends('layouts.app')

@section('title', 'Ajouter un Livre')

@section('content')
<h1 class="mb-4"><i class="fas fa-plus-circle"></i> Ajouter un Livre</h1>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.books.store') }}" class="needs-validation">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre *</label>
                        <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre" name="titre" required>
                        @error('titre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="sous_titre" class="form-label">Sous-titre</label>
                        <input type="text" class="form-control @error('sous_titre') is-invalid @enderror" id="sous_titre" name="sous_titre">
                        @error('sous_titre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="editeur" class="form-label">Éditeur *</label>
                        <input type="text" class="form-control @error('editeur') is-invalid @enderror" id="editeur" name="editeur" required>
                        @error('editeur') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="annee_publication" class="form-label">Année de publication *</label>
                            <input type="number" class="form-control @error('annee_publication') is-invalid @enderror" id="annee_publication" name="annee_publication" min="1000" max="{{ date('Y') }}" required>
                            @error('annee_publication') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="pages" class="form-label">Nombre de pages</label>
                            <input type="number" class="form-control @error('pages') is-invalid @enderror" id="pages" name="pages" min="1">
                            @error('pages') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="langue" class="form-label">Langue *</label>
                        <input type="text" class="form-control @error('langue') is-invalid @enderror" id="langue" name="langue" value="Français" required>
                        @error('langue') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="resume" class="form-label">Résumé</label>
                        <textarea class="form-control @error('resume') is-invalid @enderror" id="resume" name="resume" rows="4"></textarea>
                        @error('resume') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="authors" class="form-label">Auteurs</label>
                        <select class="form-select @error('authors') is-invalid @enderror" id="authors" name="authors[]" multiple>
                            @foreach($authors as $author)
                                <option value="{{ $author->id_auteur }}">{{ $author->nom }}</option>
                            @endforeach
                        </select>
                        @error('authors') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="genres" class="form-label">Genres</label>
                        <select class="form-select @error('genres') is-invalid @enderror" id="genres" name="genres[]" multiple>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id_genre }}">{{ $genre->nom }}</option>
                            @endforeach
                        </select>
                        @error('genres') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Enregistrer
                        </button>
                        <a href="{{ route('books.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
