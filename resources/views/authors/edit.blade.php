@extends('layouts.app')

@section('title', 'Éditer - ' . $author->nom)

@section('content')
<h1 class="mb-4"><i class="fas fa-edit"></i> Éditer l'Auteur</h1>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.authors.update', $author) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom *</label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom', $author->nom) }}" required>
                        @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="biographie" class="form-label">Biographie</label>
                        <textarea class="form-control @error('biographie') is-invalid @enderror" id="biographie" name="biographie" rows="5">{{ old('biographie', $author->biographie) }}</textarea>
                        @error('biographie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Enregistrer
                        </button>
                        <a href="{{ route('authors.show', $author) }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
