@extends('layouts.admin')

@section('title', 'Créer un Auteur')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h1 class="page-title">
            <i class="fas fa-pen-fancy"></i> Créer un Auteur
        </h1>
        <p class="page-subtitle">Ajouter un nouveau auteur à la bibliothèque</p>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-plus"></i> Nouvel Auteur
            </div>
            <div class="card-body">
                <form action="{{ route('admin.authors.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required>
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="biographie" class="form-label">Biographie</label>
                        <textarea class="form-control @error('biographie') is-invalid @enderror" id="biographie" name="biographie" rows="5">{{ old('biographie') }}</textarea>
                        @error('biographie')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Créer l'Auteur
                        </button>
                        <a href="{{ route('admin.authors.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
