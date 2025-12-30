@extends('layouts.app')

@section('title', 'Pénalités de ' . $membre->getFullName())

@section('content')
<h1 class="mb-4"><i class="fas fa-receipt"></i> Pénalités de {{ $membre->getFullName() }}</h1>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h6 class="text-muted">Total Impayé</h6>
                <h2 class="text-danger">{{ number_format($totalUnpaid, 2) }} €</h2>
            </div>
        </div>
    </div>
</div>

@if($unpaidPenalties->count() > 0)
    <div class="card mb-4">
        <div class="card-header bg-danger">
            <h5>Pénalités Non Payées</h5>
        </div>
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Montant</th>
                        <th>Raison</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($unpaidPenalties as $penalty)
                        <tr>
                            <td><strong>{{ number_format($penalty->montant, 2) }} €</strong></td>
                            <td>{{ $penalty->raison }}</td>
                            <td>{{ $penalty->date_calcul->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('penalties.show', $penalty) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

@if($paidPenalties->count() > 0)
    <div class="card">
        <div class="card-header bg-success">
            <h5>Pénalités Payées</h5>
        </div>
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Montant</th>
                        <th>Raison</th>
                        <th>Date Paiement</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paidPenalties as $penalty)
                        <tr>
                            <td><strong>{{ number_format($penalty->montant, 2) }} €</strong></td>
                            <td>{{ $penalty->raison }}</td>
                            <td>{{ $penalty->date_paiement?->format('d/m/Y') ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('penalties.show', $penalty) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $paidPenalties->links() }}
        </div>
    </div>
@endif

<div class="mt-4">
    <a href="{{ route('admin.members.show', $membre) }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour au Profil
    </a>
</div>
@endsection
