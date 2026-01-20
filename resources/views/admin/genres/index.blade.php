@extends('layouts.admin')

@section('title', 'Gestion des Genres')

@section('content')
<style>
    :root {
        --primary-blue: #1e3c72;
        --secondary-blue: #2a5298;
        --light-blue: #f0f4f8;
        --text-dark: #2d3436;
        --text-light: #636e72;
        --border-color: #e0e6ed;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .page-header h1 {
        font-size: 2rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0;
    }

    .page-header .page-subtitle {
        color: var(--text-light);
        font-size: 0.95rem;
    }

    .btn-add {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(30, 60, 114, 0.3);
        color: white;
    }

    .table-container {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid var(--border-color);
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
    }

    .table-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        padding: 1.5rem;
        color: white;
    }

    .table-header i {
        margin-right: 10px;
        font-size: 1.2rem;
    }

    .table-title {
        font-size: 1.2rem;
        font-weight: 800;
        margin: 0;
    }

    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background-color: var(--light-blue);
        border-color: var(--border-color);
        color: var(--primary-blue);
        font-weight: 700;
        padding: 1rem;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table tbody tr {
        border-color: var(--border-color);
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: var(--light-blue);
    }

    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        color: var(--text-dark);
    }

    .badge {
        padding: 0.5rem 0.75rem;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-action {
        width: 35px;
        height: 35px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        cursor: pointer;
    }

    .btn-edit {
        background-color: #e3f2fd;
        color: #1976d2;
    }

    .btn-edit:hover {
        background-color: #1976d2;
        color: white;
        transform: translateY(-2px);
    }

    .btn-delete {
        background-color: #ffebee;
        color: #d32f2f;
    }

    .btn-delete:hover {
        background-color: #d32f2f;
        color: white;
        transform: translateY(-2px);
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
    }

    .empty-state i {
        font-size: 3rem;
        color: var(--border-color);
        margin-bottom: 1rem;
    }

    .empty-state p {
        color: var(--text-light);
        font-size: 1.1rem;
        margin: 0;
    }

    .modal-content {
        border: none;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }

    .modal-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        color: white;
        border: none;
        border-radius: 12px 12px 0 0;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }

    .modal-header h5 {
        font-weight: 700;
    }

    .form-label {
        color: var(--primary-blue);
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
        border: 2px solid var(--border-color);
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--secondary-blue);
        box-shadow: 0 0 0 0.2rem rgba(42, 82, 152, 0.1);
    }
</style>

<div class="page-header">
    <div>
        <h1>
            <i class="fas fa-tag"></i> Gestion des Genres
        </h1>
        <p class="page-subtitle">Organisez et gérez les genres de livres</p>
    </div>
    <button class="btn-add" data-bs-toggle="modal" data-bs-target="#addGenreModal">
        <i class="fas fa-plus"></i> Ajouter un Genre
    </button>
</div>

<!-- Genres Table -->
<div class="table-container">
    <div class="table-header">
        <p class="table-title">
            <i class="fas fa-list"></i> Liste des Genres
        </p>
    </div>
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="25%">Nom</th>
                    <th width="50%">Description</th>
                    <th width="10%">Livres</th>
                    <th width="10%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($genres as $genre)
                    <tr>
                        <td>
                            <span style="color: var(--secondary-blue); font-weight: 700;">{{ $genre->id_genre ?? $genre->id }}</span>
                        </td>
                        <td>
                            <strong>{{ $genre->nom }}</strong>
                        </td>
                        <td>
                            <small class="text-muted">{{ Str::limit($genre->description ?? 'Aucune description', 80, '...') }}</small>
                        </td>
                        <td>
                            <span class="badge">
                                {{ $genre->books()->count() }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#editGenreModal" data-genre-id="{{ $genre->id_genre ?? $genre->id }}" data-genre-nom="{{ $genre->nom }}" data-genre-description="{{ $genre->description }}" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form method="POST" action="{{ route('admin.genres.destroy', $genre->id_genre ?? $genre->id) }}" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <p>Aucun genre trouvé</p>
                            </div>
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
                <h5 class="modal-title"><i class="fas fa-plus"></i> Ajouter un Genre</h5>
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
                        <textarea class="form-control" name="description" rows="3" placeholder="Entrez une description..."></textarea>
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

<!-- Modal Éditer Genre -->
<div class="modal fade" id="editGenreModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-edit"></i> Modifier le Genre</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="#">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nom du genre</label>
                        <input type="text" class="form-control" name="nom_genre" id="editGenreNom" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="editGenreDesc" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
