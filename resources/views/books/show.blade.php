@extends('layouts.app')

@section('title', $book->titre)

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1><i class="fas fa-book-open"></i> {{ $book->titre }}</h1>
        @if($book->sous_titre)
            <p class="text-muted">{{ $book->sous_titre }}</p>
        @endif
    </div>
    @auth
        @if(auth()->user()->role === 'admin')
            <div class="col-md-4 text-end">
                <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Éditer
                </a>
                <form method="POST" action="{{ route('admin.books.destroy', $book) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr?')">
                        <i class="fas fa-trash"></i> Supprimer
                    </button>
                </form>
            </div>
        @endif
    @endauth
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Informations du Livre</h5>
            </div>
            <div class="card-body">
                <p>
                    <strong>Résumé:</strong><br>
                    {{ $book->resume ?? 'Aucun résumé disponible.' }}
                </p>

                <p>
                    <strong>Auteurs:</strong><br>
                    @forelse($book->authors as $author)
                        <a href="{{ route('authors.show', $author) }}" class="badge bg-info text-decoration-none">
                            {{ $author->nom }}
                        </a>
                    @empty
                        <span class="text-muted">Aucun auteur associé</span>
                    @endforelse
                </p>

                <p>
                    <strong>Genres:</strong><br>
                    @forelse($book->genres as $genre)
                        <span class="badge bg-secondary">{{ $genre->nom }}</span>
                    @empty
                        <span class="text-muted">Aucun genre associé</span>
                    @endforelse
                </p>

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Éditeur:</strong> {{ $book->editeur }}</p>
                        <p><strong>Année de Publication:</strong> {{ $book->annee_publication }}</p>
                        <p><strong>Langue:</strong> {{ $book->langue }}</p>
                        <p><strong>Pages:</strong> {{ $book->pages ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Exemplaires Disponibles</h5>
            </div>
            <div class="card-body">
                <p>
                    <strong>Disponibles:</strong> 
                    <span class="badge bg-success">{{ $book->getAvailableCopiesCount() }}</span>
                </p>
                <p>
                    <strong>Total:</strong> 
                    <span class="badge bg-primary">{{ $book->getTotalCopiesCount() }}</span>
                </p>

                @if($book->getAvailableCopiesCount() > 0)
                    <div class="alert alert-success">
                        <i class="fas fa-check"></i> Ce livre est disponible à la location.
                    </div>
                @else
                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle"></i> Tous les exemplaires sont actuellement empruntés.
                        <a href="{{ route('reservations.create') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-bookmark"></i> Réserver
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('books.index') }}" class="btn btn-secondary btn-sm w-100 mb-2">
                    <i class="fas fa-arrow-left"></i> Retour au Catalogue
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
