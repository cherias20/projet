<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PenaltyController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Système de Gestion de Bibliothèque - Routes Définies
|
*/

// ============================================================================
// ROUTES PUBLIQUES (Pas d'authentification requise)
// ============================================================================

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Pages publiques (footer)
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');

// ============================================================================
// AUTHENTIFICATION - Routes de connexion et inscription
// ============================================================================

// Afficher le formulaire de connexion
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Traiter la soumission du formulaire de connexion
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Afficher le formulaire d'inscription
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// Traiter la soumission du formulaire d'inscription
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Se déconnecter
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout.get');

// ============================================================================
// ADMIN - Routes protégées pour les administrateurs
// ============================================================================

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [AuthController::class, 'adminDashboard'])->name('dashboard');
});

// ============================================================================
// CATALOGUE - Routes publiques pour la consultation
// ============================================================================

Route::prefix('books')->name('books.')->group(function () {
    // Liste tous les livres avec pagination
    Route::get('/', [BookController::class, 'index'])->name('index');
    
    // Recherche avancée de livres (AVANT la route show)
    Route::get('/search', [BookController::class, 'search'])->name('search');
    
    // Détails complets d'un livre
    Route::get('/{book}', [BookController::class, 'show'])->name('show');
});

// Auteurs
Route::prefix('authors')->name('authors.')->group(function () {
    // Liste de tous les auteurs
    Route::get('/', [AuthorController::class, 'index'])->name('index');
    
    // Détails et bibliographie d'un auteur
    Route::get('/{author}', [AuthorController::class, 'show'])->name('show');
});

// ============================================================================
// ROUTES AUTHENTIFIÉES (Connecté requis)
// ============================================================================

