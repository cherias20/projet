@extends('layouts.admin')

@section('title', 'Détails de la Réservation')

@section('content')
<style>
    :root {
        --primary-blue: #1e3c72;
        --secondary-blue: #2a5298;
        --light-blue: #f0f4f8;
        --text-dark: #2d3436;
        --text-light: #636e72;
        --border-color: #e0e6ed;
    }

    .detail-header { background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%); color: white; padding: 2rem; border-radius: 12px; margin-bottom: 2rem; box-shadow: 0 4px 20px rgba(30, 60, 114, 0.2); }
    .detail-header h2 { margin: 0; font-size: 1.5rem; }

    .info-section { background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; border: 1px solid var(--border-color); box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05); }

    .section-title { font-size: 1.1rem; font-weight: 700; color: var(--primary-blue); margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 2px solid var(--light-blue); display: flex; align-items: center; gap: 10px; }

    .info-row { display: flex; justify-content: space-between; padding: 0.75rem 0; border-bottom: 1px solid var(--light-blue); }
    .info-row:last-child { border-bottom: none; }

    .info-label { font-weight: 700; color: var(--primary-blue); min-width: 150px; }
    .info-value { color: var(--text-dark); font-weight: 500; }

    .badge { display: inline-block; padding: 0.5rem 1rem; border-radius: 6px; font-weight: 600; font-size: 0.85rem; }
    .badge-success { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; }
    .badge-warning { background: linear-gradient(135deg, #ffa726 0%, #fb8c00 100%); color: white; }
    .badge-danger { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); color: white; }

    .action-buttons { display: flex; gap: 1rem; margin-top: 2rem; flex-wrap: wrap; }

    .btn-cancel { background: #d32f2f; color: white; padding: 0.75rem 1.75rem; border-radius: 8px; font-weight: 700; border: none; transition: all 0.3s ease; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem; }
    .btn-cancel:hover { background: #b71c1c; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(211, 47, 47, 0.3); }

    .btn-back { background: var(--light-blue); color: var(--secondary-blue); padding: 0.75rem 1.75rem; border-radius: 8px; font-weight: 700; border: none; transition: all 0.3s ease; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; }
    .btn-back:hover { background-color: var(--secondary-blue); color: white; text-decoration: none; }
</style>

<h1 style="font-size: 2rem; font-weight: 800; background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 2rem;">
    <i class="fas fa-bookmark"></i> Détails de la Réservation
</h1>

<div class="detail-header">
    <h2>{{ $reservation->book->titre }}</h2>
    <p style="margin: 0.5rem 0 0 0; opacity: 0.9;">Réservé par {{ $reservation->membre->getFullName() }}</p>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="info-section">
            <div class="section-title">
                <i class="fas fa-info-circle"></i> Informations Générales
            </div>
            <div class="info-row">
                <span class="info-label">Livre</span>
                <span class="info-value"><a href="{{ route('admin.books.show', $reservation->book) }}">{{ $reservation->book->titre }}</a></span>
            </div>
            <div class="info-row">
                <span class="info-label">Membre</span>
                <span class="info-value"><a href="{{ route('admin.members.show', $reservation->membre) }}">{{ $reservation->membre->getFullName() }}</a></span>
            </div>
            <div class="info-row">
                <span class="info-label">Date de Réservation</span>
                <span class="info-value">{{ $reservation->date_reservation->format('d/m/Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Position dans la File</span>
                <span class="info-value"><strong>#{{ $reservation->position }}</strong></span>
            </div>
            <div class="info-row">
                <span class="info-label">Statut</span>
                <span class="info-value">
                    @if($reservation->statut === 'disponible')
                        <span class="badge badge-success">Disponible</span>
                    @elseif($reservation->statut === 'en_attente')
                        <span class="badge badge-warning">En Attente</span>
                    @else
                        <span class="badge badge-danger">Annulée</span>
                    @endif
                </span>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        @if($reservation->statut !== 'annulee')
            <div class="info-section">
                <div class="section-title">
                    <i class="fas fa-cog"></i> Actions
                </div>
                <form action="{{ route('admin.reservations.cancel', $reservation) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr?');">
                    @csrf
                    <button type="submit" class="btn-cancel" style="width: 100%;">
                        <i class="fas fa-times"></i> Annuler
                    </button>
                </form>
            </div>
        @else
            <div class="info-section">
                <p class="text-danger"><i class="fas fa-info-circle"></i> Cette réservation est annulée.</p>
            </div>
        @endif
    </div>
</div>

<div class="action-buttons">
    <a href="{{ route('admin.reservations.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Retour à la Liste
    </a>
</div>

@endsection
