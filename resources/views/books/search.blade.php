@extends('layouts.app')

@section('title', 'Résultats de Recherche')

@section('content')
<h1 class="mb-4"><i class="fas fa-search"></i> Résultats de Recherche</h1>

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

<div class="alert alert-info">
    Résultats trouvés: <strong>{{ $books->total() }}</strong>
</div>

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
                        <strong>Année:</strong> {{ $book->annee_publication }}
                    </p>
                </div>
                <div class="card-footer bg-light">
                    <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-eye"></i> Voir Détails
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i> Aucun livre ne correspond à votre recherche.
            </div>
        </div>
    @endforelse
</div>

<!-- Pagination -->
<nav>
    {{ $books->links() }}
</nav>

<div class="mt-3">
    <a href="{{ route('books.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour au Catalogue
    </a>
</div>
@endsection
