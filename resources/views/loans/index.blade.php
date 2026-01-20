@extends('layouts.app')

@section('title', 'Emprunts')

@section('content')
<style>
    .loans-header {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 15px 40px rgba(30, 60, 114, 0.25);
    }

    .loans-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 15px;
        letter-spacing: -0.5px;
    }

    .loans-header .btn-group {
        margin-top: 1rem;
    }

    .stat-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        overflow: hidden;
        position: relative;
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    }

    .stat-card .card-body {
        padding: 1.8rem;
    }

    .stat-card h5 {
        font-weight: 700;
        font-size: 0.9rem;
        opacity: 0.85;
        margin-bottom: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .stat-card h2 {
        font-size: 2.8rem;
        font-weight: 800;
        margin: 0.8rem 0 0 0;
    }

    .stat-card small {
        display: block;
        opacity: 0.75;
        font-size: 0.8rem;
        margin-top: 0.5rem;
    }

    .loan-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: all 0.3s ease;
        margin-bottom: 1.5rem;
        background: white;
        position: relative;
    }

    .loan-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #1e3c72, #2a5298);
    }

    .loan-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    .loan-card-body {
        padding: 2rem;
        display: flex;
        gap: 1.5rem;
        align-items: flex-start;
    }

    .loan-image {
        flex-shrink: 0;
    }

    .book-image {
        width: 90px;
        height: 140px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        border: 1px solid #f0f0f0;
    }

    .book-placeholder {
        width: 90px;
        height: 140px;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
        border: 1px solid #f0f0f0;
    }

    .loan-info {
        flex: 1;
    }

    .book-title {
        font-weight: 700;
        color: #1a1a1a;
        font-size: 1.2rem;
        margin-bottom: 0.8rem;
        line-height: 1.4;
    }

    .book-subtitle {
        color: #777;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .loan-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin-bottom: 1rem;
    }

    .meta-item {
        display: flex;
        flex-direction: column;
    }

    .meta-label {
        font-size: 0.8rem;
        color: #999;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 0.3rem;
    }

    .meta-value {
        font-size: 1rem;
        color: #333;
        font-weight: 600;
    }

    .loan-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 0.8rem;
        margin-bottom: 1rem;
    }

    .quantity-badge {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: white;
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .badge-status {
        font-weight: 700;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-en_cours {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .status-retourne {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .status-retard {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        color: white;
    }

    .penalty-badge {
        background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
        color: white;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .penalty-clear {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
    }

    .loan-actions {
        display: flex;
        gap: 0.8rem;
        flex-wrap: wrap;
    }

    .delete-loan-btn {
        background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
        border: none;
        color: white;
        font-weight: 700;
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .delete-loan-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(235, 51, 73, 0.3);
        color: white;
        text-decoration: none;
    }

    .delete-loan-btn:active {
        transform: translateY(0);
    }

    .no-loans {
        background: white;
        padding: 4rem 2rem;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    .no-loans i {
        font-size: 4rem;
        color: #ddd;
        margin-bottom: 1rem;
    }

    .no-loans h4 {
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
</style>

<!-- En-tête -->
<div class="loans-header">
    <h1>
        <i class="fas fa-exchange-alt"></i>
        @if(session()->get('membre_role') === 'admin')
            Gestion des Emprunts
        @else
            Mes Emprunts
        @endif
    </h1>
    @if(session()->has('membre_id'))
        <div class="btn-group mt-3" role="group">
            @if(session()->get('membre_role') === 'admin')
                <a href="{{ route('admin.loans.create') }}" class="btn btn-light">
                    <i class="fas fa-plus"></i> Nouvel Emprunt
                </a>
                <a href="{{ route('admin.loans.overdue') }}" class="btn btn-light">
                    <i class="fas fa-clock"></i> En Retard
                </a>
            @else
                <a href="{{ route('books.index') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left"></i> Retour au catalogue
                </a>
            @endif
        </div>
    @endif
</div>

<!-- Statistiques -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card stat-card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title">Total des emprunts</h5>
                <h2>{{ $loans->count() }}</h2>
                <small>Livre(s) actuellement emprunté(s)</small>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card stat-card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">En cours</h5>
                <h2>{{ $loans->where('statut', 'en_cours')->count() }}</h2>
                <small>Emprunt(s) actif(s)</small>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card stat-card bg-warning text-dark">
            <div class="card-body">
                <h5 class="card-title">Retournés</h5>
                <h2>{{ $loans->where('statut', 'retourne')->count() }}</h2>
                <small>Livre(s) retourné(s)</small>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card stat-card bg-danger text-white">
            <div class="card-body">
                <h5 class="card-title">En retard</h5>
                <h2>{{ $loans->filter(fn($l) => $l->isOverdue())->count() }}</h2>
                <small>Emprunt(s) en retard</small>
            </div>
        </div>
    </div>
</div>

<!-- Tableau des emprunts -->
@php
    $groupedLoans = $loans->groupBy(function($loan) {
        return $loan->exemplaire->book->id_livre;
    });
@endphp

@if($groupedLoans->count() > 0)
    <div class="loans-grid">
        @forelse($groupedLoans as $bookId => $loansGroup)
            @php
                $firstLoan = $loansGroup->first();
                $quantity = $loansGroup->count();
                $allStatus = $loansGroup->pluck('statut')->unique();
                $hasOverdue = $loansGroup->filter(fn($l) => $l->isOverdue())->count() > 0;
                $totalUnpaidPenalties = $loansGroup->flatMap(fn($l) => $l->penalites)->where('statut', 'non_payee')->count();
            @endphp
            <div class="loan-card">
                <div class="loan-card-body">
                    <!-- Image du livre -->
                    <div class="loan-image">
                        @if($firstLoan->exemplaire->book->images)
                            <img src="{{ asset('storage/' . $firstLoan->exemplaire->book->images) }}" alt="{{ $firstLoan->exemplaire->book->titre }}" class="book-image">
                        @else
                            <div class="book-placeholder">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Informations du livre -->
                    <div class="loan-info" style="flex: 1;">
                        <div class="book-title">{{ $firstLoan->exemplaire->book->titre }}</div>
                        @if($firstLoan->exemplaire->book->sous_titre)
                            <div class="book-subtitle">{{ $firstLoan->exemplaire->book->sous_titre }}</div>
                        @endif

                        <!-- Métadonnées -->
                        <div class="loan-meta">
                            <div class="meta-item">
                                <div class="meta-label"><i class="fas fa-calendar-check"></i> Emprunt</div>
                                <div class="meta-value">{{ $firstLoan->date_emprunt->format('d/m/Y') }}</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-label"><i class="fas fa-undo"></i> Retour prévu</div>
                                <div class="meta-value">{{ $firstLoan->date_retour_prevue->format('d/m/Y') }}</div>
                            </div>
                        </div>

                        <!-- Badges -->
                        <div class="loan-badges">
                            <span class="quantity-badge">
                                <i class="fas fa-book"></i> {{ $quantity }} exemplaire(s)
                            </span>

                            @if($allStatus->count() === 1)
                                <span class="badge badge-status status-{{ $firstLoan->statut }}">
                                    <i class="fas fa-info-circle"></i> {{ ucfirst(str_replace('_', ' ', $firstLoan->statut)) }}
                                </span>
                            @else
                                <span class="badge badge-status bg-secondary">Statuts mixtes</span>
                            @endif

                            @if($hasOverdue)
                                <span class="badge badge-status bg-danger">
                                    <i class="fas fa-exclamation-circle"></i> EN RETARD
                                </span>
                            @endif

                            @if($totalUnpaidPenalties > 0)
                                <span class="badge badge-status penalty-badge">
                                    <i class="fas fa-coins"></i> {{ $totalUnpaidPenalties }} pénalité(s)
                                </span>
                            @else
                                <span class="badge badge-status penalty-clear">
                                    <i class="fas fa-check-circle"></i> Aucune pénalité
                                </span>
                            @endif
                        </div>
                    </div>

                   
                    
                </div>
            </div>
        @empty
            <div class="no-loans">
                <i class="fas fa-inbox"></i>
                <h4>Aucun emprunt</h4>
                <p class="text-muted">Vous n'avez pas d'emprunts pour le moment.</p>
            </div>
        @endforelse
    </div>
@else
    <div class="no-loans">
        <i class="fas fa-inbox"></i>
        <h4>Aucun emprunt</h4>
        <p class="text-muted">Vous n'avez pas d'emprunts pour le moment.</p>
        <a href="{{ route('books.index') }}" class="btn btn-primary mt-3">
            <i class="fas fa-book"></i> Consulter le catalogue
        </a>
    </div>
@endif

<!-- Pagination -->
@if ($loans instanceof \Illuminate\Pagination\Paginator && $loans->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination">
            {{ $loans->links() }}
        </ul>
    </nav>
@endif

<!-- Formulaire caché pour la suppression -->
<form id="deleteLoanForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-loan-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const loanId = this.getAttribute('data-loan-id');
            
            if (confirm('Êtes-vous sûr de vouloir supprimer cet emprunt ? Cette action est irréversible.')) {
                const form = document.getElementById('deleteLoanForm');
                form.action = '/loans/' + loanId;
                form.submit();
            }
        });
    });
});
</script>

@endsection
