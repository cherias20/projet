@extends('layouts.app')

@section('title', 'Catalogue des Livres')

@section('content')

<!-- Bannière de bienvenue pour les utilisateurs connectés -->
@if(session()->has('membre_id') && auth()->user())
    <div class="alert alert-success mb-4 d-flex align-items-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;">
        <i class="fas fa-check-circle me-3" style="font-size: 1.5rem;"></i>
        <div>
            <strong>Bienvenue {{ auth()->user()->name }} ! 👋</strong>
            <p class="mb-0 small mt-1">Vous êtes connecté en tant que <span class="badge bg-light text-dark">{{ auth()->user()->role === 'admin' ? 'Administrateur' : 'Membre' }}</span></p>
        </div>
    </div>
@endif

<div class="row mb-4">
    <div class="col-md-8">
        <h1><i class="fas fa-book-open"></i> Catalogue des Livres</h1>
    </div>
    @if(session()->has('membre_id') && auth()->user() && auth()->user()->role === 'admin')
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Ajouter un Livre
            </a>
        </div>
    @endif
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
                @if($book->images)
                    <img src="{{ asset('storage/' . $book->images) }}" class="card-img-top" alt="{{ $book->titre }}" style="height: 250px; object-fit: cover;">
                @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                        <i class="fas fa-book fa-4x text-muted"></i>
                    </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $book->titre }}</h5>
                    
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
                    
                    <p class="card-text">
                        <strong>Exemplaires disponibles:</strong>
                        <span class="badge bg-success">{{ $book->getAvailableCopiesCount() }}/{{ $book->getTotalCopiesCount() }}</span>
                    </p>
                </div>
                <div class="card-footer bg-light">
                    <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-eye"></i> Voir Détails
                    </a>
                    @if(session()->has('membre_id') && session()->get('membre_role') === 'admin')
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
