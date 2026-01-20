@extends('layouts.app')

@section('title', $book->titre)

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <h1 class="card-title mb-2">{{ $book->titre }}</h1>
                            @if($book->sous_titre)
                                <p class="text-muted">{{ $book->sous_titre }}</p>
                            @endif
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('books.index') }}" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left"></i> Retour
                            </a>
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2"><i class="fas fa-user"></i> Auteur(s)</h6>
                            @if($book->authors && count($book->authors) > 0)
                                <ul class="list-unstyled">
                                    @foreach($book->authors as $author)
                                        <li>
                                            <a href="{{ route('authors.show', $author->id_auteur) }}" class="text-decoration-none">
                                                {{ $author->nom }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted">Auteur non spécifié</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2"><i class="fas fa-tag"></i> Genre(s)</h6>
                            @if($book->genres && count($book->genres) > 0)
                                <div>
                                    @foreach($book->genres as $genre)
                                        <span class="badge bg-primary me-2 mb-2">{{ $genre->nom }}</span>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted">Genre non spécifié</p>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2"><i class="fas fa-building"></i> Éditeur</h6>
                            <p>{{ $book->editeur ?? 'Non spécifié' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2"><i class="fas fa-calendar"></i> Année de publication</h6>
                            <p>{{ $book->annee_publication ?? 'Non spécifié' }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2"><i class="fas fa-globe"></i> Langue</h6>
                            <p>{{ $book->langue ?? 'Non spécifié' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2"><i class="fas fa-file-alt"></i> Nombre de pages</h6>
                            <p>{{ $book->pages ?? 'Non spécifié' }}</p>
                        </div>
                    </div>

                    <hr>

                    <div class="mb-4">
                        <h6 class="text-muted mb-2"><i class="fas fa-book-open"></i> Résumé</h6>
                        <p class="card-text">{{ $book->resume ?? 'Aucun résumé disponible' }}</p>
                    </div>

                    <hr>

                    <div class="mb-4">
                        <h6 class="text-muted mb-2"><i class="fas fa-copy"></i> Exemplaires disponibles</h6>
                        @if($book->exemplaires && count($book->exemplaires) > 0)
                            <span class="badge bg-success">{{ count($book->exemplaires) }} exemplaire(s)</span>
                            @if(session()->has('membre_id'))
                                <div class="mt-3 d-flex gap-2">
                                    <a href="{{ route('admin.loans.create', ['book_id' => $book->id_livre]) }}" class="btn btn-success">
                                        <i class="fas fa-download"></i> Emprunter ce livre
                                    </a>
                                    <a href="{{ route('reservations.create', ['book_id' => $book->id_livre]) }}" class="btn btn-primary">
                                        <i class="fas fa-bookmark"></i> Réserver ce livre
                                    </a>
                                </div>
                            @else
                                <div class="mt-3">
                                    <p class="text-muted"><em>Connectez-vous pour emprunter ou réserver ce livre</em></p>
                                </div>
                            @endif
                        @else
                            <span class="badge bg-danger">Aucun exemplaire disponible</span>
                        @endif
                    </div>

                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body text-center text-muted">
                    <p class="mb-0">
                        <i class="fas fa-info-circle"></i>
                        Créé le {{ $book->created_at->format('d/m/Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
