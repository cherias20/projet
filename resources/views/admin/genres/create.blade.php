@extends('layouts.admin')

@section('title', 'Créer un Genre')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h1 class="page-title">
            <i class="fas fa-tag"></i> Créer un Genre
        </h1>
        <p class="page-subtitle">Ajouter un nouveau genre de livre</p>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-plus"></i> Nouveau Genre
            </div>
            <div class="card-body">
                <form action="{{ route('admin.genres.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom du Genre <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required>
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Créer le Genre
                        </button>
                        <a href="{{ route('admin.genres.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
