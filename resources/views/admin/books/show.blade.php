@extends('layouts.admin')

@section('title', 'Détails du Livre')

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

    .page-header {
        margin-bottom: 2rem;
    }

    .page-header h1 {
        font-size: 2rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0;
    }

    .page-header .page-subtitle {
        color: var(--text-light);
        font-size: 0.95rem;
        margin-top: 0.5rem;
    }

    .detail-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        color: white;
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(30, 60, 114, 0.2);
    }

    .detail-header h2 {
        font-size: 1.8rem;
        font-weight: 800;
        margin: 0;
        margin-bottom: 0.5rem;
    }

    .detail-header p {
        margin: 0.25rem 0;
        opacity: 0.9;
        font-size: 0.95rem;
    }

    .book-image-container {
        text-align: center;
        margin-bottom: 2rem;
    }

    .book-image {
        max-width: 100%;
        height: auto;
        max-height: 400px;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    .no-image {
        width: 200px;
        height: 280px;
        background: var(--light-blue);
        border: 2px dashed var(--border-color);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-light);
        font-weight: 600;
        margin: 0 auto;
    }

    .info-section {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid var(--border-color);
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary-blue);
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--light-blue);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        font-size: 1.3rem;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--light-blue);
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 700;
        color: var(--primary-blue);
        min-width: 150px;
    }

    .info-value {
        color: var(--text-dark);
        font-weight: 500;
    }

    .badge-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }

    .badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.85rem;
        white-space: nowrap;
    }

    .badge-author {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .badge-genre {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .badge-status {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }

    .resume-text {
        color: var(--text-dark);
        line-height: 1.8;
        font-weight: 500;
        padding: 1rem;
        background: var(--light-blue);
        border-radius: 8px;
        border-left: 4px solid var(--secondary-blue);
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }

    .btn-edit, .btn-delete, .btn-back {
        padding: 0.75rem 1.75rem;
        border-radius: 8px;
        font-weight: 700;
        border: none;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-edit {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        color: white;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(30, 60, 114, 0.3);
        color: white;
        text-decoration: none;
    }

    .btn-back {
        background: var(--light-blue);
        color: var(--secondary-blue);
    }

    .btn-back:hover {
        background-color: var(--secondary-blue);
        color: white;
        text-decoration: none;
    }

    .btn-delete {
        background: #d32f2f;
        color: white;
    }

    .btn-delete:hover {
        background: #b71c1c;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(211, 47, 47, 0.3);
        text-decoration: none;
    }

    .exemplaires-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .exemplaire-card {
        background: var(--light-blue);
        border: 2px solid var(--border-color);
        border-radius: 8px;
        padding: 1rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .exemplaire-card:hover {
        border-color: var(--secondary-blue);
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(42, 82, 152, 0.15);
    }

    .exemplaire-code {
        font-weight: 700;
        color: var(--primary-blue);
        word-break: break-all;
    }

    .exemplaire-status {
        font-size: 0.8rem;
        margin-top: 0.5rem;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-weight: 600;
    }

    .status-available {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        color: white;
    }

    .status-loaned {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        color: white;
    }

    @media (max-width: 768px) {
        .info-row {
            flex-direction: column;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-edit, .btn-delete, .btn-back {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="page-header">
    <h1><i class="fas fa-book"></i> Détails du Livre</h1>
    <p class="page-subtitle">Consultez toutes les informations sur ce livre</p>
</div>

<div class="detail-header">
    <h2>{{ $book->titre }}</h2>
    <p><i class="fas fa-pen"></i> Édité par <strong>{{ $book->editeur }}</strong></p>
    <p><i class="fas fa-calendar"></i> Publié en <strong>{{ $book->annee_publication }}</strong></p>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="book-image-container">
            @if($book->images)
                <img src="{{ asset('storage/' . $book->images) }}" alt="{{ $book->titre }}" class="book-image">
            @else
                <div class="no-image">
                    <div>
                        <i class="fas fa-image" style="font-size: 2rem; margin-bottom: 0.5rem; opacity: 0.5;"></i>
                        <p>Aucune image</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="col-md-8">
        <!-- Résumé -->
        @if($book->resume)
            <div class="info-section">
                <div class="section-title">
                    <i class="fas fa-align-left"></i> Résumé
                </div>
                <p class="resume-text">{{ $book->resume }}</p>
            </div>
        @endif

        <!-- Auteurs -->
        <div class="info-section">
            <div class="section-title">
                <i class="fas fa-user-tie"></i> Auteur(s)
            </div>
            @if($book->authors->count() > 0)
                <div class="badge-container">
                    @foreach($book->authors as $author)
                        <span class="badge badge-author">
                            <i class="fas fa-user"></i> {{ $author->nom }}
                        </span>
                    @endforeach
                </div>
            @else
                <p class="text-muted">
                    <i class="fas fa-info-circle"></i> Aucun auteur associé
                </p>
            @endif
        </div>

        <!-- Genres -->
        <div class="info-section">
            <div class="section-title">
                <i class="fas fa-tag"></i> Genre(s)
            </div>
            @if($book->genres->count() > 0)
                <div class="badge-container">
                    @foreach($book->genres as $genre)
                        <span class="badge badge-genre">
                            <i class="fas fa-tag"></i> {{ $genre->nom }}
                        </span>
                    @endforeach
                </div>
            @else
                <p class="text-muted">
                    <i class="fas fa-info-circle"></i> Aucun genre associé
                </p>
            @endif
        </div>
    </div>
</div>

<!-- Exemplaires -->
<div class="info-section">
    <div class="section-title">
        <i class="fas fa-copy"></i> Exemplaires ({{ $book->exemplaires->count() }})
    </div>
    @if($book->exemplaires->count() > 0)
        <div class="exemplaires-grid">
            @foreach($book->exemplaires as $exemplaire)
                <div class="exemplaire-card">
                    <div class="exemplaire-code">
                        {{ $exemplaire->code_exemplaire }}
                    </div>
                    <div class="exemplaire-status {{ $exemplaire->status === 'disponible' ? 'status-available' : 'status-loaned' }}">
                        {{ ucfirst($exemplaire->status) }}
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted">
            <i class="fas fa-info-circle"></i> Aucun exemplaire pour ce livre
        </p>
    @endif
</div>

<!-- Boutons d'Actions -->
<div class="action-buttons">
    <a href="{{ route('admin.books.edit', $book) }}" class="btn-edit">
        <i class="fas fa-edit"></i> Éditer
    </a>
    <form action="{{ route('admin.books.destroy', $book) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce livre?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete">
            <i class="fas fa-trash-alt"></i> Supprimer
        </button>
    </form>
    <a href="{{ route('admin.books.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Retour à la Liste
    </a>
</div>

@endsection
