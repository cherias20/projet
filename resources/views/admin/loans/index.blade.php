@extends('layouts.admin')

@section('title', 'Gestion des Emprunts')

@section('content')
<style>
    :root {
        --primary-blue: #1e3c72;
        --secondary-blue: #2a5298;
        --light-blue: #f0f4f8;
        --text-dark: #2d3436;
        --text-light: #636e72;
        --border-color: #e0e6ed;
        --success: #27ae60;
        --warning: #f39c12;
        --danger: #e74c3c;
    }

    .loans-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .loans-header h1 {
        font-size: 2rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0;
    }

    .loans-header .page-subtitle {
        color: var(--text-light);
        font-size: 0.95rem;
    }

    .filter-section {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border: 1px solid var(--border-color);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .filter-section .form-label {
        font-weight: 700;
        color: var(--primary-blue);
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .filter-section .form-select {
        border: 2px solid var(--border-color);
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .filter-section .form-select:focus {
        border-color: var(--secondary-blue);
        box-shadow: 0 0 0 0.2rem rgba(42, 82, 152, 0.1);
    }

    .loans-table-container {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid var(--border-color);
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
    }

    .loans-table-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        padding: 1.5rem;
        color: white;
    }

    .loans-table-header i {
        margin-right: 10px;
        font-size: 1.2rem;
    }

    .loans-table-title {
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
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }

    .badge-in-progress {
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
        color: white;
    }

    .badge-returned {
        background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
        color: white;
    }

    .badge-overdue {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        color: white;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-action {
        width: 35px;
        height: 35px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: all 0.3s ease;
        font-size: 0.9rem;
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

    .pagination {
        margin-top: 1.5rem;
        justify-content: center;
    }

    .pagination .page-link {
        border-color: var(--border-color);
        color: var(--secondary-blue);
    }

    .pagination .page-link:hover {
        background-color: var(--light-blue);
        border-color: var(--secondary-blue);
    }

    .pagination .page-item.active .page-link {
        background-color: var(--secondary-blue);
        border-color: var(--secondary-blue);
    }
</style>

<div class="loans-header">
    <div>
        <h1>
            <i class="fas fa-exchange-alt"></i> Gestion des Emprunts
        </h1>
        <p class="page-subtitle">Suivez les emprunts des livres par les membres</p>
    </div>
</div>

<!-- Filter Section -->
<div class="filter-section">
    <div class="row">
        <div class="col-md-4">
            <label class="form-label">Filtrer par statut</label>
            <select class="form-select" id="statusFilter">
                <option value="">Tous les statuts</option>
                <option value="en_cours">En cours</option>
                <option value="retourne">Retourné</option>
                <option value="retard">En retard</option>
            </select>
        </div>
    </div>
</div>

<!-- Loans Table -->
<div class="loans-table-container">
    <div class="loans-table-header">
        <p class="loans-table-title">
            <i class="fas fa-list"></i> Liste des Emprunts
        </p>
    </div>
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="20%">Membre</th>
                    <th width="25%">Livre</th>
                    <th width="12%">Date d'emprunt</th>
                    <th width="15%">Retour prévu</th>
                    <th width="10%">Statut</th>
                    <th width="8%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                    <tr>
                        <td>
                            <span style="color: var(--secondary-blue); font-weight: 700;">{{ $loan->id_emprunt }}</span>
                        </td>
                        <td>
                            <div class="member-info">{{ $loan->membre->nom ?? 'N/A' }}</div>
                            <div class="member-email">{{ $loan->membre->email ?? 'N/A' }}</div>
                        </td>
                        <td>
                            <strong>{{ $loan->exemplaire->book->titre ?? 'N/A' }}</strong>
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($loan->date_emprunt)->format('d/m/Y') }}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($loan->date_retour_prevue)->format('d/m/Y') }}
                        </td>
                        <td>
                            @if($loan->statut === 'en_cours')
                                <span class="badge badge-in-progress">En cours</span>
                            @elseif($loan->statut === 'retourne')
                                <span class="badge badge-returned">Retourné</span>
                            @else
                                <span class="badge badge-overdue">En retard</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.loans.show', $loan) }}" class="btn-action btn-view" title="Voir détails">
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
                                <p>Aucun emprunt trouvé</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($loans->count() > 0)
        <div style="padding: 1.5rem; border-top: 1px solid var(--border-color);">
            {{ $loans->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

@endsection
