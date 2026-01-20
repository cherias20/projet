@php
    use App\Models\Book;
    use App\Models\Membre;
    use App\Models\Loan;
    use App\Models\Reservation;
    
    $totalBooks = Book::count();
    $totalMembers = Membre::count();
    $activeLoans = Loan::where('statut', 'en_cours')->count();
    $totalReservations = Reservation::count();
@endphp

@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<style>
    .dashboard-header {
        margin-bottom: 2rem;
    }

    .dashboard-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0;
    }

    .dashboard-header p {
        color: #636e72;
        font-size: 1rem;
        margin-top: 0.5rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        border-left: 5px solid;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .stat-card.books {
        border-left-color: #667eea;
    }

    .stat-card.members {
        border-left-color: #f093fb;
    }

    .stat-card.loans {
        border-left-color: #4facfe;
    }

    .stat-card.reservations {
        border-left-color: #43e97b;
    }

    .stat-icon {
        width: 80px;
        height: 80px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        flex-shrink: 0;
    }

    .stat-card.books .stat-icon {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .stat-card.members .stat-icon {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .stat-card.loans .stat-icon {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }

    .stat-card.reservations .stat-icon {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        color: white;
    }

    .stat-content {
        flex: 1;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: #2d3436;
        margin: 0;
    }

    .stat-label {
        color: #636e72;
        font-size: 0.95rem;
        margin-top: 0.5rem;
    }

    .management-section {
        margin-bottom: 3rem;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2d3436;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: #667eea;
        font-size: 1.3rem;
    }

    .action-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 1.5rem;
    }

    .action-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
        border: 2px solid transparent;
    }

    .action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        border-color: #667eea;
    }

    .action-card i {
        font-size: 2.5rem;
        color: #667eea;
        margin-bottom: 1rem;
        display: block;
    }

    .action-card h3 {
        font-size: 1rem;
        font-weight: 700;
        color: #2d3436;
        margin: 0;
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .action-grid {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        }
    }
</style>

<div class="dashboard-header">
    <h1><i class="fas fa-chart-line"></i> Tableau de Bord Administrateur</h1>
    <p>Bienvenue sur votre espace d'administration</p>
</div>

<!-- Statistics Cards -->
<div class="stats-grid">
    <div class="stat-card books">
        <div class="stat-icon">
            <i class="fas fa-book"></i>
        </div>
        <div class="stat-content">
            <div class="stat-number">{{ $totalBooks }}</div>
            <div class="stat-label">Livres</div>
        </div>
    </div>

    <div class="stat-card members">
        <div class="stat-icon">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-content">
            <div class="stat-number">{{ $totalMembers }}</div>
            <div class="stat-label">Membres</div>
        </div>
    </div>

    <div class="stat-card loans">
        <div class="stat-icon">
            <i class="fas fa-exchange-alt"></i>
        </div>
        <div class="stat-content">
            <div class="stat-number">{{ $activeLoans }}</div>
            <div class="stat-label">Emprunts Actifs</div>
        </div>
    </div>

    <div class="stat-card reservations">
        <div class="stat-icon">
            <i class="fas fa-bookmark"></i>
        </div>
        <div class="stat-content">
            <div class="stat-number">{{ $totalReservations }}</div>
            <div class="stat-label">Réservations</div>
        </div>
    </div>
</div>

<!-- Management Sections -->
<div class="management-section">
    <div class="section-title">
        <i class="fas fa-book"></i> Gestion des Livres
    </div>
    <div class="action-grid">
        <a href="{{ route('admin.books.index') }}" class="action-card">
            <i class="fas fa-list"></i>
            <h3>Tous les Livres</h3>
        </a>
        <a href="{{ route('admin.books.create') }}" class="action-card">
            <i class="fas fa-plus"></i>
            <h3>Ajouter un Livre</h3>
        </a>
    </div>
</div>

<div class="management-section">
    <div class="section-title">
        <i class="fas fa-pen-fancy"></i> Gestion des Auteurs
    </div>
    <div class="action-grid">
        <a href="{{ route('admin.authors.index') }}" class="action-card">
            <i class="fas fa-list"></i>
            <h3>Tous les Auteurs</h3>
        </a>
        <a href="{{ route('admin.authors.create') }}" class="action-card">
            <i class="fas fa-plus"></i>
            <h3>Ajouter un Auteur</h3>
        </a>
    </div>
</div>

<div class="management-section">
    <div class="section-title">
        <i class="fas fa-tag"></i> Gestion des Genres
    </div>
    <div class="action-grid">
        <a href="{{ route('admin.genres.index') }}" class="action-card">
            <i class="fas fa-list"></i>
            <h3>Tous les Genres</h3>
        </a>
        <a href="{{ route('admin.genres.create') }}" class="action-card">
            <i class="fas fa-plus"></i>
            <h3>Ajouter un Genre</h3>
        </a>
    </div>
</div>

<div class="management-section">
    <div class="section-title">
        <i class="fas fa-exchange-alt"></i> Gestion des Emprunts
    </div>
    <div class="action-grid">
        <a href="{{ route('admin.loans.index') }}" class="action-card">
            <i class="fas fa-list"></i>
            <h3>Tous les Emprunts</h3>
        </a>
    </div>
</div>

<div class="management-section">
    <div class="section-title">
        <i class="fas fa-users"></i> Gestion des Membres
    </div>
    <div class="action-grid">
        <a href="{{ route('admin.members.index') }}" class="action-card">
            <i class="fas fa-list"></i>
            <h3>Tous les Membres</h3>
        </a>
    </div>
</div>

<div class="management-section">
    <div class="section-title">
        <i class="fas fa-bookmark"></i> Gestion des Réservations
    </div>
    <div class="action-grid">
        <a href="{{ route('admin.reservations.index') }}" class="action-card">
            <i class="fas fa-list"></i>
            <h3>Toutes les Réservations</h3>
        </a>
    </div>
</div>

@endsection
