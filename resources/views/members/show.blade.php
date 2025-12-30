@extends('layouts.app')

@section('title', $membre->getFullName())

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h1><i class="fas fa-user"></i> {{ $membre->getFullName() }}</h1>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('admin.members.edit', $membre) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Éditer
        </a>
        @if($membre->getActiveLoansCount() === 0)
            <form method="POST" action="{{ route('admin.members.destroy', $membre) }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr?')">
                    <i class="fas fa-trash"></i> Supprimer
                </button>
            </form>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Informations Personnelles</h5>
            </div>
            <div class="card-body">
                <p>
                    <strong>Prénom:</strong> {{ $membre->prenom }}<br>
                    <strong>Nom:</strong> {{ $membre->nom }}<br>
                    <strong>Email:</strong> {{ $membre->email }}<br>
                    <strong>Adresse:</strong> {{ $membre->adresse }}<br>
                    <strong>Téléphone:</strong> {{ $membre->telephone }}
                </p>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header">
                <h5>Emprunts Actifs</h5>
            </div>
            <div class="card-body">
                @if($activeLoans->count() > 0)
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Livre</th>
                                <th>Date Retour</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activeLoans as $loan)
                                <tr>
                                    <td>{{ $loan->exemplaire->book->titre }}</td>
                                    <td>
                                        {{ $loan->date_retour_prevue->format('d/m/Y') }}
                                        @if($loan->isOverdue())
                                            <br><span class="badge bg-danger">EN RETARD</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('loans.show', $loan) }}" class="btn btn-sm btn-primary">Voir</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">Aucun emprunt actif</p>
                @endif
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h5>Historique des Emprunts</h5>
            </div>
            <div class="card-body">
                @if($pastLoans->count() > 0)
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Livre</th>
                                <th>Retour</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pastLoans as $loan)
                                <tr>
                                    <td>{{ $loan->exemplaire->book->titre }}</td>
                                    <td>{{ $loan->date_retour?->format('d/m/Y') ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $loan->statut === 'retard' ? 'danger' : 'success' }}">
                                            {{ ucfirst(str_replace('_', ' ', $loan->statut)) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $pastLoans->links() }}
                @else
                    <p class="text-muted">Aucun historique</p>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Informations du Compte</h5>
            </div>
            <div class="card-body">
                <p>
                    <strong>Numéro de carte:</strong> {{ $membre->numero_carte }}<br>
                    <strong>Rôle:</strong> 
                    <span class="badge bg-{{ $membre->role === 'admin' ? 'danger' : 'secondary' }}">
                        {{ ucfirst($membre->role) }}
                    </span>
                </p>
                <p>
                    <strong>Statut:</strong>
                    <span class="badge bg-{{ $membre->statut === 'actif' ? 'success' : 'warning' }}">
                        {{ ucfirst($membre->statut) }}
                    </span>
                </p>
                <p>
                    <strong>Note:</strong> {{ $membre->note ?? 'N/A' }}/5<br>
                    <strong>Inscription:</strong> {{ $membre->date_inscription->format('d/m/Y') }}
                </p>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header">
                <h5>Statistiques</h5>
            </div>
            <div class="card-body">
                <p>
                    <strong>Emprunts actifs:</strong>
                    <span class="badge bg-info">{{ $membre->getActiveLoansCount() }}</span><br>
                    <strong>Réservations:</strong>
                    <span class="badge bg-info">{{ $reservations->count() }}</span><br>
                    <strong>Pénalités impayées:</strong>
                    <span class="badge bg-danger">{{ $penalites->count() }}</span>
                </p>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h5>Actions</h5>
            </div>
            <div class="card-body">
                @if($membre->statut === 'actif')
                    <form method="POST" action="{{ route('admin.members.suspend', $membre) }}">
                        @csrf
                        <button type="submit" class="btn btn-warning w-100">
                            <i class="fas fa-ban"></i> Suspendre
                        </button>
                    </form>
                @else
                    <form method="POST" action="{{ route('admin.members.activate', $membre) }}">
                        @csrf
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-check"></i> Activer
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('admin.members.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour aux Membres
    </a>
</div>
@endsection
