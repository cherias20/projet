@extends('layouts.app')

@section('title', $author->nom)

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1><i class="fas fa-user-edit"></i> {{ $author->nom }}</h1>
    </div>
    @if(session()->has('membre_id') && session()->get('membre_role') === 'admin')
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
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Biographie</h5>
            </div>
            <div class="card-body">
                <p>{{ $author->biographie ?? 'Aucune biographie disponible.' }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-book"></i> Bibliographie ({{ $author->books->count() }} livres)</h5>
            </div>
            <div class="card-body">
                @forelse($author->books as $book)
                    <div class="mb-3 pb-3 border-bottom">
                        <h6>
                            <a href="{{ route('books.show', $book) }}" class="text-decoration-none">
                                {{ $book->titre }}
                            </a>
                        </h6>
                        <p class="text-muted small mb-2">
                            {{ $book->editeur }} - {{ $book->annee_publication }}
                        </p>
                        <p class="small">{{ substr($book->resume, 0, 150) }}{{ strlen($book->resume) > 150 ? '...' : '' }}</p>
                        <span class="badge bg-success">{{ $book->getAvailableCopiesCount() }}/{{ $book->getTotalCopiesCount() }} disponibles</span>
                    </div>
                @empty
                    <p class="text-muted">Aucun livre pour cet auteur.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('authors.index') }}" class="btn btn-secondary btn-sm w-100 mb-2">
                    <i class="fas fa-arrow-left"></i> Retour aux Auteurs
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
