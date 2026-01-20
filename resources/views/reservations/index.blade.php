@extends('layouts.app')

@section('title', 'Réservations')

@section('content')
<style>
    .reservations-header {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 15px 40px rgba(30, 60, 114, 0.25);
    }

    .reservations-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 15px;
        letter-spacing: -0.5px;
    }

    .stat-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    }

    .stat-card .card-body {
        padding: 1.8rem;
    }

    .stat-card h5 {
        font-weight: 700;
        font-size: 0.9rem;
        opacity: 0.85;
        margin-bottom: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .stat-card h2 {
        font-size: 2.8rem;
        font-weight: 800;
        margin: 0.8rem 0 0 0;
    }

    .stat-card small {
        display: block;
        opacity: 0.75;
        font-size: 0.8rem;
        margin-top: 0.5rem;
    }

    .alert-success {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        border: none;
        color: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(17, 153, 142, 0.2);
    }

    .alert-success .btn-close {
        filter: brightness(0) invert(1);
    }

    .alert-danger {
        background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
        border: none;
        color: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(235, 51, 73, 0.2);
    }

    .alert-danger .btn-close {
        filter: brightness(0) invert(1);
    }

    .reservation-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: all 0.3s ease;
        margin-bottom: 1.5rem;
        background: white;
        position: relative;
    }

    .reservation-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #1e3c72, #2a5298);
    }

    .reservation-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    .reservation-card-body {
        padding: 2rem;
        display: flex;
        gap: 1.5rem;
        align-items: flex-start;
    }

    .book-info {
        flex: 1;
    }

    .book-title {
        font-weight: 700;
        color: #1a1a1a;
        font-size: 1.2rem;
        margin-bottom: 0.8rem;
        line-height: 1.4;
    }

    .book-subtitle {
        color: #777;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .reservation-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin-bottom: 1rem;
    }

    .meta-item {
        display: flex;
        flex-direction: column;
    }

    .meta-label {
        font-size: 0.8rem;
        color: #999;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 0.3rem;
    }

    .meta-value {
        font-size: 1rem;
        color: #333;
        font-weight: 600;
    }

    .reservation-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 0.8rem;
        margin-bottom: 1rem;
    }

    .position-badge {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: white;
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .badge-status {
        font-weight: 700;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-disponible {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
    }

    .status-attente {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .status-annulee {
        background: linear-gradient(135deg, #bdc3c7 0%, #95a5a6 100%);
        color: white;
    }

    .reservation-actions {
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
        flex-shrink: 0;
        margin-left: 1rem;
    }

    .view-btn {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        border: none;
        color: white;
        font-weight: 700;
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .view-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(30, 60, 114, 0.3);
        color: white;
        text-decoration: none;
    }

    .cancel-btn {
        background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
        border: none;
        color: white;
        font-weight: 700;
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .cancel-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(235, 51, 73, 0.3);
        color: white;
        text-decoration: none;
    }

    .no-reservations {
        background: white;
        padding: 4rem 2rem;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    .no-reservations i {
        font-size: 4rem;
        color: #ddd;
        margin-bottom: 1rem;
    }

    .no-reservations h4 {
        color: #333;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .pagination {
        margin-top: 2rem;
        justify-content: center;
    }

    .pagination .page-link {
        border-radius: 8px;
        border: 1px solid #e9ecef;
        margin: 0 0.25rem;
        transition: all 0.2s ease;
        color: #1e3c72;
    }

    .pagination .page-link:hover {
        background-color: #1e3c72;
        border-color: #1e3c72;
        color: white;
    }

    .pagination .page-item.active .page-link {
        background-color: #1e3c72;
        border-color: #1e3c72;
    }

    .quantity-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-size: 1rem;
        padding: 0.6rem 1.2rem;
        border-radius: 50px;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        min-width: 80px;
    }

    .quantity-badge i {
        font-size: 1.2rem;
    }
</style>

<!-- En-tête -->
<div class="reservations-header">
    <h1>
        <i class="fas fa-bookmark"></i>
        @if(session()->get('membre_role') === 'admin')
            Gestion des Réservations
        @else
            Mes Réservations
        @endif
    </h1>
</div>

<!-- Messages d'alerte -->
@if ($message = session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-check-circle"></i> {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if ($message = session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-exclamation-circle"></i> {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Statistiques -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card stat-card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title">Livres réservés</h5>
                <h2>{{ $reservations->groupBy('id_livre')->count() }}</h2>
                <small>Livre(s) réservé(s)</small>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card stat-card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Disponibles</h5>
                <h2>{{ $reservations->where('statut', 'disponible')->groupBy('id_livre')->count() }}</h2>
                <small>Livre(s) à retirer</small>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card stat-card bg-warning text-dark">
            <div class="card-body">
                <h5 class="card-title">En attente</h5>
                <h2>{{ $reservations->where('statut', 'attente')->groupBy('id_livre')->count() }}</h2>
                <small>Livre(s) en attente</small>
            </div>
        </div>
    </div>
</div>

<!-- Tableau des réservations groupées -->
@if($reservations->count() > 0)
    <div class="reservations-grid">
        @forelse($reservations->groupBy('id_livre') as $bookId => $bookReservations)
            @php
                $firstReservation = $bookReservations->first();
                $book = $firstReservation->book;
                $totalCount = $bookReservations->count();
                $availableCount = $bookReservations->where('statut', 'disponible')->count();
                $pendingCount = $bookReservations->where('statut', 'attente')->count();
            @endphp
            <div class="reservation-card">
                <div class="reservation-card-body">
                    <!-- Informations du livre -->
                    <div class="book-info">
                        <div class="book-title">{{ $book->titre }}</div>
                        @if($book->sous_titre)
                            <div class="book-subtitle">{{ $book->sous_titre }}</div>
                        @endif

                        <!-- Métadonnées -->
                        <div class="reservation-meta">
                            @if($book->authors->count() > 0)
                                <div class="meta-item">
                                    <div class="meta-label"><i class="fas fa-pen"></i> Auteur(s)</div>
                                    <div class="meta-value">{{ $book->authors->pluck('nom')->join(', ') }}</div>
                                </div>
                            @endif
                        </div>

                        <!-- Badges de statut -->
                        <div class="reservation-badges">
                            @if($availableCount > 0)
                                <span class="badge badge-status status-disponible">
                                    <i class="fas fa-check-circle"></i> {{ $availableCount }} disponible(s)
                                </span>
                            @endif
                            @if($pendingCount > 0)
                                <span class="badge badge-status status-attente">
                                    <i class="fas fa-clock"></i> {{ $pendingCount }} en attente
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Nombre de réservations -->
                    <div class="quantity-badge">
                        <i class="fas fa-bookmark"></i>
                        <span>{{ $totalCount }}</span>
                    </div>

                    <!-- Actions -->
                    <div class="reservation-actions">
                        <a href="{{ route('reservations.show', $firstReservation) }}" class="view-btn">
                            <i class="fas fa-eye"></i> Voir détails
                        </a>
                        @if($bookReservations->contains(fn($r) => $r->statut !== 'annulee'))
                            <button type="button" class="cancel-btn" onclick="cancelAllReservations({{ $bookReservations->map(fn($r) => $r->id)->implode(',') }})">
                                <i class="fas fa-times"></i> Annuler tout
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="no-reservations">
                <i class="fas fa-bookmark"></i>
                <h4>Aucune réservation</h4>
                <p class="text-muted">Vous n'avez pas de réservations pour le moment.</p>
                <a href="{{ route('books.index') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-book"></i> Consulter le catalogue
                </a>
            </div>
        @endforelse
    </div>
@else
    <div class="no-reservations">
        <i class="fas fa-bookmark"></i>
        <h4>Aucune réservation</h4>
        <p class="text-muted">Vous n'avez pas de réservations pour le moment.</p>
        <a href="{{ route('books.index') }}" class="btn btn-primary mt-3">
            <i class="fas fa-book"></i> Consulter le catalogue
        </a>
    </div>
@endif

@endsection
<script>
function cancelAllReservations(reservationIds) {
    if (!confirm('Êtes-vous sûr de vouloir annuler toutes les réservations pour ce livre ?')) {
        return;
    }
    
    const ids = String(reservationIds).split(',');
    const token = document.querySelector('meta[name="csrf-token"]')?.content || 
                  document.querySelector('input[name="_token"]')?.value;
    
    let completed = 0;
    
    ids.forEach(id => {
        fetch(`/reservations/${id}/cancel`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(() => {
            completed++;
            if (completed === ids.length) {
                location.reload();
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            location.reload();
        });
    });
}
</script>