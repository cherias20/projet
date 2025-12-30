@extends('layouts.app')

@section('title', 'Réservations de ' . $membre->getFullName())

@section('content')
<h1 class="mb-4"><i class="fas fa-bookmark"></i> Réservations de {{ $membre->getFullName() }}</h1>

<div class="table-responsive">
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Livre</th>
                <th>Date</th>
                <th>Position</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $reservation)
                <tr>
                    <td><strong>{{ $reservation->book->titre }}</strong></td>
                    <td>{{ $reservation->date_reservation->format('d/m/Y') }}</td>
                    <td>
                        <span class="badge bg-info">{{ $reservation->position }}</span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $reservation->statut === 'disponible' ? 'success' : 'warning' }}">
                            {{ ucfirst($reservation->statut) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Aucune réservation</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<nav>
    {{ $reservations->links() }}
</nav>

<div class="mt-4">
    <a href="{{ route('admin.members.show', $membre) }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour au Profil
    </a>
</div>
@endsection
