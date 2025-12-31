@extends('layouts.app')

@section('title', 'Détails de la Pénalité - Admin')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1><i class="fas fa-receipt"></i> Détails de la Pénalité</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Informations de la Pénalité</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            <strong>Montant:</strong><br>
                            <span class="h5">{{ number_format($penalty->montant, 2) }} €</span>
                        </p>
                        <p>
                            <strong>Raison:</strong><br>
                            {{ $penalty->raison }}
                        </p>
                        <p>
                            <strong>Membre:</strong><br>
                            <a href="{{ route('admin.members.show', $penalty->membre) }}">
                                {{ $penalty->membre->getFullName() }}
                            </a>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <strong>Emprunt:</strong><br>
                            <a href="{{ route('admin.loans.show', $penalty->loan) }}">
                                {{ $penalty->loan->exemplaire->book->titre }}
                            </a>
                        </p>
                        <p>
                            <strong>Date de Calcul:</strong><br>
                            {{ $penalty->date_calcul->format('d/m/Y') }}
                        </p>
                        <p>
                            <strong>Statut:</strong><br>
                            <span class="badge bg-{{ $penalty->statut === 'payee' ? 'success' : ($penalty->statut === 'remise' ? 'info' : 'warning') }}">
                                {{ ucfirst($penalty->statut) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Actions</h5>
            </div>
            <div class="card-body">
                @if($penalty->statut === 'non_payee')
                    <form method="POST" action="{{ route('penalties.pay', $penalty) }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check"></i> Marquer comme Payée
                        </button>
                    </form>

                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#remitModal">
                        <i class="fas fa-gift"></i> Remettre la Pénalité
                    </button>
                @else
                    <p class="text-muted">Aucune action disponible pour cette pénalité.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('admin.penalties.index') }}" class="btn btn-secondary btn-sm w-100 mb-2">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour remise de pénalité -->
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
                        <label for="reason" class="form-label">Motif de la Remise</label>
                        <textarea id="reason" name="reason" class="form-control" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i> Confirmer la Remise
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
