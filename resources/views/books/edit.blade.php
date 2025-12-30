@extends('layouts.app')

@section('title', 'Éditer - ' . $book->titre)

@section('content')
<h1 class="mb-4"><i class="fas fa-edit"></i> Éditer le Livre</h1>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.books.update', $book) }}" class="needs-validation">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre *</label>
                        <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre" name="titre" value="{{ old('titre', $book->titre) }}" required>
                        @error('titre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="sous_titre" class="form-label">Sous-titre</label>
                        <input type="text" class="form-control @error('sous_titre') is-invalid @enderror" id="sous_titre" name="sous_titre" value="{{ old('sous_titre', $book->sous_titre) }}">
                        @error('sous_titre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="editeur" class="form-label">Éditeur *</label>
                        <input type="text" class="form-control @error('editeur') is-invalid @enderror" id="editeur" name="editeur" value="{{ old('editeur', $book->editeur) }}" required>
                        @error('editeur') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="annee_publication" class="form-label">Année de publication *</label>
                            <input type="number" class="form-control @error('annee_publication') is-invalid @enderror" id="annee_publication" name="annee_publication" min="1000" max="{{ date('Y') }}" value="{{ old('annee_publication', $book->annee_publication) }}" required>
                            @error('annee_publication') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="pages" class="form-label">Nombre de pages</label>
                            <input type="number" class="form-control @error('pages') is-invalid @enderror" id="pages" name="pages" min="1" value="{{ old('pages', $book->pages) }}">
                            @error('pages') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="langue" class="form-label">Langue *</label>
                        <input type="text" class="form-control @error('langue') is-invalid @enderror" id="langue" name="langue" value="{{ old('langue', $book->langue) }}" required>
                        @error('langue') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="resume" class="form-label">Résumé</label>
                        <textarea class="form-control @error('resume') is-invalid @enderror" id="resume" name="resume" rows="4">{{ old('resume', $book->resume) }}</textarea>
                        @error('resume') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="authors" class="form-label">Auteurs</label>
                        <select class="form-select @error('authors') is-invalid @enderror" id="authors" name="authors[]" multiple>
                            @foreach($authors as $author)
                                <option value="{{ $author->id_auteur }}" @if($book->authors->contains($author->id_auteur)) selected @endif>
                                    {{ $author->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('authors') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="genres" class="form-label">Genres</label>
                        <select class="form-select @error('genres') is-invalid @enderror" id="genres" name="genres[]" multiple>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id_genre }}" @if($book->genres->contains($genre->id_genre)) selected @endif>
                                    {{ $genre->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('genres') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Enregistrer
                        </button>
                        <a href="{{ route('books.show', $book) }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
