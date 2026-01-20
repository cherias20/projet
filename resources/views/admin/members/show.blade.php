@extends('layouts.admin')

@section('title', 'Détails du Membre')

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
        margin-top: 0.5rem;
    }

    .detail-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        color: white;
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(30, 60, 114, 0.2);
    }

    .detail-header h2 {
        font-size: 1.8rem;
        font-weight: 800;
        margin: 0;
        margin-bottom: 0.5rem;
    }

    .detail-header p {
        margin: 0.25rem 0;
        opacity: 0.9;
        font-size: 0.95rem;
    }

    .info-section {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid var(--border-color);
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary-blue);
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--light-blue);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        font-size: 1.3rem;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--light-blue);
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 700;
        color: var(--primary-blue);
        min-width: 150px;
    }

    .info-value {
        color: var(--text-dark);
        font-weight: 500;
    }

    .badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.85rem;
        white-space: nowrap;
    }

    .badge-status-actif {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        color: white;
    }

    .badge-status-suspendu {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        color: white;
    }

    .badge-status-inactif {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .btn-edit, .btn-back {
        padding: 0.75rem 1.75rem;
        border-radius: 8px;
        font-weight: 700;
        border: none;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-edit {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        color: white;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(30, 60, 114, 0.3);
        color: white;
        text-decoration: none;
    }

    .btn-back {
        background: var(--light-blue);
        color: var(--secondary-blue);
    }

    .btn-back:hover {
        background-color: var(--secondary-blue);
        color: white;
        text-decoration: none;
    }

    .btn-suspend {
        background: #ffa726;
        color: white;
        padding: 0.75rem 1.75rem;
        border-radius: 8px;
        font-weight: 700;
        border: none;
        transition: all 0.3s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-suspend:hover {
        background: #f57c00;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 167, 38, 0.3);
    }

    .btn-activate {
        background: #66bb6a;
        color: white;
        padding: 0.75rem 1.75rem;
        border-radius: 8px;
        font-weight: 700;
        border: none;
        transition: all 0.3s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-activate:hover {
        background: #558b2f;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 187, 106, 0.3);
    }

    .stat-card {
        background: var(--light-blue);
        border-left: 4px solid var(--secondary-blue);
        padding: 1.5rem;
        border-radius: 8px;
        text-align: center;
        margin-bottom: 1rem;
    }

    .stat-number {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--primary-blue);
    }

    .stat-label {
        color: var(--text-light);
        font-size: 0.9rem;
        font-weight: 600;
        margin-top: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>

<div class="page-header">
    <h1><i class="fas fa-user"></i> Détails du Membre</h1>
    <p class="page-subtitle">Consultez toutes les informations de ce membre</p>
</div>

<div class="detail-header">
    <h2>{{ $membre->nom }} {{ $membre->prenom }}</h2>
    <p><i class="fas fa-envelope"></i> {{ $membre->email }}</p>
    <p><i class="fas fa-phone"></i> {{ $membre->telephone ?? 'N/A' }}</p>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-number">{{ $membre->emprunts->count() }}</div>
            <div class="stat-label">Emprunts</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $membre->reservations->count() }}</div>
            <div class="stat-label">Réservations</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $membre->penalites->count() }}</div>
            <div class="stat-label">Pénalités</div>
        </div>
    </div>

    <div class="col-md-9">
        <!-- Informations Personnelles -->
        <div class="info-section">
            <div class="section-title">
                <i class="fas fa-id-card"></i> Informations Personnelles
            </div>
            <div class="info-row">
                <span class="info-label">Nom Complet</span>
                <span class="info-value">{{ $membre->nom }} {{ $membre->prenom }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Email</span>
                <span class="info-value"><a href="mailto:{{ $membre->email }}">{{ $membre->email }}</a></span>
            </div>
            <div class="info-row">
                <span class="info-label">Téléphone</span>
                <span class="info-value">{{ $membre->telephone ?? 'N/A' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Adresse</span>
                <span class="info-value">{{ $membre->adresse ?? 'N/A' }}</span>
            </div>
        </div>

        <!-- Informations d'Adhésion -->
        <div class="info-section">
            <div class="section-title">
                <i class="fas fa-ticket-alt"></i> Informations d'Adhésion
            </div>
            <div class="info-row">
                <span class="info-label">Numéro de Carte</span>
                <span class="info-value"><strong>{{ $membre->numero_carte ?? 'N/A' }}</strong></span>
            </div>
            <div class="info-row">
                <span class="info-label">Date d'Inscription</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($membre->date_inscription)->format('d/m/Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Statut</span>
                <span class="info-value">
                    @if($membre->statut === 'actif')
                        <span class="badge badge-status-actif">Actif</span>
                    @elseif($membre->statut === 'suspendu')
                        <span class="badge badge-status-suspendu">Suspendu</span>
                    @else
                        <span class="badge badge-status-inactif">Inactif</span>
                    @endif
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Boutons d'Actions -->
<div class="action-buttons">
    <a href="{{ route('admin.members.edit', $membre) }}" class="btn-edit">
        <i class="fas fa-edit"></i> Éditer
    </a>
    @if($membre->statut === 'actif')
        <form action="{{ route('admin.members.suspend', $membre) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr?');">
            @csrf
            <button type="submit" class="btn-suspend">
                <i class="fas fa-ban"></i> Suspendre
            </button>
        </form>
    @elseif($membre->statut === 'suspendu')
        <form action="{{ route('admin.members.activate', $membre) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr?');">
            @csrf
            <button type="submit" class="btn-activate">
                <i class="fas fa-check-circle"></i> Activer
            </button>
        </form>
    @endif
    <a href="{{ route('admin.members.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Retour à la Liste
    </a>
</div>

@endsection
