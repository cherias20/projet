@extends('layouts.app')

@section('title', 'Catalogue des Livres')

@section('content')
<style>
    .books-header {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: white;
        padding: 3rem 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 15px 40px rgba(30, 60, 114, 0.25);
        text-align: center;
    }

    .books-header h1 {
        font-size: 2.8rem;
        font-weight: 800;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        letter-spacing: -0.5px;
    }

    .books-header p {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-top: 1rem;
        margin-bottom: 0;
    }

    .welcome-banner {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        border: none;
        color: white;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(17, 153, 142, 0.2);
        padding: 1.5rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .welcome-banner i {
        font-size: 2rem;
    }

    .search-section {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
    }

    .search-section input {
        border-radius: 10px;
        border: 2px solid #e9ecef;
        padding: 0.8rem 1.2rem;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .search-section input:focus {
        border-color: #1e3c72;
        box-shadow: 0 0 0 0.2rem rgba(30, 60, 114, 0.1);
    }

    .search-btn {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        border: none;
        color: white;
        font-weight: 700;
        padding: 0.8rem 2rem;
        border-radius: 10px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .search-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(30, 60, 114, 0.3);
        color: white;
    }

    .books-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .book-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: flex;
        flex-direction: column;
    }

    .book-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .book-card-image {
        position: relative;
        height: 300px;
        overflow: hidden;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .book-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .book-card:hover img {
        transform: scale(1.05);
    }

    .book-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
    }

    .book-placeholder i {
        font-size: 4rem;
    }

    .availability-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
        padding: 0.6rem 1rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.85rem;
        box-shadow: 0 4px 12px rgba(17, 153, 142, 0.3);
    }

    .availability-badge.unavailable {
        background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
    }

    .book-card-body {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .book-card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 0.8rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .book-info-item {
        margin-bottom: 0.8rem;
    }

    .book-info-label {
        font-size: 0.8rem;
        color: #999;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 0.3rem;
    }

    .badge-custom {
        display: inline-block;
        padding: 0.4rem 0.8rem;
        background: #f0f0f0;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #555;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .badge-author {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .badge-genre {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .book-card-actions {
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px solid #f0f0f0;
    }

    .btn-action {
        padding: 0.7rem 1rem;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        transition: all 0.3s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        color: white;
        text-decoration: none;
    }

    .btn-details {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    }

    .btn-details:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(30, 60, 114, 0.3);
        color: white;
        text-decoration: none;
    }

    .btn-borrow {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }

    .btn-borrow:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(17, 153, 142, 0.3);
        color: white;
        text-decoration: none;
    }

    .btn-reserve {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .btn-reserve:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(102, 126, 234, 0.3);
        color: white;
        text-decoration: none;
    }

    .btn-edit {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(245, 87, 108, 0.3);
        color: white;
        text-decoration: none;
    }

    .btn-delete {
        background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(235, 51, 73, 0.3);
        color: white;
        text-decoration: none;
    }

    .no-books {
        background: white;
        padding: 4rem 2rem;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        grid-column: 1 / -1;
    }

    .no-books i {
        font-size: 4rem;
        color: #ddd;
        margin-bottom: 1rem;
    }

    .no-books h4 {
        color: #333;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .pagination {
        margin-top: 2rem;
        justify-content: center;
    }

    .pagination .page-link {
        border-radius: 8px;
        border: 1px solid #e9ecef;
        margin: 0 0.25rem;
        transition: all 0.2s ease;
        color: #1e3c72;
    }

    .pagination .page-link:hover {
        background-color: #1e3c72;
        border-color: #1e3c72;
        color: white;
    }

    .pagination .page-item.active .page-link {
        background-color: #1e3c72;
        border-color: #1e3c72;
    }

    .admin-actions {
        display: flex;
        gap: 0.8rem;
    }

    .admin-actions form {
        display: contents;
    }
</style>

<!-- En-tête -->
<div class="books-header">
    <h1>
        <i class="fas fa-book-open"></i>
        Catalogue des Livres
    </h1>
    <p>Découvrez notre collection complète de livres</p>
</div>

