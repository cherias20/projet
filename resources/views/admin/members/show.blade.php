@extends('layouts.admin')

@section('title', 'Détails du Membre')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h1 class="page-title">
            <i class="fas fa-user"></i> {{ $membre->nom }} {{ $membre->prenom }}
        </h1>
        <p class="page-subtitle">Détails complets du membre</p>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.members.edit', $membre->id_membre) }}" class="btn btn-info">
            <i class="fas fa-edit"></i> Éditer
        </a>
        <a href="{{ route('admin.members.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-info-circle"></i> Informations du Membre
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <h6 class="text-muted mb-2">Nom complet</h6>
                <p><strong>{{ $membre->nom }} {{ $membre->prenom }}</strong></p>
            </div>
            <div class="col-md-6">
                <h6 class="text-muted mb-2">Email</h6>
                <p><a href="mailto:{{ $membre->email }}">{{ $membre->email }}</a></p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <h6 class="text-muted mb-2">Téléphone</h6>
                <p>{{ $membre->telephone ?? 'N/A' }}</p>
            </div>
            <div class="col-md-6">
                <h6 class="text-muted mb-2">Numéro de carte</h6>
                <p>{{ $membre->numero_carte ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
                <h6 class="text-muted mb-2">Adresse</h6>
                <p>{{ $membre->adresse ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <h6 class="text-muted mb-2">Date d'inscription</h6>
                <p>{{ \Carbon\Carbon::parse($membre->date_inscription)->format('d/m/Y') }}</p>
            </div>
            <div class="col-md-6">
                <h6 class="text-muted mb-2">Statut</h6>
                <p>
                    @if($membre->statut === 'actif')
                        <span class="badge bg-success">Actif</span>
                    @elseif($membre->statut === 'suspendu')
                        <span class="badge bg-warning">Suspendu</span>
                    @else
                        <span class="badge bg-secondary">Inactif</span>
                    @endif
                </p>
            </div>
        </div>

        @if($membre->biographie)
        <div class="row mb-4">
            <div class="col-12">
                <h6 class="text-muted mb-2">Biographie</h6>
                <p>{{ $membre->biographie }}</p>
            </div>
        </div>
        @endif
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <i class="fas fa-history"></i> Actions
    </div>
    <div class="card-body">
        <div class="d-flex gap-2">
            @if($membre->statut === 'actif')
                <form method="POST" action="{{ route('admin.members.suspend', $membre->id_membre) }}" style="display:inline;" onsubmit="return confirm('Suspendre ce membre ?');">
                    @csrf
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-ban"></i> Suspendre
                    </button>
                </form>
            @elseif($membre->statut === 'suspendu')
                <form method="POST" action="{{ route('admin.members.activate', $membre->id_membre) }}" style="display:inline;" onsubmit="return confirm('Activer ce membre ?');">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i> Activer
                    </button>
                </form>
            @endif
            <form method="POST" action="{{ route('admin.members.destroy', $membre->id_membre) }}" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce membre?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Supprimer
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
