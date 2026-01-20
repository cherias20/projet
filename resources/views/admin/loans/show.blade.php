@extends('layouts.admin')

@section('title', 'Détails de l\'Emprunt')

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

    .detail-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        color: white;
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(30, 60, 114, 0.2);
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
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--light-blue);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--light-blue);
    }

    .info-row:last-child { border-bottom: none; }

    .info-label { font-weight: 700; color: var(--primary-blue); min-width: 150px; }
    .info-value { color: var(--text-dark); font-weight: 500; }

    .badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .badge-success { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; }
    .badge-danger { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); color: white; }
    .badge-primary { background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%); color: white; }

    .action-buttons { display: flex; gap: 1rem; margin-top: 2rem; flex-wrap: wrap; }

    .btn-primary, .btn-secondary { padding: 0.75rem 1.75rem; border-radius: 8px; font-weight: 700; border: none; transition: all 0.3s ease; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; }

    .btn-primary { background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%); color: white; }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(30, 60, 114, 0.3); color: white; text-decoration: none; }

    .btn-secondary { background: var(--light-blue); color: var(--secondary-blue); }
    .btn-secondary:hover { background-color: var(--secondary-blue); color: white; text-decoration: none; }

    .btn-success { background: #66bb6a; color: white; }
    .btn-success:hover { background: #558b2f; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(102, 187, 106, 0.3); }
</style>

<h1 style="font-size: 2rem; font-weight: 800; background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
    <i class="fas fa-exchange-alt"></i> Détails de l'Emprunt
</h1>

<div class="detail-header">
    <h2 style="margin: 0; font-size: 1.5rem;">{{ $loan->exemplaire->book->titre }}</h2>
    <p style="margin: 0.5rem 0 0 0; opacity: 0.9;">Exemplaire: {{ $loan->exemplaire->code_exemplaire }}</p>
</div>

<div class="row">
    <div class="col-md-8">
        <!-- Informations de l'Emprunt -->
        <div class="info-section">
            <div class="section-title">
                <i class="fas fa-info-circle"></i> Informations Générales
            </div>
            <div class="info-row">
                <span class="info-label">Livre</span>
                <span class="info-value"><strong>{{ $loan->exemplaire->book->titre }}</strong></span>
            </div>
            <div class="info-row">
                <span class="info-label">Membre</span>
                <span class="info-value"><a href="{{ route('admin.members.show', $loan->membre) }}">{{ $loan->membre->getFullName() }}</a></span>
            </div>
            <div class="info-row">
                <span class="info-label">Date d'Emprunt</span>
                <span class="info-value">{{ $loan->date_emprunt->format('d/m/Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Date de Retour Prévue</span>
                <span class="info-value @if($loan->isOverdue()) text-danger @endif">
                    {{ $loan->date_retour_prevue->format('d/m/Y') }}
                    @if($loan->isOverdue())
                        <span class="badge badge-danger">EN RETARD</span>
                    @endif
                </span>
            </div>
            <div class="info-row">
                <span class="info-label">Statut</span>
                <span class="info-value">
                    @if($loan->statut === 'en_cours')
                        <span class="badge badge-primary">En cours</span>
                    @elseif($loan->statut === 'termine')
                        <span class="badge badge-success">Terminé</span>
                    @else
                        <span class="badge badge-danger">Annulé</span>
                    @endif
                </span>
            </div>
        </div>

        <!-- Renouvellements -->
        <div class="info-section">
            <div class="section-title">
                <i class="fas fa-sync"></i> Renouvellements
            </div>
            <div class="info-row">
                <span class="info-label">Renouvellements</span>
                <span class="info-value">{{ $loan->nombre_renouvellement }} / {{ $loan->renouvellement_max }}</span>
            </div>
            @if($loan->statut === 'en_cours' && $loan->nombre_renouvellement < $loan->renouvellement_max)
                <form action="{{ route('admin.loans.renew', $loan) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-success" style="margin-top: 1rem;">
                        <i class="fas fa-sync"></i> Renouveler
                    </button>
                </form>
            @endif
        </div>
    </div>

    <div class="col-md-4">
        <!-- Actions -->
        @if($loan->statut === 'en_cours')
            <div class="info-section">
                <div class="section-title">
                    <i class="fas fa-cog"></i> Actions
                </div>
                <form action="{{ route('admin.loans.return', $loan) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-success" style="width: 100%;">
                        <i class="fas fa-check"></i> Retourner le Livre
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>

<div class="action-buttons">
    <a href="{{ route('admin.loans.index') }}" class="btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour à la Liste
    </a>
</div>

@endsection
