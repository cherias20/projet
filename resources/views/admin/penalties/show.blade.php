@extends('layouts.admin')

@section('title', 'Détails de la Pénalité')

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

    .amount-display { font-size: 1.5rem; font-weight: 800; color: #d32f2f; }

    .badge { display: inline-block; padding: 0.5rem 1rem; border-radius: 6px; font-weight: 600; font-size: 0.85rem; }
    .badge-success { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; }
    .badge-warning { background: linear-gradient(135deg, #ffa726 0%, #fb8c00 100%); color: white; }
    .badge-info { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; }

    .action-buttons { display: flex; gap: 1rem; margin-top: 2rem; flex-wrap: wrap; }

    .btn-pay, .btn-remit, .btn-back { padding: 0.75rem 1.75rem; border-radius: 8px; font-weight: 700; border: none; transition: all 0.3s ease; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; }

    .btn-pay { background: #66bb6a; color: white; }
    .btn-pay:hover { background: #558b2f; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(102, 187, 106, 0.3); }

    .btn-remit { background: #4facfe; color: white; }
    .btn-remit:hover { background: #0080ff; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(79, 172, 254, 0.3); }

    .btn-back { background: var(--light-blue); color: var(--secondary-blue); }
    .btn-back:hover { background-color: var(--secondary-blue); color: white; text-decoration: none; }

    .modal-header { background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%); color: white; }
    .modal-header .btn-close { filter: brightness(0) invert(1); }
    .form-label { color: var(--primary-blue); font-weight: 700; }
</style>

<h1 style="font-size: 2rem; font-weight: 800; background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 2rem;">
    <i class="fas fa-receipt"></i> Détails de la Pénalité
</h1>

<div class="detail-header">
    <h2>Pénalité de <span style="font-size: 1.3rem;">{{ number_format($penalty->montant, 2) }} €</span></h2>
    <p style="margin: 0.5rem 0 0 0; opacity: 0.9;">Membre: {{ $penalty->membre->getFullName() }}</p>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="info-section">
            <div class="section-title">
                <i class="fas fa-info-circle"></i> Informations Générales
            </div>
            <div class="info-row">
                <span class="info-label">Montant</span>
                <span class="info-value"><span class="amount-display">{{ number_format($penalty->montant, 2) }} €</span></span>
            </div>
            <div class="info-row">
                <span class="info-label">Raison</span>
                <span class="info-value">{{ $penalty->raison }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Membre</span>
                <span class="info-value"><a href="{{ route('admin.members.show', $penalty->membre) }}">{{ $penalty->membre->getFullName() }}</a></span>
            </div>
            <div class="info-row">
                <span class="info-label">Emprunt Associé</span>
                <span class="info-value"><a href="{{ route('admin.loans.show', $penalty->loan) }}">{{ $penalty->loan->exemplaire->book->titre }}</a></span>
            </div>
            <div class="info-row">
                <span class="info-label">Date de Calcul</span>
                <span class="info-value">{{ $penalty->date_calcul->format('d/m/Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Statut</span>
                <span class="info-value">
                    @if($penalty->statut === 'payee')
                        <span class="badge badge-success">Payée</span>
                    @elseif($penalty->statut === 'remise')
                        <span class="badge badge-info">Remise</span>
                    @else
                        <span class="badge badge-warning">Non Payée</span>
                    @endif
                </span>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        @if($penalty->statut === 'non_payee')
            <div class="info-section">
                <div class="section-title">
                    <i class="fas fa-cog"></i> Actions
                </div>
                <form action="{{ route('admin.penalties.pay', $penalty) }}" method="POST" style="margin-bottom: 1rem;">
                    @csrf
                    <button type="submit" class="btn-pay" style="width: 100%;">
                        <i class="fas fa-check"></i> Marquer comme Payée
                    </button>
                </form>
                <button type="button" class="btn-remit" style="width: 100%; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#remitModal">
                    <i class="fas fa-gift"></i> Remettre
                </button>
            </div>
        @else
            <div class="info-section">
                <p class="text-muted"><i class="fas fa-info-circle"></i> Aucune action disponible.</p>
            </div>
        @endif
    </div>
</div>

<div class="action-buttons">
    <a href="{{ route('admin.penalties.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Retour à la Liste
    </a>
</div>

<!-- Modal pour remise de pénalité -->
<div class="modal fade" id="remitModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-gift"></i> Remettre la Pénalité</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.penalties.remit', $penalty) }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="reason" class="form-label">Motif de la Remise <span style="color: #d32f2f;">*</span></label>
                        <textarea id="reason" name="reason" class="form-control" rows="4" placeholder="Expliquez pourquoi cette pénalité est remise..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn-remit">
                        <i class="fas fa-check"></i> Confirmer la Remise
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