Route::middleware(['auth'])->group(function () {
    
    // ========================================================================
    // ADMINISTRATION - GESTION DES LIVRES (Admin seulement)
    // ========================================================================
    
    Route::middleware(['admin'])->prefix('admin/books')->name('admin.books.')->group(function () {
        // Liste de tous les livres
        Route::get('/', [BookController::class, 'index'])->name('index');
        
        // Formulaire pour créer un nouveau livre
        Route::get('/create', [BookController::class, 'create'])->name('create');
        
        // Enregistrer un nouveau livre en base de données
        Route::post('/', [BookController::class, 'store'])->name('store');
        
        // Formulaire pour éditer un livre (AVANT la route show)
        Route::get('/{book}/edit', [BookController::class, 'edit'])->name('edit');
        
        // Détails d'un livre
        Route::get('/{book}', [BookController::class, 'show'])->name('show');
        
        // Mettre à jour un livre existant
        Route::put('/{book}', [BookController::class, 'update'])->name('update');
        
        // Supprimer un livre
        Route::delete('/{book}', [BookController::class, 'destroy'])->name('destroy');
    });

    // ========================================================================
    // ADMINISTRATION - GESTION DES AUTEURS (Admin seulement)
    // ========================================================================
    
    Route::middleware(['admin'])->prefix('admin/authors')->name('admin.authors.')->group(function () {
        // Liste de tous les auteurs
        Route::get('/', [AuthorController::class, 'index'])->name('index');
        
        // Formulaire pour créer un nouvel auteur
        Route::get('/create', [AuthorController::class, 'create'])->name('create');
        
        // Enregistrer un nouvel auteur
        Route::post('/', [AuthorController::class, 'store'])->name('store');
        
        // Formulaire pour éditer un auteur
        Route::get('/{author}/edit', [AuthorController::class, 'edit'])->name('edit');
        
        // Mettre à jour un auteur
        Route::put('/{author}', [AuthorController::class, 'update'])->name('update');
        
        // Supprimer un auteur
        Route::delete('/{author}', [AuthorController::class, 'destroy'])->name('destroy');
    });

    Route::middleware(['admin'])->prefix('admin/loans')->name('admin.loans.')->group(function () {
        // Liste de tous les emprunts
        Route::get('/', [LoanController::class, 'adminIndex'])->name('index');
        
        // Détails complets d'un emprunt
        Route::get('/{loan}', [LoanController::class, 'show'])->name('show');
        
        // Formulaire pour créer un emprunt
        Route::get('/create', [LoanController::class, 'create'])->name('create');
        
        // Enregistrer un emprunt
        Route::post('/', [LoanController::class, 'store'])->name('store');
        
        // Liste des emprunts en retard
        Route::get('/overdue', [LoanController::class, 'getOverdueLoans'])->name('overdue');
    });

    // ========================================================================
    // ADMINISTRATION - GESTION DES RÉSERVATIONS (Admin seulement)
    // ========================================================================
    
    Route::middleware(['admin'])->prefix('admin/reservations')->name('admin.reservations.')->group(function () {
        // Liste de toutes les réservations
        Route::get('/', [ReservationController::class, 'adminIndex'])->name('index');
        
        // Détails d'une réservation
        Route::get('/{reservation}', [ReservationController::class, 'show'])->name('show');
        
        // Formulaire pour créer une réservation
        Route::get('/create', [ReservationController::class, 'create'])->name('create');
        
        // Enregistrer une réservation
        Route::post('/', [ReservationController::class, 'store'])->name('store');
    });

    // ========================================================================
    // ADMINISTRATION - GESTION DES PÉNALITÉS (Admin seulement)
    // ========================================================================
    
    Route::middleware(['admin'])->prefix('admin/penalties')->name('admin.penalties.')->group(function () {
        // Liste de toutes les pénalités
        Route::get('/', [PenaltyController::class, 'index'])->name('index');
        
        // Détails d'une pénalité
        Route::get('/{penalty}', [PenaltyController::class, 'show'])->name('show');
        
        // Liste des pénalités non payées
        Route::get('/unpaid', [PenaltyController::class, 'getUnpaidPenalties'])->name('unpaid');
        
        // Statistiques des pénalités
        Route::get('/statistics', [PenaltyController::class, 'statistics'])->name('statistics');

        // Paramètres des pénalités
        Route::get('/settings', [PenaltyController::class, 'settings'])->name('settings');
        Route::post('/settings', [PenaltyController::class, 'updateSettings'])->name('update-settings');

        // Gestion des comptes bloqués
        Route::get('/blocked-members', [PenaltyController::class, 'blockedMembers'])->name('blocked-members');
        Route::post('/unblock/{membre}', [PenaltyController::class, 'unblockMember'])->name('unblock');

        // Marquer comme payée
        Route::post('/{penalty}/pay', [PenaltyController::class, 'markAsPaid'])->name('pay');
    });

    // ========================================================================
    // ADMINISTRATION - GESTION DES GENRES (Admin seulement)
    // ========================================================================
    
    Route::middleware(['admin'])->prefix('admin/genres')->name('admin.genres.')->group(function () {
        // Liste de tous les genres
        Route::get('/', [GenreController::class, 'index'])->name('index');

        // Formulaire pour créer un nouveau genre
        Route::get('/create', [GenreController::class, 'create'])->name('create');

        // Enregistrer un nouveau genre
        Route::post('/', [GenreController::class, 'store'])->name('store');

        // Formulaire pour éditer un genre
        Route::get('/{genre}/edit', [GenreController::class, 'edit'])->name('edit');

        // Mettre à jour un genre
        Route::put('/{genre}', [GenreController::class, 'update'])->name('update');

        // Supprimer un genre
        Route::delete('/{genre}', [GenreController::class, 'destroy'])->name('destroy');
    });

    // ========================================================================
    // ADMINISTRATION - GESTION DES MEMBRES (Admin seulement)
    // ========================================================================
    
    Route::middleware(['admin'])->prefix('admin/members')->name('admin.members.')->group(function () {
        // Liste de tous les membres
        Route::get('/', [MemberController::class, 'index'])->name('index');
        
        // Profil complet d'un membre
        Route::get('/{membre}', [MemberController::class, 'show'])->name('show');
        
        // Formulaire pour créer un nouveau membre
        Route::get('/create', [MemberController::class, 'create'])->name('create');
        
        // Enregistrer un nouveau membre
        Route::post('/', [MemberController::class, 'store'])->name('store');
        
        // Formulaire pour éditer un membre
        Route::get('/{membre}/edit', [MemberController::class, 'edit'])->name('edit');
        
        // Mettre à jour les données d'un membre
        Route::put('/{membre}', [MemberController::class, 'update'])->name('update');
        
        // Supprimer un membre
        Route::delete('/{membre}', [MemberController::class, 'destroy'])->name('destroy');
        
        // Suspendre un membre (le rendre inactif)
        Route::post('/{membre}/suspend', [MemberController::class, 'suspend'])->name('suspend');
        
        // Activer un membre suspendu
        Route::post('/{membre}/activate', [MemberController::class, 'activate'])->name('activate');
    });

    // ========================================================================
    // GESTION DES EMPRUNTS (Membres + Admin)
    // ========================================================================
    
    Route::prefix('admin/loans')->name('admin.loans.')->group(function () {
        // Emprunter directement un livre sans formulaire
        Route::get('/quick-borrow', [LoanController::class, 'quickBorrow'])->name('quick-borrow');
        
        // Formulaire de création (avec book_id optionnel)
        Route::get('/create', [LoanController::class, 'create'])->name('create');
        
        // Liste des emprunts - Admin voit tous les emprunts
        Route::get('/', [LoanController::class, 'adminIndex'])->name('index');
        
        // Emprunts d'un membre spécifique (DOIT ÊTRE AVANT /{loan})
        Route::get('/member/{membre}', [LoanController::class, 'memberLoans'])->name('member');
        
        // Détails complets d'un emprunt
        Route::get('/{loan}', [LoanController::class, 'show'])->name('show');
        
        // Enregistrer un emprunt
        Route::post('/', [LoanController::class, 'store'])->name('store');
        
        // Actions sur un emprunt (tous les utilisateurs auth)
        // Renouveler un emprunt (max 3 fois)
        Route::post('/{loan}/renew', [LoanController::class, 'renewLoan'])->name('renew');
        
        // Retourner un livre au système
        Route::post('/{loan}/return', [LoanController::class, 'returnBook'])->name('return');
        
        // Supprimer un emprunt
        Route::delete('/{loan}', [LoanController::class, 'destroy'])->name('destroy');
    });

    // ========================================================================
    // GESTION DES EMPRUNTS POUR LES MEMBRES (Voir leurs propres emprunts)
    // ========================================================================
    
    Route::prefix('loans')->name('loans.')->group(function () {
        // Liste des emprunts du membre connecté
        Route::get('/', [LoanController::class, 'index'])->name('index');
        
        // Détails d'un emprunt
        Route::get('/{loan}', [LoanController::class, 'show'])->name('show');
        
        // Actions sur un emprunt (tous les utilisateurs auth)
        // Renouveler un emprunt (max 3 fois)
        Route::post('/{loan}/renew', [LoanController::class, 'renewLoan'])->name('renew');
        
        // Retourner un livre au système
        Route::post('/{loan}/return', [LoanController::class, 'returnBook'])->name('return');
        
        // Supprimer un emprunt
        Route::delete('/{loan}', [LoanController::class, 'destroy'])->name('destroy');
    });

    // ========================================================================
    // GESTION DES RÉSERVATIONS (Membres + Admin)
    // ========================================================================
    
    Route::prefix('reservations')->name('reservations.')->group(function () {
        // Formulaire de création (avec book_id optionnel)
        Route::get('/create', [ReservationController::class, 'create'])->name('create');
        
        // Liste des réservations (admin = tous, membre = ses réservations)
        Route::get('/', [ReservationController::class, 'index'])->name('index');
        
        // Enregistrer une réservation
        Route::post('/', [ReservationController::class, 'store'])->name('store');
        
        // Détails d'une réservation
        Route::get('/{reservation}', [ReservationController::class, 'show'])->name('show');
        
        // Réservations d'un membre spécifique
        Route::get('/member/{membre}', [ReservationController::class, 'memberReservations'])->name('member');
        
        // Réservations en attente pour un livre
        Route::get('/book/{book}', [ReservationController::class, 'bookReservations'])->name('book');
        
        // Actions sur une réservation (tous les utilisateurs auth)
        // Vérifier la disponibilité et notifier si possible
        Route::post('/{reservation}/check', [ReservationController::class, 'checkAvailability'])->name('check');
        
        // Annuler une réservation
        Route::post('/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('cancel');
    });

    // ========================================================================
    // GESTION DES PÉNALITÉS (Membres + Admin)
    // ========================================================================
    
    Route::prefix('penalties')->name('penalties.')->group(function () {
        // Liste des pénalités (admin = tous, membre = ses pénalités)
        Route::get('/', [PenaltyController::class, 'index'])->name('index');
        
        // Pénalités non payées
        Route::get('/unpaid', [PenaltyController::class, 'unpaid'])->name('unpaid');
        
        // Statistiques des pénalités
        Route::get('/statistics', [PenaltyController::class, 'statistics'])->name('statistics');
        
        // Détails d'une pénalité
        Route::get('/{penalty}', [PenaltyController::class, 'show'])->name('show');
        
        // Pénalités d'un membre spécifique
        Route::get('/member/{membre}', [PenaltyController::class, 'memberPenalties'])->name('member');
        
        // Actions sur une pénalité (tous les utilisateurs auth)
        // Marquer une pénalité comme payée
        Route::post('/{penalty}/pay', [PenaltyController::class, 'markAsPaid'])->name('pay');
    });
});
