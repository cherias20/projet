@extends('layouts.app')

@section('title', 'Créer une Réservation')

@section('content')
<h1 class="mb-4"><i class="fas fa-plus-circle"></i> Créer une Réservation</h1>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('reservations.store') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="id_membre" class="form-label">Membre *</label>
                        <select class="form-select @error('id_membre') is-invalid @enderror" id="id_membre" name="id_membre" required>
                            <option value="">-- Sélectionner un membre --</option>
                            @foreach($membres as $membre)
                                <option value="{{ $membre->id_membre }}" @if(old('id_membre') == $membre->id_membre) selected @endif>
                                    {{ $membre->getFullName() }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_membre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="id_livre" class="form-label">Livre *</label>
                        <select class="form-select @error('id_livre') is-invalid @enderror" id="id_livre" name="id_livre" required>
                            <option value="">-- Sélectionner un livre --</option>
                            @foreach($books as $book)
                                <option value="{{ $book->id_livre }}" @if(old('id_livre') == $book->id_livre) selected @endif>
                                    {{ $book->titre }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_livre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Créer la Réservation
                        </button>
                        <a href="{{ route('reservations.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
