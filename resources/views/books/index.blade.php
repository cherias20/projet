@extends('layouts.app')

@section('title', 'Catalogue des Livres')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1><i class="fas fa-book-open"></i> Catalogue des Livres</h1>
    </div>
    @auth
        @if(auth()->user()->role === 'admin')
            <div class="col-md-4 text-end">
                <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Ajouter un Livre
                </a>
            </div>
        @endif
    @endauth
</div>

<!-- Barre de recherche -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('books.search') }}" class="row g-3">
            <div class="col-md-3">
                <input type="text" name="titre" class="form-control" placeholder="Titre ou résumé" value="{{ request('titre') }}">
            </div>
            <div class="col-md-2">
                <input type="text" name="auteur" class="form-control" placeholder="Auteur" value="{{ request('auteur') }}">
            </div>
            <div class="col-md-2">
                <input type="text" name="genre" class="form-control" placeholder="Genre" value="{{ request('genre') }}">
            </div>
            <div class="col-md-2">
                <input type="text" name="editeur" class="form-control" placeholder="Éditeur" value="{{ request('editeur') }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-search"></i> Rechercher
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Grille des livres -->
<div class="row">
    @forelse($books as $book)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->titre }}</h5>
                    <p class="card-text text-muted small">{{ $book->sous_titre }}</p>
                    
                    <p class="card-text">
                        <strong>Auteurs:</strong><br>
                        @foreach($book->authors as $author)
                            <span class="badge bg-info">{{ $author->nom }}</span>
                        @endforeach
                    </p>
                    
                    <p class="card-text">
                        <strong>Genres:</strong><br>
                        @foreach($book->genres as $genre)
                            <span class="badge bg-secondary">{{ $genre->nom }}</span>
                        @endforeach
                    </p>
                    
                    <p class="card-text small">
                        <strong>Éditeur:</strong> {{ $book->editeur }}<br>
                        <strong>Année:</strong> {{ $book->annee_publication }}<br>
                        <strong>Pages:</strong> {{ $book->pages ?? 'N/A' }}<br>
                        <strong>Langue:</strong> {{ $book->langue }}
                    </p>
                    
                    <p class="card-text">
                        <strong>Exemplaires disponibles:</strong>
                        <span class="badge bg-success">{{ $book->getAvailableCopiesCount() }}/{{ $book->getTotalCopiesCount() }}</span>
                    </p>
                </div>
                <div class="card-footer bg-light">
                    <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-eye"></i> Voir Détails
                    </a>
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Éditer
                            </a>
                            <form method="POST" action="{{ route('admin.books.destroy', $book) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr?')">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Aucun livre trouvé.
            </div>
        </div>
    @endforelse
</div>

<!-- Pagination -->
<nav>
    {{ $books->links() }}
</nav>
@endsection
