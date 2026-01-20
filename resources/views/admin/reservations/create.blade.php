@extends('layouts.admin')

@section('title', 'Créer une Réservation')

@section('content')
<style>
    :root {
        --primary-blue: #1e3c72;
        --secondary-blue: #2a5298;
        --light-blue: #f0f4f8;
        --text-dark: #2d3436;
        --text-light: #636e72;
        --border-color: #e0e6ed;
    }

    .page-header { margin-bottom: 2rem; }
    .page-header h1 { font-size: 2rem; font-weight: 800; background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin: 0; }
    .page-header .page-subtitle { color: var(--text-light); font-size: 0.95rem; margin-top: 0.5rem; }

    .form-container { background: white; border-radius: 12px; padding: 2rem; border: 1px solid var(--border-color); box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05); }

    .form-section-title { font-size: 1.1rem; font-weight: 700; color: var(--primary-blue); margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 2px solid var(--light-blue); display: flex; align-items: center; gap: 10px; }

    .form-label { color: var(--primary-blue); font-weight: 700; margin-bottom: 0.5rem; font-size: 0.95rem; }

    .form-control, .form-select { border: 2px solid var(--border-color); border-radius: 8px; padding: 0.75rem 1rem; transition: all 0.3s ease; font-weight: 500; }
    .form-control:focus, .form-select:focus { border-color: var(--secondary-blue); box-shadow: 0 0 0 0.2rem rgba(42, 82, 152, 0.1); }

    .button-group { display: flex; gap: 1rem; margin-top: 2rem; }

    .btn-submit { background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%); color: white; border: none; padding: 0.75rem 2rem; border-radius: 8px; font-weight: 700; transition: all 0.3s ease; cursor: pointer; }
    .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(30, 60, 114, 0.3); color: white; }

    .btn-back { background: var(--light-blue); color: var(--secondary-blue); border: none; padding: 0.75rem 2rem; border-radius: 8px; font-weight: 700; transition: all 0.3s ease; cursor: pointer; text-decoration: none; }
    .btn-back:hover { background-color: var(--secondary-blue); color: white; }

    .is-invalid { border-color: #d32f2f !important; }
    .invalid-feedback { color: #d32f2f; font-weight: 600; font-size: 0.85rem; margin-top: 0.25rem; }
</style>

<div class="page-header">
    <h1><i class="fas fa-bookmark"></i> Créer une Réservation</h1>
    <p class="page-subtitle">Enregistrer une nouvelle réservation de livre</p>
</div>

<div class="form-container">
    <form action="{{ route('admin.reservations.store') }}" method="POST">
        @csrf

        <div class="form-section-title">
            <i class="fas fa-plus-circle"></i> Informations de la Réservation
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="id_membre" class="form-label">Sélectionner un Membre <span style="color: #d32f2f;">*</span></label>
                    <select class="form-select @error('id_membre') is-invalid @enderror" id="id_membre" name="id_membre" required>
                        <option value="">-- Choisir un membre --</option>
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
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="id_livre" class="form-label">Sélectionner un Livre <span style="color: #d32f2f;">*</span></label>
                    <select class="form-select @error('id_livre') is-invalid @enderror" id="id_livre" name="id_livre" required>
                        <option value="">-- Choisir un livre --</option>
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
            </div>
        </div>

        <div class="button-group">
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Créer la Réservation
            </button>
            <a href="{{ route('admin.reservations.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Retour à la Liste
            </a>
        </div>
    </form>
</div>

@endsection
