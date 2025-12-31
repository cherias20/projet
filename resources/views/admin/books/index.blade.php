@extends('layouts.admin')

@section('title', 'Gestion des Livres')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h1 class="page-title">
            <i class="fas fa-book"></i> Gestion des Livres
        </h1>
        <p class="page-subtitle">Gérez le catalogue des livres de la bibliothèque</p>
    </div>
    <div class="col-auto">
        <a href="#" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter un Livre
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-list"></i> Liste des Livres
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Éditeur</th>
                    <th>Genre</th>
                    <th>Exemplaires</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books ?? [] as $book)
                    <tr>
                        <td>{{ $book->id_livre ?? 'N/A' }}</td>
                        <td><strong>{{ $book->titre ?? 'N/A' }}</strong></td>
                        <td>{{ $book->auteur ?? 'N/A' }}</td>
                        <td>{{ $book->editeur ?? 'N/A' }}</td>
                        <td>{{ $book->genre ?? 'N/A' }}</td>
                        <td><span class="badge bg-info">{{ $book->exemplaires_count ?? 0 }}</span></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="fas fa-inbox"></i> Aucun livre trouvé
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
