@extends('layouts.app')

@section('title', 'Détails de la Réservation - Admin')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1><i class="fas fa-bookmark"></i> Détails de la Réservation</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Informations de la Réservation</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            <strong>Livre:</strong><br>
                            <a href="{{ route('admin.books.edit', $reservation->book) }}">
                                {{ $reservation->book->titre }}
                            </a>
                        </p>
                        <p>
                            <strong>Membre:</strong><br>
                            <a href="{{ route('admin.members.show', $reservation->membre) }}">
                                {{ $reservation->membre->getFullName() }}
                            </a>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <strong>Date de Réservation:</strong><br>
                            {{ $reservation->date_reservation->format('d/m/Y') }}
                        </p>
                        <p>
                            <strong>Position dans la File:</strong><br>
                            <span class="badge bg-info">{{ $reservation->position }}</span>
                        </p>
                        <p>
                            <strong>Statut:</strong><br>
                            <span class="badge bg-{{ $reservation->statut === 'disponible' ? 'success' : ($reservation->statut === 'en_attente' ? 'warning' : 'danger') }}">
                                {{ ucfirst($reservation->statut) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Actions</h5>
            </div>
            <div class="card-body">
                @if($reservation->statut !== 'annulee')
                    <form method="POST" action="{{ route('reservations.cancel', $reservation) }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr?')">
                            <i class="fas fa-times"></i> Annuler la Réservation
                        </button>
                    </form>
                @else
                    <p class="text-danger">Cette réservation est annulée.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary btn-sm w-100 mb-2">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
