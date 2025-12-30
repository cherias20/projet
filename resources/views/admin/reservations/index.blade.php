@extends('layouts.app')

@section('title', 'Gestion des Réservations')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h1 class="page-title">
            <i class="fas fa-bookmark"></i> Gestion des Réservations
        </h1>
        <p class="page-subtitle">Gérez les réservations de livres des membres</p>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-list"></i> Liste des Réservations
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Membre</th>
                    <th>Livre</th>
                    <th>Date de réservation</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse(DB::table('reservations')->join('membres', 'reservations.id_membre', '=', 'membres.id_membre')->join('livres', 'reservations.id_livre', '=', 'livres.id_livre')->select('reservations.*', 'membres.nom as membre_nom', 'livres.titre as livre_titre')->get() as $reservation)
                    <tr>
                        <td>{{ $reservation->id_reservation }}</td>
                        <td><strong>{{ $reservation->membre_nom }}</strong></td>
                        <td>{{ $reservation->livre_titre }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y H:i') }}</td>
                        <td>
                            @if($reservation->statut === 'en_attente')
                                <span class="badge bg-warning">En attente</span>
                            @elseif($reservation->statut === 'validee')
                                <span class="badge bg-success">Validée</span>
                            @else
                                <span class="badge bg-secondary">Annulée</span>
                            @endif
                        </td>
                        <td>
                            <a href="#" class="btn btn-sm btn-primary">
                                <i class="fas fa-check"></i> Valider
                            </a>
                            <a href="#" class="btn btn-sm btn-danger">
                                <i class="fas fa-times"></i> Annuler
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="fas fa-inbox"></i> Aucune réservation trouvée
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
