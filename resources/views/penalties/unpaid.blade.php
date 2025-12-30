@extends('layouts.app')

@section('title', 'Pénalités Non Payées')

@section('content')
<h1 class="mb-4"><i class="fas fa-exclamation-circle"></i> Pénalités Non Payées</h1>

<div class="alert alert-danger">
    <strong>Total impayé:</strong> {{ number_format($totalUnpaid, 2) }} €
</div>

<div class="table-responsive">
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Montant</th>
                <th>Raison</th>
                <th>Membre</th>
                <th>Date Calcul</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penalties as $penalty)
                <tr class="table-danger">
                    <td><strong>{{ number_format($penalty->montant, 2) }} €</strong></td>
                    <td>{{ $penalty->raison }}</td>
                    <td>{{ $penalty->membre->getFullName() }}</td>
                    <td>{{ $penalty->date_calcul->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('penalties.show', $penalty) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        <i class="fas fa-check-circle"></i> Aucune pénalité impayée
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<nav>
    {{ $penalties->links() }}
</nav>

<div class="mt-4">
    <a href="{{ route('penalties.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour aux Pénalités
    </a>
</div>
@endsection
