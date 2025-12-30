@extends('layouts.app')

@section('title', 'Emprunts en Retard')

@section('content')
<h1 class="mb-4"><i class="fas fa-clock"></i> Emprunts en Retard</h1>

<div class="alert alert-danger">
    <strong>Attention!</strong> {{ $loans->count() }} emprunt(s) en retard
</div>

<div class="table-responsive">
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Livre</th>
                <th>Membre</th>
                <th>Date Retour Prévue</th>
                <th>Jours de Retard</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($loans as $loan)
                <tr class="table-danger">
                    <td>
                        <strong>{{ $loan->exemplaire->book->titre }}</strong><br>
                        <small class="text-muted">{{ $loan->exemplaire->code_barre }}</small>
                    </td>
                    <td>{{ $loan->membre->getFullName() }}</td>
                    <td>{{ $loan->date_retour_prevue->format('d/m/Y') }}</td>
                    <td>
                        <span class="badge bg-danger">
                            {{ $loan->getDaysOverdue() }} jour(s)
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('loans.show', $loan) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                        <form method="POST" action="{{ route('loans.return', $loan) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-check"></i> Retourner
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        <i class="fas fa-check-circle"></i> Aucun emprunt en retard
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<nav>
    {{ $loans->links() }}
</nav>

<div class="mt-4">
    <a href="{{ route('loans.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour aux Emprunts
    </a>
</div>
@endsection
