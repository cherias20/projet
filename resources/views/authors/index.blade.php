@extends('layouts.app')

@section('title', 'Auteurs')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1><i class="fas fa-pen-fancy"></i> Liste des Auteurs</h1>
    </div>
    @auth
        @if(auth()->user()->role === 'admin')
            <div class="col-md-4 text-end">
                <a href="{{ route('admin.authors.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Ajouter un Auteur
                </a>
            </div>
        @endif
    @endauth
</div>

<div class="table-responsive">
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Nom</th>
                <th>Nombre de Livres</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($authors as $author)
                <tr>
                    <td><strong>{{ $author->nom }}</strong></td>
                    <td>
                        <span class="badge bg-info">{{ $author->books()->count() }}</span>
                    </td>
                    <td>
                        <a href="{{ route('authors.show', $author) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i> Voir
                        </a>
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.authors.edit', $author) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Éditer
                                </a>
                                <form method="POST" action="{{ route('admin.authors.destroy', $author) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">Aucun auteur trouvé</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<nav>
    {{ $authors->links() }}
</nav>
@endsection
