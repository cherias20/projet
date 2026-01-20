@extends('layouts.admin')

@section('title', 'Gestion des Livres')

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

    .search-section {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border: 1px solid var(--border-color);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .search-section .form-control {
        border: 2px solid var(--border-color);
        border-radius: 8px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .search-section .form-control:focus {
        border-color: var(--secondary-blue);
        box-shadow: 0 0 0 0.2rem rgba(42, 82, 152, 0.1);
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

    .book-image {
        width: 60px;
        height: 90px;
        object-fit: cover;
        border-radius: 6px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .book-no-image {
        width: 60px;
        height: 90px;
        background-color: var(--light-blue);
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-light);
    }

    .badge {
        padding: 0.5rem 0.75rem;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    .badge-blue {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }

    .badge-purple {
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

    .btn-view {
        background-color: var(--light-blue);
        color: var(--secondary-blue);
    }

    .btn-view:hover {
        background-color: var(--secondary-blue);
        color: white;
        transform: translateY(-2px);
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
</style>

<div class="page-header">
    <div>
        <h1>
            <i class="fas fa-book"></i> Gestion des Livres
        </h1>
        <p class="page-subtitle">Gérez le catalogue des livres de la bibliothèque</p>
    </div>
    <a href="{{ route('admin.books.create') }}" class="btn-add">
        <i class="fas fa-plus"></i> Ajouter un Livre
    </a>
</div>

<!-- Search Section -->
<div class="search-section">
    <div class="row">
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Rechercher un livre par titre...">
        </div>
    </div>
</div>

<!-- Books Table -->
<div class="table-container">
    <div class="table-header">
        <p class="table-title">
            <i class="fas fa-list"></i> Liste des Livres
        </p>
    </div>
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th width="8%">Image</th>
                    <th width="5%">#</th>
                    <th width="20%">Titre</th>
                    <th width="15%">Auteur</th>
                    <th width="12%">Genre</th>
                    <th width="10%">Éditeur</th>
                    <th width="8%">Exemplaires</th>
                    <th width="12%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books ?? [] as $book)
                    <tr>
                        <td>
                            @if($book->images)
                                <img src="{{ asset('storage/' . $book->images) }}" alt="{{ $book->titre }}" class="book-image">
                            @else
                                <div class="book-no-image">
                                    <i class="fas fa-book"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <span style="color: var(--secondary-blue); font-weight: 700;">{{ $book->id_livre ?? 'N/A' }}</span>
                        </td>
                        <td>
                            <strong>{{ $book->titre ?? 'N/A' }}</strong>
                        </td>
                        <td>
                            @forelse($book->authors as $author)
                                <span class="badge badge-blue">{{ $author->nom }}</span>
                            @empty
                                <span class="text-muted">N/A</span>
                            @endforelse
                        </td>
                        <td>
                            @forelse($book->genres as $genre)
                                <span class="badge badge-purple">{{ $genre->nom }}</span>
                            @empty
                                <span class="text-muted">N/A</span>
                            @endforelse
                        </td>
                        <td>
                            {{ $book->editeur ?? 'N/A' }}
                        </td>
                        <td>
                            <span class="badge badge-blue">{{ $book->exemplaires()->count() ?? 0 }}</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.books.show', $book->id_livre) }}" class="btn-action btn-view" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.books.edit', $book->id_livre) }}" class="btn-action btn-edit" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.books.destroy', $book->id_livre) }}" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr?');">
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
                        <td colspan="8">
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <p>Aucun livre trouvé</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
