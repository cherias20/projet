@extends('layouts.app')

@section('title', 'Créer un Emprunt')

@section('content')
<h1 class="mb-4"><i class="fas fa-plus-circle"></i> Créer un Emprunt</h1>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('loans.store') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="id_membre" class="form-label">Membre *</label>
                        <select class="form-select @error('id_membre') is-invalid @enderror" id="id_membre" name="id_membre" required>
                            <option value="">-- Sélectionner un membre --</option>
                            @foreach($membres as $membre)
                                <option value="{{ $membre->id_membre }}" @if(old('id_membre') == $membre->id_membre) selected @endif>
                                    {{ $membre->getFullName() }} ({{ $membre->numero_carte }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_membre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="id_exemple" class="form-label">Exemplaire *</label>
                        <select class="form-select @error('id_exemple') is-invalid @enderror" id="id_exemple" name="id_exemple" required>
                            <option value="">-- Sélectionner un exemplaire --</option>
                            @foreach($exemplaires as $exemplaire)
                                <option value="{{ $exemplaire->id_exemple }}" @if(old('id_exemple') == $exemplaire->id_exemple) selected @endif>
                                    {{ $exemplaire->book->titre }} - {{ $exemplaire->code_barre }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_exemple') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="renouvellement_max" class="form-label">Renouvellements Maximums</label>
                        <input type="number" class="form-control @error('renouvellement_max') is-invalid @enderror" id="renouvellement_max" name="renouvellement_max" min="1" max="10" value="{{ old('renouvellement_max', 3) }}">
                        @error('renouvellement_max') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Créer l'Emprunt
                        </button>
                        <a href="{{ route('loans.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
