@extends('layouts.app')

@section('title', 'Détails Pénalité')

@section('content')
<h1 class="mb-4"><i class="fas fa-receipt"></i> Détails de la Pénalité</h1>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Informations de la Pénalité</h5>
            </div>
            <div class="card-body">
                <p>
                    <strong>Montant:</strong> <span class="h4 text-danger">{{ number_format($penalty->montant, 2) }} €</span><br>
                    <strong>Raison:</strong> {{ $penalty->raison }}<br>
                    <strong>Date de calcul:</strong> {{ $penalty->date_calcul->format('d/m/Y H:i') }}<br>
                    @if($penalty->date_paiement)
                        <strong>Date de paiement:</strong> {{ $penalty->date_paiement->format('d/m/Y') }}
                    @endif
                </p>
                
                <hr>
                
                <p>
                    <strong>Statut:</strong>
                    <span class="badge bg-{{ $penalty->statut === 'payee' ? 'success' : ($penalty->statut === 'remise' ? 'info' : 'warning') }} style="padding: 10px; font-size: 1rem;">
                        {{ ucfirst($penalty->statut) }}
                    </span>
                </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Membre</h5>
            </div>
            <div class="card-body">
                <p>
                    <strong>{{ $penalty->membre->getFullName() }}</strong><br>
                    <small class="text-muted">{{ $penalty->membre->email }}</small>
                </p>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header">
                <h5>Emprunt Associé</h5>
            </div>
            <div class="card-body">
                <p>
                    <strong>Livre:</strong> {{ $penalty->loan->exemplaire->book->titre }}<br>
                    <strong>Emprunt du:</strong> {{ $penalty->loan->date_emprunt->format('d/m/Y') }}<br>
                    <strong>Retour prévu:</strong> {{ $penalty->loan->date_retour_prevue->format('d/m/Y') }}
                </p>
            </div>
        </div>
        
        @if($penalty->statut !== 'payee' && $penalty->statut !== 'remise')
            <div class="card">
                <div class="card-header">
                    <h5>Actions</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('penalties.pay', $penalty) }}" class="mb-2">
                        @csrf
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-money-bill"></i> Marquer comme Payée
                        </button>
                    </form>
                    
                    <button class="btn btn-info w-100" data-bs-toggle="modal" data-bs-target="#remitModal">
                        <i class="fas fa-check"></i> Remettre
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Modal pour remise -->
<div class="modal fade" id="remitModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Remettre la Pénalité</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('penalties.remit', $penalty) }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="reason" class="form-label">Motif de la remise</label>
                        <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Remettre</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('penalties.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour aux Pénalités
    </a>
</div>
@endsection
