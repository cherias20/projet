@extends('layouts.app')

@section('title', 'Membres')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1><i class="fas fa-users"></i> Gestion des Membres</h1>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('admin.members.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter un Membre
        </a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Carte</th>
                <th>Rôle</th>
                <th>Statut</th>
                <th>Emprunts Actifs</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($membres as $membre)
                <tr>
                    <td><strong>{{ $membre->getFullName() }}</strong></td>
                    <td>{{ $membre->email }}</td>
                    <td><code>{{ $membre->numero_carte }}</code></td>
                    <td>
                        <span class="badge bg-{{ $membre->role === 'admin' ? 'danger' : 'secondary' }}">
                            {{ ucfirst($membre->role) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $membre->statut === 'actif' ? 'success' : 'warning' }}">
                            {{ ucfirst($membre->statut) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-info">{{ $membre->getActiveLoansCount() }}</span>
                    </td>
                    <td>
                        <a href="{{ route('admin.members.show', $membre) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.members.edit', $membre) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        @if($membre->statut === 'actif')
                            <form method="POST" action="{{ route('admin.members.suspend', $membre) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.members.activate', $membre) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Aucun membre trouvé</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<nav>
    {{ $membres->links() }}
</nav>
@endsection
