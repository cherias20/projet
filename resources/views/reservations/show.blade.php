@extends('layouts.app')

@section('title', 'Détails Réservation')

@section('content')
<h1 class="mb-4"><i class="fas fa-bookmark"></i> Détails de la Réservation</h1>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Informations de la Réservation</h5>
            </div>
            <div class="card-body">
                <p>
                    <strong>Livre:</strong> {{ $reservation->book->titre }}<br>
                    <strong>Membre:</strong> {{ $reservation->membre->getFullName() }}<br>
                    <strong>Date de réservation:</strong> {{ $reservation->date_reservation->format('d/m/Y H:i') }}<br>
                    <strong>Position dans la queue:</strong> 
                    <span class="badge bg-info" style="padding: 8px 12px; font-size: 1rem;">
                        {{ $reservation->position }}
                    </span>
                </p>
                
                <hr>
                
                <p>
                    <strong>Statut:</strong>
                    <span class="badge bg-{{ $reservation->statut === 'disponible' ? 'success' : ($reservation->statut === 'annulee' ? 'danger' : 'warning') }}" style="padding: 8px 12px; font-size: 1rem;">
                        {{ ucfirst($reservation->statut) }}
                    </span>
                </p>
                
                @if($reservation->notifier)
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> Le membre a été notifié
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Livre Réservé</h5>
            </div>
            <div class="card-body">
                <p>
                    <strong>{{ $reservation->book->titre }}</strong><br>
                    <small class="text-muted">{{ $reservation->book->editeur }}</small>
                </p>
                <p>
                    <strong>Exemplaires disponibles:</strong><br>
                    <span class="badge bg-success">{{ $reservation->book->getAvailableCopiesCount() }}/{{ $reservation->book->getTotalCopiesCount() }}</span>
                </p>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h5>Actions</h5>
            </div>
            <div class="card-body">
                @if($reservation->statut !== 'annulee')
                    <form method="POST" action="{{ route('reservations.cancel', $reservation) }}">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-times-circle"></i> Annuler la Réservation
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('reservations.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour aux Réservations
    </a>
</div>
@endsection
