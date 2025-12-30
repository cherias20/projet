@extends('layouts.app')

@section('title', 'Statistiques des Pénalités')

@section('content')
<h1 class="mb-4"><i class="fas fa-chart-bar"></i> Statistiques des Pénalités</h1>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="text-muted">Total Pénalités</h6>
                <h2 class="text-primary">{{ $stats['total_penalties'] }}</h2>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="text-muted">Montant Total</h6>
                <h2 class="text-danger">{{ number_format($stats['total_amount'], 2) }} €</h2>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="text-muted">Impayées</h6>
                <h2 class="text-warning">{{ number_format($stats['unpaid_amount'], 2) }} €</h2>
                <small class="text-muted">({{ $stats['unpaid_count'] }} pénalités)</small>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h6 class="text-muted">Payées</h6>
                <h2 class="text-success">{{ number_format($stats['paid_amount'], 2) }} €</h2>
                <small class="text-muted">({{ $stats['paid_count'] }} pénalités)</small>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>Détails</h5>
    </div>
    <div class="card-body">
        <table class="table">
            <tr>
                <td><strong>Taux de paiement:</strong></td>
                <td>
                    @if($stats['total_penalties'] > 0)
                        {{ round(($stats['paid_count'] / $stats['total_penalties']) * 100, 1) }}%
                    @else
                        N/A
                    @endif
                </td>
            </tr>
            <tr>
                <td><strong>Montant moyen par pénalité:</strong></td>
                <td>
                    @if($stats['total_penalties'] > 0)
                        {{ number_format($stats['total_amount'] / $stats['total_penalties'], 2) }} €
                    @else
                        N/A
                    @endif
                </td>
            </tr>
            <tr>
                <td><strong>Montant moyen des pénalités impayées:</strong></td>
                <td>
                    @if($stats['unpaid_count'] > 0)
                        {{ number_format($stats['unpaid_amount'] / $stats['unpaid_count'], 2) }} €
                    @else
                        N/A
                    @endif
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('penalties.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour aux Pénalités
    </a>
</div>
@endsection
