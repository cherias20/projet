@extends('layouts.app')

@section('title', 'Réservations')

@section('content')
<h1 class="mb-4"><i class="fas fa-bookmark"></i> Gestion des Réservations</h1>

<div class="table-responsive">
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Livre</th>
                <th>Membre</th>
                <th>Date Réservation</th>
                <th>Position</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $reservation)
                <tr>
                    <td><strong>{{ $reservation->book->titre }}</strong></td>
                    <td>{{ $reservation->membre->getFullName() }}</td>
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
                        @if($reservation->statut !== 'annulee')
                            <form method="POST" action="{{ route('reservations.cancel', $reservation) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Aucune réservation trouvée</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<nav>
    {{ $reservations->links() }}
</nav>
@endsection
