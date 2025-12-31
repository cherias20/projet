@extends('layouts.admin')

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
        <a href="{{ route('admin.authors.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter un Auteur
        </a>
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
                    <th colspan="2">Biographie</th>
                    <th>Livres</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($authors as $author)
                    <tr>
                        <td>{{ $author->id_auteur }}</td>
                        <td><strong>{{ $author->nom }}</strong></td>
                        <td colspan="2">{{ $author->biographie ?? 'N/A' }}</td>
                        <td>
                            <span class="badge bg-info">
                                {{ $author->books->count() }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.authors.edit', $author) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.authors.destroy', $author) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
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
@endsection
