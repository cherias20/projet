@extends('layouts.admin')

@section('title', 'Créer une Réservation')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h1 class="page-title">
            <i class="fas fa-bookmark"></i> Créer une Réservation
        </h1>
        <p class="page-subtitle">Enregistrer une nouvelle réservation</p>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-plus"></i> Nouvelle Réservation
            </div>
            <div class="card-body">
                <form action="{{ route('reservations.store') }}" method="POST">
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
                        <label for="id_livre" class="form-label">Livre <span class="text-danger">*</span></label>
                        <select class="form-select @error('id_livre') is-invalid @enderror" id="id_livre" name="id_livre" required>
                            <option value="">-- Sélectionner un livre --</option>
                            @foreach(\App\Models\Book::all() as $book)
                                <option value="{{ $book->id_livre }}" {{ old('id_livre') == $book->id_livre ? 'selected' : '' }}>
                                    {{ $book->titre }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_livre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Créer la Réservation
                        </button>
                        <a href="{{ route('reservations.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
