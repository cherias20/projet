@extends('layouts.admin')

@section('title', 'Gestion des Membres')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h1 class="page-title">
            <i class="fas fa-users"></i> Gestion des Membres
        </h1>
        <p class="page-subtitle">Gérez les comptes des membres de la bibliothèque</p>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-list"></i> Liste des Membres
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Rechercher un membre...">
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">Tous les statuts</option>
                    <option value="actif">Actif</option>
                    <option value="suspendu">Suspendu</option>
                    <option value="inactif">Inactif</option>
                </select>
            </div>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Statut</th>
                    <th>Date d'inscription</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse(DB::table('membres')->get() as $member)
                    <tr>
                        <td>{{ $member->id_membre }}</td>
                        <td><strong>{{ $member->nom }} {{ $member->prenom }}</strong></td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->telephone ?? 'N/A' }}</td>
                        <td>
                            @if($member->statut === 'actif')
                                <span class="badge bg-success">Actif</span>
                            @elseif($member->statut === 'suspendu')
                                <span class="badge bg-warning">Suspendu</span>
                            @else
                                <span class="badge bg-secondary">Inactif</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($member->date_inscription)->format('d/m/Y') }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i> Voir
                            </a>
                            <a href="#" class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-danger">
                                <i class="fas fa-ban"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="fas fa-inbox"></i> Aucun membre trouvé
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
