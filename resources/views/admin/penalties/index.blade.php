@extends('layouts.app')

@section('title', 'Gestion des Pénalités - Admin')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1><i class="fas fa-receipt"></i> Gestion des Pénalités</h1>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('penalties.unpaid') }}" class="btn btn-danger">
            <i class="fas fa-exclamation"></i> Non Payées
        </a>
        <a href="{{ route('penalties.statistics') }}" class="btn btn-info">
            <i class="fas fa-chart-bar"></i> Statistiques
        </a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Montant</th>
                <th>Raison</th>
                <th>Membre</th>
                <th>Emprunt</th>
                <th>Date Calcul</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penalties as $penalty)
                <tr>
                    <td><strong>{{ number_format($penalty->montant, 2) }} €</strong></td>
                    <td>{{ $penalty->raison }}</td>
                    <td>
                        <a href="{{ route('admin.members.show', $penalty->membre) }}">
                            {{ $penalty->membre->getFullName() }}
                        </a>
                    </td>
                    <td>{{ $penalty->loan->exemplaire->book->titre }}</td>
                    <td>{{ $penalty->date_calcul->format('d/m/Y') }}</td>
                    <td>
                        <span class="badge bg-{{ $penalty->statut === 'payee' ? 'success' : ($penalty->statut === 'remise' ? 'info' : 'warning') }}">
                            {{ ucfirst($penalty->statut) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.penalties.show', $penalty) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Aucune pénalité trouvée</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<nav>
    {{ $penalties->links() }}
</nav>
@endsection
