@extends('layouts.admin')

@section('title', 'Détails du Livre')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h1 class="page-title">
            <i class="fas fa-book"></i> {{ $book->titre }}
        </h1>
        <p class="page-subtitle">Détails complets du livre</p>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.books.edit', $book->id_livre) }}" class="btn btn-info">
            <i class="fas fa-edit"></i> Éditer
        </a>
        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-info-circle"></i> Informations du Livre
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <h6 class="text-muted mb-2">Titre</h6>
                <p><strong>{{ $book->titre }}</strong></p>
            </div>
            <div class="col-md-6">
                <h6 class="text-muted mb-2">Sous-titre</h6>
                <p>{{ $book->sous_titre ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <h6 class="text-muted mb-2">Éditeur</h6>
                <p>{{ $book->editeur ?? 'N/A' }}</p>
            </div>
            <div class="col-md-6">
                <h6 class="text-muted mb-2">Année de publication</h6>
                <p>{{ $book->annee_publication ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <h6 class="text-muted mb-2">Langue</h6>
                <p>{{ $book->langue ?? 'N/A' }}</p>
            </div>
            <div class="col-md-6">
                <h6 class="text-muted mb-2">Nombre de pages</h6>
                <p>{{ $book->pages ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <h6 class="text-muted mb-2">Résumé</h6>
                <p>{{ $book->resume ?? 'Aucun résumé disponible' }}</p>
            </div>
        </div>

        <hr>

        <div class="row mb-4">
            <div class="col-md-6">
                <h6 class="text-muted mb-2">Auteurs</h6>
                @if($book->authors && count($book->authors) > 0)
                    <ul class="list-unstyled">
                        @foreach($book->authors as $author)
                            <li><span class="badge bg-primary">{{ $author->nom }}</span></li>
                        @endforeach
                    </ul>
                @else
                    <p>Aucun auteur assigné</p>
                @endif
            </div>
            <div class="col-md-6">
                <h6 class="text-muted mb-2">Genres</h6>
                @if($book->genres && count($book->genres) > 0)
                    <ul class="list-unstyled">
                        @foreach($book->genres as $genre)
                            <li><span class="badge bg-success">{{ $genre->nom }}</span></li>
                        @endforeach
                    </ul>
                @else
                    <p>Aucun genre assigné</p>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h6 class="text-muted mb-2">Exemplaires</h6>
                <p><span class="badge bg-info">{{ $book->exemplaires ? count($book->exemplaires) : 0 }} exemplaire(s)</span></p>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header bg-danger">
        <i class="fas fa-trash"></i> Zone de Danger
    </div>
    <div class="card-body">
        <p class="text-muted mb-3">Supprimer ce livre supprimera toutes les données associées.</p>
        <form method="POST" action="{{ route('admin.books.destroy', $book->id_livre) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce livre? Cette action est irréversible.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash"></i> Supprimer ce livre
            </button>
        </form>
    </div>
</div>
@endsection
