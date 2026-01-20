@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-cog"></i> Paramètres des Pénalités
                    </h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Erreurs :</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.penalties.update-settings') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <h5 class="text-muted">Configuration des tarifs</h5>
                            <hr>
                        </div>

                        <div class="mb-3">
                            <label for="daily_rate" class="form-label">
                                <strong>Taux de pénalité quotidien</strong>
                            </label>
                            <div class="input-group">
                                <input type="number" 
                                       step="0.01" 
                                       min="0" 
                                       name="daily_rate" 
                                       id="daily_rate" 
                                       class="form-control @error('daily_rate') is-invalid @enderror"
                                       value="{{ old('daily_rate', $dailyRate) }}"
                                       required>
                                <span class="input-group-text">€/jour</span>
                            </div>
                            <small class="text-muted d-block mt-2">
                                <i class="fas fa-info-circle"></i>
                                Montant facturé par jour de retard. Par défaut : 1.50 €/jour
                            </small>
                            @error('daily_rate')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <h5 class="text-muted">Blocage automatique des comptes</h5>
                            <hr>
                        </div>

                        <div class="mb-3">
                            <label for="block_threshold" class="form-label">
                                <strong>Seuil de blocage</strong>
                            </label>
                            <div class="input-group">
                                <input type="number" 
                                       step="0.01" 
                                       min="0" 
                                       name="block_threshold" 
                                       id="block_threshold" 
                                       class="form-control @error('block_threshold') is-invalid @enderror"
                                       value="{{ old('block_threshold', $blockThreshold) }}"
                                       required>
                                <span class="input-group-text">€</span>
                            </div>
                            <small class="text-muted d-block mt-2">
                                <i class="fas fa-info-circle"></i>
                                Montant total de pénalités non payées au-delà duquel un compte sera automatiquement bloqué.
                                Par défaut : 30.00 €
                            </small>
                            @error('block_threshold')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="alert alert-warning">
                            <h6 class="alert-heading">
                                <i class="fas fa-exclamation-triangle"></i> Important
                            </h6>
                            <ul class="mb-0">
                                <li>Les pénalités sont calculées automatiquement 1 jour après la date limite</li>
                                <li>Les comptes sont bloqués automatiquement quand le seuil est atteint</li>
                                <li>Les membres bloqués ne peuvent plus emprunter ou réserver</li>
                                <li>Les comptes se déverrouillent automatiquement une fois toutes les pénalités payées</li>
                            </ul>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Enregistrer les paramètres
                            </button>
                            <a href="{{ route('admin.penalties.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
