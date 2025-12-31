@extends('layouts.admin')

@section('title', 'Éditer un Auteur')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h1 class="page-title">
            <i class="fas fa-pen-fancy"></i> Éditer un Auteur
        </h1>
        <p class="page-subtitle">Modifier les informations de l'auteur</p>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-edit"></i> {{ $author->nom }}
            </div>
            <div class="card-body">
                <form action="{{ route('admin.authors.update', $author) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom', $author->nom) }}" required>
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="biographie" class="form-label">Biographie</label>
                        <textarea class="form-control @error('biographie') is-invalid @enderror" id="biographie" name="biographie" rows="5">{{ old('biographie', $author->biographie) }}</textarea>
                        @error('biographie')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Mettre à jour
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
