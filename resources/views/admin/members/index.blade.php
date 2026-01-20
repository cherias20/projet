@extends('layouts.admin')

@section('title', 'Gestion des Membres')

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

    .filter-section .form-control,
    .filter-section .form-select {
        border: 2px solid var(--border-color);
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .filter-section .form-control:focus,
    .filter-section .form-select:focus {
        border-color: var(--secondary-blue);
        box-shadow: 0 0 0 0.2rem rgba(42, 82, 152, 0.1);
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

    .badge-actif {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        color: white;
    }

    .badge-suspendu {
        background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
        color: white;
    }

    .badge-inactif {
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

    .btn-edit {
        background-color: #e3f2fd;
        color: #1976d2;
    }

    .btn-edit:hover {
        background-color: #1976d2;
        color: white;
        transform: translateY(-2px);
    }

    .btn-suspend {
        background-color: #ffebee;
        color: #d32f2f;
    }

    .btn-suspend:hover {
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
            <i class="fas fa-users"></i> Gestion des Membres
        </h1>
        <p class="page-subtitle">Gérez les comptes des membres de la bibliothèque</p>
    </div>
</div>

<!-- Filter Section -->
<div class="filter-section">
    <div class="row">
        <div class="col-md-6">
            <label class="form-label">Rechercher</label>
            <input type="text" class="form-control" placeholder="Rechercher un membre...">
        </div>
        <div class="col-md-3">
            <label class="form-label">Filtrer par statut</label>
            <select class="form-select">
                <option value="">Tous les statuts</option>
                <option value="actif">Actif</option>
                <option value="suspendu">Suspendu</option>
                <option value="inactif">Inactif</option>
            </select>
        </div>
    </div>
</div>

<!-- Members Table -->
<div class="table-container">
    <div class="table-header">
        <p class="table-title">
            <i class="fas fa-list"></i> Liste des Membres
        </p>
    </div>
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="25%">Nom</th>
                    <th width="20%">Email</th>
                    <th width="15%">Téléphone</th>
                    <th width="10%">Statut</th>
                    <th width="10%">Inscription</th>
                    <th width="15%">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse(DB::table('membres')->get() as $member)
                    <tr>
                        <td>
                            <span style="color: var(--secondary-blue); font-weight: 700;">{{ $member->id_membre }}</span>
                        </td>
                        <td>
                            <div class="member-info">{{ $member->nom }} {{ $member->prenom }}</div>
                            <div class="member-email">{{ $member->email }}</div>
                        </td>
                        <td>
                            {{ $member->email }}
                        </td>
                        <td>
                            {{ $member->telephone ?? 'N/A' }}
                        </td>
                        <td>
                            @if($member->statut === 'actif')
                                <span class="badge badge-actif">Actif</span>
                            @elseif($member->statut === 'suspendu')
                                <span class="badge badge-suspendu">Suspendu</span>
                            @else
                                <span class="badge badge-inactif">Inactif</span>
                            @endif
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($member->date_inscription)->format('d/m/Y') }}
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.members.show', $member->id_membre) }}" class="btn-action btn-view" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.members.edit', $member->id_membre) }}" class="btn-action btn-edit" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.members.suspend', $member->id_membre) }}" method="POST" style="display:inline;" onsubmit="return confirm('Suspendre ce membre ?');">
                                    @csrf
                                    <button type="submit" class="btn-action btn-suspend" title="Suspendre">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <p>Aucun membre trouvé</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
