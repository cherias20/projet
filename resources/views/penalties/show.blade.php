@extends('layouts.app')

@section('title', 'Détails de la Pénalité')

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
                    </div>
                    <div class="col-md-6">
                        <p>
                            <strong>Emprunt:</strong><br>
                            <a href="{{ route('loans.show', $penalty->loan) }}">
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

        @if($penalty->statut === 'non_payee')
            <div class="card">
                <div class="card-header">
                    <h5>Action de Paiement</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('penalties.pay', $penalty) }}">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-credit-card"></i> Payer la Pénalité
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('penalties.index') }}" class="btn btn-secondary btn-sm w-100 mb-2">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
