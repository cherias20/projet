@extends('layouts.app')

@section('title', 'Créer une Réservation')

@section('content')
<style>
    .create-header {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 15px 40px rgba(30, 60, 114, 0.25);
    }

    .create-header h1 {
        font-size: 2.2rem;
        font-weight: 800;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 15px;
        letter-spacing: -0.5px;
    }

    .create-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .book-info-section {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        padding: 2rem;
        border-bottom: 1px solid rgba(30, 60, 114, 0.1);
        display: flex;
        gap: 2rem;
        align-items: flex-start;
    }

    .book-thumbnail {
        flex-shrink: 0;
    }

    .book-thumbnail i {
        font-size: 4rem;
        color: #999;
    }

    .book-details {
        flex: 1;
    }

    .book-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 0.5rem;
    }

    .book-subtitle {
        color: #666;
        font-size: 0.95rem;
        margin-bottom: 1rem;
    }

    .book-meta {
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
        margin-bottom: 1rem;
    }

    .meta-item {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        align-items: center;
    }

    .meta-label {
        font-weight: 700;
        color: #1a1a1a;
        font-size: 0.9rem;
    }

    .badge-custom {
        display: inline-block;
        padding: 0.4rem 0.8rem;
        background: #f0f0f0;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #555;
    }

    .badge-author {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .badge-genre {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .availability-info {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
        padding: 0.8rem 1.2rem;
        border-radius: 8px;
        font-weight: 700;
        display: inline-block;
        margin-top: 1rem;
    }

    .form-section {
        padding: 2rem;
    }

    .form-group {
        margin-bottom: 2rem;
    }

    .form-label {
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
    }

    .form-label i {
        color: #1e3c72;
    }

    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 0.8rem 1.2rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f9f9fb;
    }

    .form-control:focus {
        border-color: #1e3c72;
        background: white;
        box-shadow: 0 0 0 0.2rem rgba(30, 60, 114, 0.1);
    }

    .form-helper {
        color: #666;
        font-size: 0.9rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .quantity-info {
        background: #f0f5ff;
        border-left: 4px solid #1e3c72;
        padding: 1rem;
        border-radius: 8px;
        margin-top: 1rem;
    }

    .quantity-info strong {
        color: #1e3c72;
    }

    .alert-error {
        background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
        border: none;
        color: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 8px 20px rgba(235, 51, 73, 0.15);
    }

    .alert-error strong {
        font-weight: 700;
    }

    .alert-error ul {
        margin: 0.8rem 0 0 1.5rem;
        padding: 0;
    }

    .alert-error li {
        margin-bottom: 0.5rem;
    }

    .alert-info {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.15);
    }

    .alert-info strong {
        font-weight: 700;
    }

    .alert-info i {
        margin-right: 0.8rem;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #e9ecef;
    }

    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        font-weight: 700;
        padding: 1rem 2rem;
        border-radius: 10px;
        transition: all 0.3s ease;
        cursor: pointer;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        flex: 1;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        color: white;
        text-decoration: none;
    }

    .btn-cancel {
        background: linear-gradient(135deg, #bdc3c7 0%, #95a5a6 100%);
        border: none;
        color: white;
        font-weight: 700;
        padding: 1rem 2rem;
        border-radius: 10px;
        transition: all 0.3s ease;
        cursor: pointer;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        flex: 1;
        text-decoration: none;
    }

    .btn-cancel:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        color: white;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .book-info-section {
            flex-direction: column;
        }
        .form-actions {
            flex-direction: column;
        }
    }
</style>

<!-- En-tête -->
<div class="create-header">
    <h1>
        <i class="fas fa-bookmark"></i>
        @if(isset($book))
            Réserver ce Livre
        @else
            Nouvelle Réservation
        @endif
    </h1>
</div>

<!-- Conteneur principal -->
<div class="create-container">
    <!-- Section infos du livre -->
    @if(isset($book))
        <div class="book-info-section">
            <div class="book-thumbnail">
                @if($book->images)
                    <img src="{{ asset('storage/' . $book->images) }}" alt="{{ $book->titre }}" style="width: 100px; height: 150px; object-fit: cover; border-radius: 10px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); border: 3px solid white;">
                @else
                    <div style="width: 100px; height: 150px; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; border: 3px solid white;">
                        <i class="fas fa-book"></i>
                    </div>
                @endif
            </div>

            <div class="book-details">
                <div class="book-title">{{ $book->titre }}</div>
                @if($book->sous_titre)
                    <div class="book-subtitle">{{ $book->sous_titre }}</div>
                @endif

                <div class="book-meta">
                    @if($book->authors && count($book->authors) > 0)
                        <div class="meta-item">
                            <span class="meta-label"><i class="fas fa-user"></i> Auteur(s):</span>
                            @foreach($book->authors as $author)
                                <span class="badge-custom badge-author">{{ $author->nom }}</span>
                            @endforeach
                        </div>
                    @endif

                    @if($book->genres && count($book->genres) > 0)
                        <div class="meta-item">
                            <span class="meta-label"><i class="fas fa-tag"></i> Genre(s):</span>
                            @foreach($book->genres as $genre)
                                <span class="badge-custom badge-genre">{{ $genre->nom }}</span>
                            @endforeach
                        </div>
                    @endif

                    <div class="meta-item">
                        <span class="meta-label"><i class="fas fa-building"></i> Éditeur:</span>
                        <span>{{ $book->editeur ?? 'Non spécifié' }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label"><i class="fas fa-calendar"></i> Année:</span>
                        <span>{{ $book->annee_publication ?? 'Non spécifié' }}</span>
                    </div>
                </div>

                <div class="availability-info">
                    <i class="fas fa-check-circle"></i> {{ $book->exemplaires->where('statut', 'disponible')->count() }} exemplaire(s) disponible(s)
                </div>
            </div>
        </div>
    @endif

    <!-- Section formulaire -->
    <div class="form-section">
        @if ($errors->any())
            <div class="alert-error alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-exclamation-circle"></i> Erreurs :</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" style="filter: brightness(0) invert(1);" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(isset($book))
            <form method="POST" action="{{ route('reservations.store') }}">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id_livre }}">
                
                <!-- Quantité -->
                <div class="form-group">
                    <label for="quantity" class="form-label">
                        <i class="fas fa-list-ol"></i> Nombre de réservations
                    </label>
                    <input type="number" 
                           name="quantity" 
                           id="quantity" 
                           class="form-control @error('quantity') is-invalid @enderror"
                           min="1" 
                           max="5"
                           value="1"
                           required>
                    <div class="quantity-info">
                        Vous pouvez réserver jusqu'à <strong>5 exemplaires</strong> de ce livre.
                    </div>
                    @error('quantity')
                        <span class="invalid-feedback" style="display: block; color: #eb3349; margin-top: 0.5rem;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Information importante -->
                <div class="alert-info">
                    <i class="fas fa-info-circle"></i>
                    <strong>Important :</strong> Votre réservation vous place dans une file d'attente. Vous serez notifié lorsque le livre sera disponible.
                </div>

                <!-- Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-bookmark"></i> Confirmer la réservation
                    </button>
                    <a href="{{ route('books.show', $book->id_livre) }}" class="btn-cancel">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                </div>
            </form>
        @else
            <div class="alert-info">
                <i class="fas fa-info-circle"></i> Pour réserver un livre spécifique, utilisez le bouton "Réserver" depuis la fiche du livre.
            </div>
        @endif
    </div>
</div>
@endsection
