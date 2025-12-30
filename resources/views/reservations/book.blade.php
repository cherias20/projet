@extends('layouts.app')

@section('title', 'Réservations - ' . $book->titre)

@section('content')
<h1 class="mb-4"><i class="fas fa-bookmark"></i> Réservations pour {{ $book->titre }}</h1>

<div class="alert alert-info">
    <strong>{{ $reservations->count() }}</strong> personne(s) en attente
</div>

<div class="table-responsive">
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Position</th>
                <th>Membre</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $reservation)
                <tr>
                    <td>
                        <span class="badge bg-info" style="font-size: 1rem; padding: 8px;">
                            {{ $reservation->position }}
                        </span>
                    </td>
                    <td>{{ $reservation->membre->getFullName() }}</td>
                    <td>{{ $reservation->date_reservation->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Aucune réservation en attente</td>
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
    <a href="{{ route('books.show', $book) }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour au Livre
    </a>
</div>
@endsection
