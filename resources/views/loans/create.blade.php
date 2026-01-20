@extends('layouts.app')

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

    .book-thumbnail img {
        width: 100px;
        height: 150px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        border: 3px solid white;
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
        gap: 0.5rem;
    }

    .meta-item {
        color: #555;
        font-size: 0.9rem;
    }

    .meta-item strong {
        color: #1a1a1a;
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

    .form-control.is-invalid {
        border-color: #eb3349;
        background: #fff5f5;
    }

    .form-helper {
        color: #666;
        font-size: 0.9rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .form-helper i {
        color: #999;
    }

    .dates-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    @media (max-width: 768px) {
        .dates-grid {
            grid-template-columns: 1fr;
        }
        .book-info-section {
            flex-direction: column;
        }
    }

    .date-input-wrapper {
        position: relative;
    }

    .date-input-icon {
        position: absolute;
        right: 1.2rem;
        top: 50%;
        transform: translateY(-50%);
        color: #1e3c72;
        pointer-events: none;
    }

    .date-input-wrapper input {
        padding-right: 3rem;
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
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
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
        gap: 0.5rem;
        flex: 1;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(17, 153, 142, 0.3);
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

    .invalid-feedback {
        color: #eb3349;
        font-size: 0.9rem;
        margin-top: 0.5rem;
        display: block;
    }
</style>

<!-- En-tête -->
<div class="create-header">
    <h1>
        <i class="fas fa-plus-circle"></i>
        Nouvel Emprunt
    </h1>
</div>

<!-- Conteneur principal -->
<div class="create-container">
    <!-- Section infos du livre -->
    @if(isset($book_id) && $exemplaires->isNotEmpty())
        <div class="book-info-section">
            <div class="book-thumbnail">
                @if($exemplaires->first()->book->images)
                    <img src="{{ asset('storage/' . $exemplaires->first()->book->images) }}" alt="{{ $exemplaires->first()->book->titre }}">
                @else
                    <div style="width: 100px; height: 150px; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #999;">
                        <i class="fas fa-book" style="font-size: 2rem;"></i>
                    </div>
                @endif
            </div>

            <div class="book-details">
                <div class="book-title">{{ $exemplaires->first()->book->titre }}</div>
                @if($exemplaires->first()->book->sous_titre)
                    <div class="book-subtitle">{{ $exemplaires->first()->book->sous_titre }}</div>
                @endif

                <div class="book-meta">
                    <div class="meta-item">
                        <strong><i class="fas fa-user"></i> Auteur(s):</strong> 
                        @if($exemplaires->first()->book->authors && count($exemplaires->first()->book->authors) > 0)
                            @foreach($exemplaires->first()->book->authors as $author)
                                {{ $author->nom }}@if(!$loop->last), @endif
                            @endforeach
                        @else
                            Non spécifié
                        @endif
                    </div>
                    <div class="meta-item">
                        <strong><i class="fas fa-tag"></i> Genre(s):</strong> 
                        @if($exemplaires->first()->book->genres && count($exemplaires->first()->book->genres) > 0)
                            @foreach($exemplaires->first()->book->genres as $genre)
                                {{ $genre->nom }}@if(!$loop->last), @endif
                            @endforeach
                        @else
                            Non spécifié
                        @endif
                    </div>
                </div>

                <div class="availability-info">
                    <i class="fas fa-check-circle"></i> {{ $exemplaires->count() }} exemplaire(s) disponible(s)
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

        <form action="{{ route('admin.loans.store') }}" method="POST">
            @csrf
            @if(isset($book_id))
                <input type="hidden" name="book_id" value="{{ $book_id }}">
            @endif

            <!-- Quantité -->
            <div class="form-group">
                <label for="quantity" class="form-label">
                    <i class="fas fa-boxes"></i> Nombre d'exemplaires à emprunter
                </label>
                <input type="number" 
                       name="quantity" 
                       id="quantity" 
                       class="form-control @error('quantity') is-invalid @enderror"
                       min="1" 
                       max="{{ isset($exemplaires) ? $exemplaires->count() : 5 }}"
                       value="1"
                       required>
                @if(isset($exemplaires))
                    <div class="quantity-info">
                        Vous pouvez emprunter jusqu'à <strong>{{ $exemplaires->count() }}</strong> exemplaire(s) disponible(s) de ce livre.
                    </div>
                @else
                    <div class="quantity-info">
                        Vous pouvez emprunter jusqu'à <strong>5</strong> exemplaires.
                    </div>
                @endif
                @error('quantity')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Dates -->
            <div class="dates-grid">
                <div class="form-group">
                    <label for="date_emprunt" class="form-label">
                        <i class="fas fa-calendar-check"></i> Date d'emprunt
                    </label>
                    <div class="date-input-wrapper">
                        <input type="date" 
                               name="date_emprunt"
                               id="date_emprunt"
                               class="form-control @error('date_emprunt') is-invalid @enderror"
                               value="{{ now()->format('Y-m-d') }}"
                               min="{{ now()->format('Y-m-d') }}"
                               required>
                        <i class="fas fa-calendar date-input-icon"></i>
                    </div>
                    <div class="form-helper">
                        <i class="fas fa-info-circle"></i> Date de début de l'emprunt
                    </div>
                    @error('date_emprunt')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="date_retour" class="form-label">
                        <i class="fas fa-calendar-times"></i> Date de retour prévue
                    </label>
                    <div class="date-input-wrapper">
                        <input type="date" 
                               class="form-control" 
                               id="date_retour" 
                               value="{{ now()->addMonth()->format('Y-m-d') }}" 
                               disabled
                               style="background: #f0f0f0; cursor: not-allowed;">
                        <i class="fas fa-calendar date-input-icon"></i>
                    </div>
                    <div class="form-helper">
                        <i class="fas fa-info-circle"></i> Dans 1 mois (délai maximal)
                    </div>
                </div>
            </div>

            <!-- Informations importantes -->
            <div class="alert-info">
                <i class="fas fa-info-circle"></i>
                <strong>Conditions de l'emprunt :</strong> Le délai maximal est d'1 mois. Passé ce délai, des pénalités pourront être appliquées selon les tarifs fixés par l'administration.
            </div>

            <!-- Actions -->
            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-check"></i> Confirmer l'emprunt
                </button>
                <a href="{{ route('books.show', $book_id ?? '') }}" class="btn-cancel">
                    <i class="fas fa-arrow-left"></i> Retour au livre
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('date_emprunt').addEventListener('change', function() {
    const dateEmprunt = new Date(this.value);
    const dateRetour = new Date(dateEmprunt);
    dateRetour.setMonth(dateRetour.getMonth() + 1);
    
    const year = dateRetour.getFullYear();
    const month = String(dateRetour.getMonth() + 1).padStart(2, '0');
    const day = String(dateRetour.getDate()).padStart(2, '0');
    
    document.getElementById('date_retour').value = `${year}-${month}-${day}`;
});
</script>
@endsection


