@extends('layouts.admin')

@section('title', 'Gestion des Pénalités')

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

    .header-actions {
        display: flex;
        gap: 0.75rem;
    }

    .btn-header {
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .btn-unpaid {
        background: linear-gradient(135deg, #d32f2f 0%, #c62828 100%);
        color: white;
    }

    .btn-unpaid:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(211, 47, 47, 0.3);
        color: white;
    }

    .btn-stats {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }

    .btn-stats:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 172, 254, 0.3);
        color: white;
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

    .amount {
        font-size: 1.1rem;
        font-weight: 800;
        color: #d32f2f;
    }

    .badge {
        padding: 0.5rem 0.75rem;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    .badge-payee {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        color: white;
    }

    .badge-remise {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }

    .badge-non-payee {
        background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
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
            <i class="fas fa-receipt"></i> Gestion des Pénalités
        </h1>
        <p class="page-subtitle">Gérez les pénalités des retards de livres</p>
    </div>
    <div class="header-actions">
        <a href="{{ route('penalties.unpaid') }}" class="btn-header btn-unpaid">
            <i class="fas fa-exclamation"></i> Non Payées
        </a>
        <a href="{{ route('penalties.statistics') }}" class="btn-header btn-stats">
            <i class="fas fa-chart-bar"></i> Statistiques
        </a>
    </div>
</div>

<!-- Penalties Table -->
<div class="table-container">
    <div class="table-header">
        <p class="table-title">
            <i class="fas fa-list"></i> Liste des Pénalités
        </p>
    </div>
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th width="12%">Montant</th>
                    <th width="18%">Raison</th>
                    <th width="18%">Membre</th>
                    <th width="20%">Livre</th>
                    <th width="12%">Date Calcul</th>
                    <th width="10%">Statut</th>
                    <th width="10%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penalties as $penalty)
                    <tr>
                        <td>
                            <span class="amount">{{ number_format($penalty->montant, 2) }} €</span>
                        </td>
                        <td>
                            {{ $penalty->raison }}
                        </td>
                        <td>
                            <div class="member-info">
                                <a href="{{ route('admin.members.show', $penalty->membre) }}" style="color: var(--secondary-blue); text-decoration: none;">
                                    {{ $penalty->membre->getFullName() }}
                                </a>
                            </div>
                        </td>
                        <td>
                            <strong>{{ $penalty->loan->exemplaire->book->titre }}</strong>
                        </td>
                        <td>
                            {{ $penalty->date_calcul->format('d/m/Y') }}
                        </td>
                        <td>
                            @if($penalty->statut === 'payee')
                                <span class="badge badge-payee">Payée</span>
                            @elseif($penalty->statut === 'remise')
                                <span class="badge badge-remise">Remise</span>
                            @else
                                <span class="badge badge-non-payee">Non Payée</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.penalties.show', $penalty) }}" class="btn-action btn-view" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <p>Aucune pénalité trouvée</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
