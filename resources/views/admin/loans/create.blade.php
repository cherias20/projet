@extends('layouts.admin')

@section('title', 'Créer un Emprunt')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h1 class="page-title">
            <i class="fas fa-exchange-alt"></i> Créer un Emprunt
        </h1>
        <p class="page-subtitle">Enregistrer un nouvel emprunt</p>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-plus"></i> Nouvel Emprunt
            </div>
            <div class="card-body">
                <form action="{{ route('loans.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="id_membre" class="form-label">Membre <span class="text-danger">*</span></label>
                        <select class="form-select @error('id_membre') is-invalid @enderror" id="id_membre" name="id_membre" required>
                            <option value="">-- Sélectionner un membre --</option>
                            @foreach(\App\Models\Membre::all() as $membre)
                                <option value="{{ $membre->id_membre }}" {{ old('id_membre') == $membre->id_membre ? 'selected' : '' }}>
                                    {{ $membre->getFullName() }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_membre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="id_exemplaire" class="form-label">Exemplaire <span class="text-danger">*</span></label>
                        <select class="form-select @error('id_exemplaire') is-invalid @enderror" id="id_exemplaire" name="id_exemplaire" required>
                            <option value="">-- Sélectionner un exemplaire --</option>
                            @foreach(\App\Models\Exemplaire::where('disponible', true)->get() as $exemplaire)
                                <option value="{{ $exemplaire->id_exemplaire }}" {{ old('id_exemplaire') == $exemplaire->id_exemplaire ? 'selected' : '' }}>
                                    {{ $exemplaire->book->titre }} ({{ $exemplaire->numero_exemplaire }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_exemplaire')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Créer l'Emprunt
                        </button>
                        <a href="{{ route('loans.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
