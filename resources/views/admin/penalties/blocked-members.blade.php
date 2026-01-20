@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-ban"></i> Comptes Bloqués
                    </h4>
                    <span class="badge bg-light text-danger">{{ $members->total() }} compte(s)</span>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($members->isEmpty())
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Aucun compte bloqué actuellement.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Nom du Membre</th>
                                        <th>Email</th>
                                        <th>Pénalités Non Payées</th>
                                        <th>Montant Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($members as $member)
                                        <tr>
                                            <td>{{ $member->id_membre }}</td>
                                            <td>
                                                <strong>{{ $member->prenom }} {{ $member->nom }}</strong>
                                            </td>
                                            <td>
                                                <a href="mailto:{{ $member->email }}">{{ $member->email }}</a>
                                            </td>
                                            <td>
                                                <span class="badge bg-danger">
                                                    {{ $member->penalites()->where('statut', 'non_payee')->count() }}
                                                </span>
                                            </td>
                                            <td>
                                                <strong class="text-danger">
                                                    {{ number_format($member->penalites()->where('statut', 'non_payee')->sum('montant'), 2, ',', ' ') }} €
                                                </strong>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('admin.members.show', $member) }}" 
                                                       class="btn btn-info"
                                                       title="Voir le profil">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('penalties.member', $member) }}" 
                                                       class="btn btn-warning"
                                                       title="Voir les pénalités">
                                                        <i class="fas fa-receipt"></i> Pénalités
                                                    </a>
                                                    <form action="{{ route('admin.penalties.unblock', $member) }}" 
                                                          method="POST"
                                                          style="display:inline;">
                                                        @csrf
                                                        <button type="submit" 
                                                                class="btn btn-success"
                                                                title="Débloquer le compte"
                                                                onclick="return confirm('Débloquer ce compte ?')">
                                                            <i class="fas fa-unlock"></i> Débloquer
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <nav>
                            {{ $members->links('pagination::bootstrap-5') }}
                        </nav>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('admin.penalties.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Retour aux pénalités
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
