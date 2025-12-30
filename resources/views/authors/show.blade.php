@extends('layouts.app')

@section('title', $author->nom)

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1>{{ $author->nom }}</h1>
    </div>
    @auth
        @if(auth()->user()->role === 'admin')
            <div class="col-md-4 text-end">
                <a href="{{ route('admin.authors.edit', $author) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Éditer
                </a>
                <form method="POST" action="{{ route('admin.authors.destroy', $author) }}" style="display:inline;">
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
                <h5>Biographie</h5>
            </div>
            <div class="card-body">
                {{ $author->biographie ?? 'Pas de biographie disponible' }}
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Statistiques</h5>
            </div>
            <div class="card-body">
                <p class="mb-2">
                    <strong>Nombre de livres:</strong><br>
                    <span class="badge bg-info" style="font-size: 1.2rem; padding: 10px;">
                        {{ $author->books()->count() }}
                    </span>
                </p>
                <p class="mb-0">
                    <strong>Date d'ajout:</strong><br>
                    {{ $author->created_at->format('d/m/Y') }}
                </p>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <h3>Livres de cet auteur</h3>
    <div class="row">
        @forelse($author->books as $book)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">{{ $book->titre }}</h6>
                        <p class="card-text small text-muted">{{ $book->editeur }}</p>
                        <p class="card-text small">
                            <strong>Année:</strong> {{ $book->annee_publication }}
                        </p>
                    </div>
                    <div class="card-footer bg-light">
                        <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i> Voir
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    Aucun livre pour cet auteur.
                </div>
            </div>
        @endforelse
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('authors.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour aux Auteurs
    </a>
</div>
@endsection
