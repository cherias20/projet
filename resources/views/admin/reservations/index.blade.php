@extends('layouts.admin')

@section('title', 'Gestion des Réservations')

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

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .page-header h1 {
        font-size: 2rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0;
    }

    .page-header .page-subtitle {
        color: var(--text-light);
        font-size: 0.95rem;
    }

    .table-container {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid var(--border-color);
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
    }

    .table-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        padding: 1.5rem;
        color: white;
    }

    .table-header i {
        margin-right: 10px;
        font-size: 1.2rem;
    }

    .table-title {
        font-size: 1.2rem;
        font-weight: 800;
        margin: 0;
    }

    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background-color: var(--light-blue);
        border-color: var(--border-color);
        color: var(--primary-blue);
        font-weight: 700;
        padding: 1rem;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table tbody tr {
        border-color: var(--border-color);
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: var(--light-blue);
    }

    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        color: var(--text-dark);
    }

    .member-info {
        font-weight: 700;
        color: var(--primary-blue);
    }

    .member-email {
        font-size: 0.85rem;
        color: var(--text-light);
        margin-top: 2px;
    }

    .badge {
        padding: 0.5rem 0.75rem;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    .badge-attente {
        background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
        color: white;
    }

    .badge-validee {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        color: white;
    }

    .badge-annulee {
        background: linear-gradient(135deg, #b0b0b0 0%, #7a7a7a 100%);
        color: white;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-action {
        width: 35px;
        height: 35px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        cursor: pointer;
    }

    .btn-view {
        background-color: var(--light-blue);
        color: var(--secondary-blue);
    }

    .btn-view:hover {
        background-color: var(--secondary-blue);
        color: white;
        transform: translateY(-2px);
    }

    .btn-validate {
        background-color: #e8f5e9;
        color: #388e3c;
    }

    .btn-validate:hover {
        background-color: #388e3c;
        color: white;
        transform: translateY(-2px);
    }

    .btn-cancel {
        background-color: #ffebee;
        color: #d32f2f;
    }

    .btn-cancel:hover {
        background-color: #d32f2f;
        color: white;
        transform: translateY(-2px);
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
    }

    .empty-state i {
        font-size: 3rem;
        color: var(--border-color);
        margin-bottom: 1rem;
    }

    .empty-state p {
        color: var(--text-light);
        font-size: 1.1rem;
        margin: 0;
    }
</style>

<div class="page-header">
    <div>
        <h1>
            <i class="fas fa-bookmark"></i> Gestion des Réservations
        </h1>
        <p class="page-subtitle">Gérez les réservations de livres des membres</p>
    </div>
</div>

<!-- Reservations Table -->
<div class="table-container">
    <div class="table-header">
        <p class="table-title">
            <i class="fas fa-list"></i> Liste des Réservations
        </p>
    </div>
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="25%">Membre</th>
                    <th width="25%">Livre</th>
                    <th width="15%">Date de réservation</th>
                    <th width="10%">Statut</th>
                    <th width="15%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $reservation)
                    <tr>
                        <td>
                            <span style="color: var(--secondary-blue); font-weight: 700;">{{ $reservation->id_reservation }}</span>
                        </td>
                        <td>
                            <div class="member-info">{{ $reservation->membre->nom ?? 'N/A' }}</div>
                            <div class="member-email">{{ $reservation->membre->email ?? 'N/A' }}</div>
                        </td>
                        <td>
                            <strong>{{ $reservation->book->titre ?? 'N/A' }}</strong>
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y H:i') }}
                        </td>
                        <td>
                            @if($reservation->statut === 'en_attente')
                                <span class="badge badge-attente">En attente</span>
                            @elseif($reservation->statut === 'validee')
                                <span class="badge badge-validee">Validée</span>
                            @else
                                <span class="badge badge-annulee">Annulée</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.reservations.show', $reservation) }}" class="btn-action btn-view" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn-action btn-validate" title="Valider">
                                    <i class="fas fa-check"></i>
                                </a>
                                <a href="#" class="btn-action btn-cancel" title="Annuler">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <p>Aucune réservation trouvée</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
