@extends('layouts.app')

@section('title', 'Gestion des Auteurs')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h1 class="page-title">
            <i class="fas fa-pen-fancy"></i> Gestion des Auteurs
        </h1>
        <p class="page-subtitle">Gérez les auteurs de la bibliothèque</p>
    </div>
    <div class="col-auto">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAuthorModal">
            <i class="fas fa-plus"></i> Ajouter un Auteur
        </button>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-list"></i> Liste des Auteurs
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Nationalité</th>
                    <th>Nombre de livres</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse(DB::table('auteurs')->get() as $author)
                    <tr>
                        <td>{{ $author->id_auteur }}</td>
                        <td><strong>{{ $author->nom_auteur }}</strong></td>
                        <td>{{ $author->prenom_auteur ?? 'N/A' }}</td>
                        <td>{{ $author->nationalite ?? 'N/A' }}</td>
                        <td>
                            <span class="badge bg-info">
                                {{ DB::table('book_author')->where('id_auteur', $author->id_auteur)->count() }}
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editAuthorModal">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="#" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="fas fa-inbox"></i> Aucun auteur trouvé
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Ajouter Auteur -->
<div class="modal fade" id="addAuthorModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un Auteur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="#">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nom</label>
                            <input type="text" class="form-control" name="nom_auteur" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Prénom</label>
                            <input type="text" class="form-control" name="prenom_auteur">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nationalité</label>
                        <input type="text" class="form-control" name="nationalite">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Biographie</label>
                        <textarea class="form-control" name="biographie" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
