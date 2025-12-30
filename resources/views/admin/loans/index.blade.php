@extends('layouts.app')

@section('title', 'Gestion des Emprunts')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h1 class="page-title">
            <i class="fas fa-exchange-alt"></i> Gestion des Emprunts
        </h1>
        <p class="page-subtitle">Suivez les emprunts des livres par les membres</p>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="fas fa-list"></i> Liste des Emprunts
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-3">
                <select class="form-select" id="statusFilter">
                    <option value="">Tous les statuts</option>
                    <option value="en_cours">En cours</option>
                    <option value="retourne">Retourné</option>
                    <option value="retard">En retard</option>
                </select>
            </div>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Membre</th>
                    <th>Livre</th>
                    <th>Date d'emprunt</th>
                    <th>Date de retour prévue</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse(DB::table('emprunts')->join('membres', 'emprunts.id_membre', '=', 'membres.id_membre')->join('livres', 'emprunts.id_livre', '=', 'livres.id_livre')->select('emprunts.*', 'membres.nom as membre_nom', 'livres.titre as livre_titre')->get() as $loan)
                    <tr>
                        <td>{{ $loan->id_emprunt }}</td>
                        <td><strong>{{ $loan->membre_nom }}</strong></td>
                        <td>{{ $loan->livre_titre }}</td>
                        <td>{{ \Carbon\Carbon::parse($loan->date_emprunt)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($loan->date_retour_prevue)->format('d/m/Y') }}</td>
                        <td>
                            @if($loan->statut === 'en_cours')
                                <span class="badge bg-warning">En cours</span>
                            @elseif($loan->statut === 'retourne')
                                <span class="badge bg-success">Retourné</span>
                            @else
                                <span class="badge bg-danger">En retard</span>
                            @endif
                        </td>
                        <td>
                            <a href="#" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="fas fa-inbox"></i> Aucun emprunt trouvé
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
