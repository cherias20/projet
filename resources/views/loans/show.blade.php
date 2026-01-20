@extends('layouts.app')

@section('title', 'Détails de l\'Emprunt')

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
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            <strong>Livre:</strong><br>
                            <a href="{{ route('books.show', $loan->exemplaire->book) }}">
                                {{ $loan->exemplaire->book->titre }}
                            </a>
                        </p>
                        <p>
                            <strong>Code Barre:</strong><br>
                            {{ $loan->exemplaire->code_barre }}
                        </p>
                        <p>
                            <strong>Membre:</strong><br>
                            {{ $loan->membre->getFullName() }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <strong>Date d'Emprunt:</strong><br>
                            {{ $loan->date_emprunt->format('d/m/Y') }}
                        </p>
                        <p>
                            <strong>Date de Retour Prévue:</strong><br>
                            <span class="@if($loan->isOverdue()) text-danger @endif">
                                {{ $loan->date_retour_prevue->format('d/m/Y') }}
                                @if($loan->isOverdue())
                                    <span class="badge bg-danger">EN RETARD</span>
                                @endif
                            </span>
                        </p>
                        <p>
                            <strong>Statut:</strong><br>
                            <span class="badge bg-{{ $loan->statut === 'en_cours' ? 'primary' : ($loan->statut === 'termine' ? 'success' : 'danger') }}">
                                {{ ucfirst(str_replace('_', ' ', $loan->statut)) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5>Renouvellements</h5>
            </div>
            <div class="card-body">
                <p>
                    <strong>Nombre de renouvellements:</strong> {{ $loan->nombre_renouvellement }}/{{ $loan->renouvellement_max }}
                </p>
                @if($loan->statut === 'en_cours')
                    @if($loan->nombre_renouvellement < $loan->renouvellement_max)
                        <form method="POST" action="{{ route('admin.loans.renew', $loan) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fas fa-sync"></i> Renouveler l'Emprunt
                            </button>
                        </form>
                    @else
                        <p class="text-danger">Nombre maximum de renouvellements atteint.</p>
                    @endif
                @endif
            </div>
        </div>

        @if($loan->statut === 'en_cours')
            <div class="card">
                <div class="card-header">
                    <h5>Actions</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.loans.return', $loan) }}">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check"></i> Retourner le Livre
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('admin.loans.index') }}" class="btn btn-secondary btn-sm w-100 mb-2">
                    <i class="fas fa-arrow-left"></i> Retour aux Emprunts
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
