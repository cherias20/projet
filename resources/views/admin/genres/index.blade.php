@extends('layouts.app')

@section('title', 'Gestion des Genres')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h1 class="page-title">
            <i class="fas fa-tag"></i> Gestion des Genres
        </h1>
        <p class="page-subtitle">Organisez et gérez les genres de livres</p>
    </div>
    <div class="col-auto">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGenreModal">
            <i class="fas fa-plus"></i> Ajouter un Genre
        </button>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-list"></i> Liste des Genres
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Nombre de livres</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse(DB::table('genres')->get() as $genre)
                    <tr>
                        <td>{{ $genre->id_genre }}</td>
                        <td><strong>{{ $genre->nom_genre }}</strong></td>
                        <td>{{ Str::limit($genre->description ?? '', 50) }}</td>
                        <td>
                            <span class="badge bg-info">
                                {{ DB::table('book_genre')->where('id_genre', $genre->id_genre)->count() }}
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editGenreModal">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="#" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            <i class="fas fa-inbox"></i> Aucun genre trouvé
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Ajouter Genre -->
<div class="modal fade" id="addGenreModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un Genre</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="#">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nom du genre</label>
                        <input type="text" class="form-control" name="nom_genre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
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
