@extends('layouts.app')

@section('title', 'Détails Emprunt')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1><i class="fas fa-exchange-alt"></i> Détails de l'Emprunt</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Informations de l'Emprunt</h5>
            </div>
            <div class="card-body">
                <p>
                    <strong>Livre:</strong> {{ $loan->exemplaire->book->titre }}<br>
                    <strong>Code-barre exemplaire:</strong> {{ $loan->exemplaire->code_barre }}<br>
                    <strong>Membre:</strong> {{ $loan->membre->getFullName() }}
                </p>
                
                <hr>
                
                <p>
                    <strong>Date d'emprunt:</strong> {{ $loan->date_emprunt->format('d/m/Y H:i') }}<br>
                    <strong>Date de retour prévue:</strong> {{ $loan->date_retour_prevue->format('d/m/Y') }}<br>
                    @if($loan->date_retour)
                        <strong>Date de retour effectif:</strong> {{ $loan->date_retour->format('d/m/Y') }}
                    @endif
                </p>
                
                <hr>
                
                <p>
                    <strong>Statut:</strong>
                    <span class="badge badge-status status-{{ $loan->statut }}">
                        {{ ucfirst(str_replace('_', ' ', $loan->statut)) }}
                    </span>
                </p>
                
                @if($loan->isOverdue())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i> <strong>Retard détecté!</strong><br>
                        Nombre de jours de retard: <strong>{{ $loan->getDaysOverdue() }} jour(s)</strong>
                    </div>
                @endif
                
                <p>
                    <strong>Renouvellements:</strong> {{ $loan->nombre_renouvellement }}/{{ $loan->renouvellement_max }}<br>
                    @if($loan->date_dernier_renouvellement)
                        <strong>Dernier renouvellement:</strong> {{ $loan->date_dernier_renouvellement->format('d/m/Y') }}
                    @endif
                </p>
            </div>
        </div>
        
        @if($loan->penalites->count() > 0)
            <div class="card mb-4">
                <div class="card-header bg-danger">
                    <h5>Pénalités Associées</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Montant</th>
                                <th>Raison</th>
                                <th>Statut</th>
                                <th>Date Calcul</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loan->penalites as $penalty)
                                <tr>
                                    <td><strong>{{ number_format($penalty->montant, 2) }} €</strong></td>
                                    <td>{{ $penalty->raison }}</td>
                                    <td>
                                        <span class="badge bg-{{ $penalty->statut === 'payee' ? 'success' : 'warning' }}">
                                            {{ ucfirst($penalty->statut) }}
                                        </span>
                                    </td>
                                    <td>{{ $penalty->date_calcul->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
    
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Actions</h5>
            </div>
            <div class="card-body">
                @if($loan->statut === 'en_cours')
                    @if($loan->canRenew())
                        <form method="POST" action="{{ route('loans.renew', $loan) }}" class="mb-2">
                            @csrf
                            <button type="submit" class="btn btn-info w-100">
                                <i class="fas fa-sync"></i> Renouveler l'Emprunt
                            </button>
                        </form>
                    @endif
                    
                    <form method="POST" action="{{ route('loans.return', $loan) }}">
                        @csrf
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-check-circle"></i> Retourner le Livre
                        </button>
                    </form>
                @else
                    <div class="alert alert-info">
                        Cet emprunt est clôturé
                    </div>
                @endif
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h5>Membre</h5>
            </div>
            <div class="card-body">
                <p>
                    <strong>{{ $loan->membre->getFullName() }}</strong><br>
                    <small class="text-muted">{{ $loan->membre->email }}</small>
                </p>
                <p>
                    <strong>Carte:</strong> {{ $loan->membre->numero_carte }}<br>
                    <strong>Statut:</strong> 
                    <span class="badge bg-{{ $loan->membre->statut === 'actif' ? 'success' : 'warning' }}">
                        {{ ucfirst($loan->membre->statut) }}
                    </span>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('loans.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour aux Emprunts
    </a>
</div>
@endsection
