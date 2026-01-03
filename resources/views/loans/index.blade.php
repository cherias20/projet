@extends('layouts.app')

@section('title', 'Emprunts')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1><i class="fas fa-exchange-alt"></i> Gestion des Emprunts</h1>
    </div>
    @auth
        @if(auth()->user()->role === 'admin')
            <div class="col-md-4 text-end">
                <a href="{{ route('loans.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nouvel Emprunt
                </a>
                <a href="{{ route('loans.overdue') }}" class="btn btn-danger">
                    <i class="fas fa-clock"></i> En Retard
                </a>
            </div>
        @endif
    @endauth
</div>

<div class="table-responsive">
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Livre</th>
                <th>Membre</th>
                <th>Date Emprunt</th>
                <th>Date Retour Prévue</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($loans as $loan)
                <tr>
                    <td>
                        <strong>{{ $loan->exemplaire->book->titre }}</strong><br>
                        <small class="text-muted">{{ $loan->exemplaire->code_barre }}</small>
                    </td>
                    <td>{{ $loan->membre->getFullName() }}</td>
                    <td>{{ $loan->date_emprunt->format('d/m/Y') }}</td>
                    <td>
                        {{ $loan->date_retour_prevue->format('d/m/Y') }}
                        @if($loan->isOverdue())
                            <br><span class="badge bg-danger">EN RETARD</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge badge-status status-{{ $loan->statut }}">
                            {{ ucfirst(str_replace('_', ' ', $loan->statut)) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('loans.show', $loan) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                        @if($loan->statut === 'en_cours')
                            @if($loan->canRenew())
                                <form method="POST" action="{{ route('loans.renew', $loan) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-info" title="Renouveler">
                                        <i class="fas fa-sync"></i>
                                    </button>
                                </form>
                            @endif
                            <form method="POST" action="{{ route('loans.return', $loan) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success" title="Retourner le livre">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Aucun emprunt trouvé</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
@if ($loans instanceof \Illuminate\Pagination\Paginator)
<nav>
    {{ $loans->links() }}
</nav>
@endif
@endsection