<!-- Bannière de bienvenue -->
@if(session()->has('membre_id'))
    <div class="welcome-banner">
        <i class="fas fa-check-circle"></i>
        <div>
            <strong>Bienvenue {{ session()->get('membre_nom') }} ! 👋</strong>
            <p style="margin: 0; opacity: 0.9; font-size: 0.95rem;">Explorez notre collection et trouvez vos prochains livres à lire</p>
        </div>
    </div>
@endif

<!-- Section de recherche -->
<div class="search-section">
    <form method="GET" action="{{ route('books.search') }}" class="row g-3">
        <div class="col-md-10">
            <input type="text" name="query" class="form-control form-control-lg" placeholder="Rechercher un livre, auteur, genre..." value="{{ request('query') }}" style="height: 50px;">
        </div>
        <div class="col-md-2">
            <button type="submit" class="search-btn w-100" style="height: 50px;">
                <i class="fas fa-search"></i> Rechercher
            </button>
        </div>
    </form>
</div>

<!-- Bouton d'ajout pour admin -->
@if(session()->has('membre_id') && session()->get('membre_role') === 'admin')
    <div style="margin-bottom: 2rem; text-align: right;">
        <a href="{{ route('admin.books.create') }}" class="btn-action btn-details" style="display: inline-flex;">
            <i class="fas fa-plus"></i> Ajouter un Livre
        </a>
    </div>
@endif

<!-- Grille des livres -->
<div class="books-grid">
    @forelse($books as $book)
        <div class="book-card">
            <div class="book-card-image">
                @if($book->images)
                    <img src="{{ asset('storage/' . $book->images) }}" alt="{{ $book->titre }}">
                @else
                    <div class="book-placeholder">
                        <i class="fas fa-book"></i>
                    </div>
                @endif
                <span class="availability-badge {{ $book->getAvailableCopiesCount() === 0 ? 'unavailable' : '' }}">
                    {{ $book->getAvailableCopiesCount() }}/{{ $book->getTotalCopiesCount() }}
                </span>
            </div>

            <div class="book-card-body">
                <h3 class="book-card-title">{{ $book->titre }}</h3>

                @if($book->authors->count() > 0)
                    <div class="book-info-item">
                        <div class="book-info-label"><i class="fas fa-user"></i> Auteurs</div>
                        <div>
                            @foreach($book->authors as $author)
                                <span class="badge-custom badge-author">{{ $author->nom }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($book->genres->count() > 0)
                    <div class="book-info-item">
                        <div class="book-info-label"><i class="fas fa-tag"></i> Genres</div>
                        <div>
                            @foreach($book->genres as $genre)
                                <span class="badge-custom badge-genre">{{ $genre->nom }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="book-info-item">
                    <div class="book-info-label"><i class="fas fa-building"></i> Éditeur</div>
                    <div>{{ $book->editeur }}</div>
                </div>

                <div class="book-info-item">
                    <div class="book-info-label"><i class="fas fa-calendar"></i> Année</div>
                    <div>{{ $book->annee_publication }}</div>
                </div>

                <div class="book-card-actions">
                    <a href="{{ route('books.show', $book) }}" class="btn-action btn-details">
                        <i class="fas fa-eye"></i> Voir Détails
                    </a>

                    @if(session()->has('membre_id'))
                        @if($book->getAvailableCopiesCount() > 0)
                            <a href="{{ route('admin.loans.create', ['book_id' => $book->id_livre]) }}" class="btn-action btn-borrow">
                                <i class="fas fa-download"></i> Emprunter
                            </a>
                        @endif
                        <a href="{{ route('reservations.create', ['book_id' => $book->id_livre]) }}" class="btn-action btn-reserve">
                            <i class="fas fa-bookmark"></i> Réserver
                        </a>
                    @endif

                    @if(session()->has('membre_id') && session()->get('membre_role') === 'admin')
                        <a href="{{ route('admin.books.edit', $book) }}" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i> Éditer
                        </a>
                        <form method="POST" action="{{ route('admin.books.destroy', $book) }}" style="display: contents;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?')">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="no-books">
            <i class="fas fa-inbox"></i>
            <h4>Aucun livre trouvé</h4>
            <p class="text-muted">Essayez de modifier votre recherche ou parcourez notre catalogue complet.</p>
        </div>
    @endforelse
</div>

<!-- Pagination -->
@if ($books instanceof \Illuminate\Pagination\Paginator && $books->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination">
            {{ $books->links() }}
        </ul>
    </nav>
@endif

@endsection
