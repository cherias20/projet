@extends('layouts.app')

@section('title', $book->titre)

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1>{{ $book->titre }}</h1>
        <p class="text-muted">{{ $book->sous_titre }}</p>
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
                <p><strong>Titre:</strong> {{ $book->titre }}</p>
                <p><strong>Sous-titre:</strong> {{ $book->sous_titre ?? 'N/A' }}</p>
                <p><strong>Éditeur:</strong> {{ $book->editeur }}</p>
                <p><strong>Année de publication:</strong> {{ $book->annee_publication }}</p>
                <p><strong>Langue:</strong> {{ $book->langue }}</p>
                <p><strong>Nombre de pages:</strong> {{ $book->pages ?? 'N/A' }}</p>
                
                <div class="mt-3">
                    <strong>Auteurs:</strong>
                    @foreach($book->authors as $author)
                        <span class="badge bg-info">{{ $author->nom }}</span>
                    @endforeach
                </div>
                
                <div class="mt-3">
                    <strong>Genres:</strong>
                    @foreach($book->genres as $genre)
                        <span class="badge bg-secondary">{{ $genre->nom }}</span>
                    @endforeach
                </div>
                
                <div class="mt-3">
                    <strong>Résumé:</strong>
                    <p>{{ $book->resume ?? 'Pas de résumé disponible' }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Disponibilité</h5>
            </div>
            <div class="card-body">
                <p>
                    <strong>Exemplaires disponibles:</strong><br>
                    <span class="badge bg-success" style="font-size: 1.2rem; padding: 10px;">
                        {{ $availableCopies }}/{{ $book->getTotalCopiesCount() }}
                    </span>
                </p>
                @if($availableCopies > 0)
                    <p class="text-success"><i class="fas fa-check-circle"></i> Disponible pour l'emprunt</p>
                @else
                    <p class="text-warning"><i class="fas fa-clock"></i> Tous les exemplaires sont empruntés</p>
                    @auth
                        <form method="POST" action="{{ route('reservations.store') }}" class="mt-3">
                            @csrf
                            <input type="hidden" name="id_livre" value="{{ $book->id_livre }}">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-bookmark"></i> Réserver ce livre
                            </button>
                        </form>
                    @endauth
                @endif
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h5>Exemplaires</h5>
            </div>
            <div class="card-body">
                @foreach($book->exemplaires as $exemplaire)
                    <div class="mb-2 pb-2 border-bottom">
                        <p class="mb-1">
                            <strong>Code-barre:</strong> {{ $exemplaire->code_barre }}
                        </p>
                        <p class="mb-1">
                            <strong>Format:</strong> {{ $exemplaire->format }}
                        </p>
                        <p class="mb-1">
                            <strong>Statut:</strong>
                            <span class="badge-status status-{{ $exemplaire->statut }}">
                                {{ ucfirst($exemplaire->statut) }}
                            </span>
                        </p>
                        <p class="mb-0 small text-muted">
                            Acquis le {{ $exemplaire->date_acquisition->format('d/m/Y') }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('books.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour au Catalogue
    </a>
</div>
@endsection
