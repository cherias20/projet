<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PenaltyController;
use App\Http\Controllers\MemberController;
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
    
    // Détails complets d'un livre
    Route::get('/{book}', [BookController::class, 'show'])->name('show');
    
    // Recherche avancée de livres
    Route::get('/search', [BookController::class, 'search'])->name('search');
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
        // Formulaire pour créer un nouveau livre
        Route::get('/create', [BookController::class, 'create'])->name('create');
        
        // Enregistrer un nouveau livre en base de données
        Route::post('/', [BookController::class, 'store'])->name('store');
        
        // Formulaire pour éditer un livre
        Route::get('/{book}/edit', [BookController::class, 'edit'])->name('edit');
        
        // Mettre à jour un livre existant
        Route::put('/{book}', [BookController::class, 'update'])->name('update');
        
        // Supprimer un livre
        Route::delete('/{book}', [BookController::class, 'destroy'])->name('destroy');
    });

    // ========================================================================
    // ADMINISTRATION - GESTION DES AUTEURS (Admin seulement)
    // ========================================================================
    
    Route::middleware(['admin'])->prefix('admin/authors')->name('admin.authors.')->group(function () {
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

    // ========================================================================
    // GESTION DES EMPRUNTS (Admin + Membres)
    // ========================================================================
    
    Route::prefix('loans')->name('loans.')->group(function () {
        // Liste de tous les emprunts (paginée)
        Route::get('/', [LoanController::class, 'index'])->name('index');
        
        // Détails complets d'un emprunt
        Route::get('/{loan}', [LoanController::class, 'show'])->name('show');
        
        // Emprunts d'un membre spécifique
        Route::get('/member/{membre}', [LoanController::class, 'memberLoans'])->name('member');
        
        // ADMIN SEULEMENT - Créer/gérer emprunts
        Route::middleware(['admin'])->group(function () {
            // Formulaire pour créer un emprunt
            Route::get('/create', [LoanController::class, 'create'])->name('create');
            
            // Enregistrer un emprunt
            Route::post('/', [LoanController::class, 'store'])->name('store');
            
            // Liste des emprunts en retard
            Route::get('/overdue', [LoanController::class, 'getOverdueLoans'])->name('overdue');
        });

        // Actions sur un emprunt (tous les utilisateurs auth)
        // Renouveler un emprunt (max 3 fois)
        Route::post('/{loan}/renew', [LoanController::class, 'renewLoan'])->name('renew');
        
        // Retourner un livre au système
        Route::post('/{loan}/return', [LoanController::class, 'returnBook'])->name('return');
    });

    // ========================================================================
    // GESTION DES RÉSERVATIONS (Admin + Membres)
    // ========================================================================
    
    Route::prefix('reservations')->name('reservations.')->group(function () {
        // Liste de toutes les réservations
        Route::get('/', [ReservationController::class, 'index'])->name('index');
        
        // Détails d'une réservation
        Route::get('/{reservation}', [ReservationController::class, 'show'])->name('show');
        
        // Réservations d'un membre spécifique
        Route::get('/member/{membre}', [ReservationController::class, 'memberReservations'])->name('member');
        
        // Réservations en attente pour un livre
        Route::get('/book/{book}', [ReservationController::class, 'bookReservations'])->name('book');
        
        // ADMIN SEULEMENT - Créer des réservations
        Route::middleware(['admin'])->group(function () {
            // Formulaire pour créer une réservation
            Route::get('/create', [ReservationController::class, 'create'])->name('create');
            
            // Enregistrer une réservation
            Route::post('/', [ReservationController::class, 'store'])->name('store');
        });

        // Actions sur une réservation (tous les utilisateurs auth)
        // Vérifier la disponibilité et notifier si possible
        Route::post('/{reservation}/check', [ReservationController::class, 'checkAvailability'])->name('check');
        
        // Annuler une réservation
        Route::post('/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('cancel');
    });

    // ========================================================================
    // GESTION DES PÉNALITÉS (Admin + Membres)
    // ========================================================================
    
    Route::prefix('penalties')->name('penalties.')->group(function () {
        // Liste de toutes les pénalités
        Route::get('/', [PenaltyController::class, 'index'])->name('index');
        
        // Détails d'une pénalité
        Route::get('/{penalty}', [PenaltyController::class, 'show'])->name('show');
        
        // Pénalités d'un membre spécifique
        Route::get('/member/{membre}', [PenaltyController::class, 'memberPenalties'])->name('member');
        
        // Liste des pénalités non payées (Admin seulement)
        Route::middleware(['admin'])->get('/unpaid', [PenaltyController::class, 'getUnpaidPenalties'])->name('unpaid');
        
        // Statistiques des pénalités (Admin seulement)
        Route::middleware(['admin'])->get('/statistics', [PenaltyController::class, 'statistics'])->name('statistics');
        
        // Actions sur une pénalité (tous les utilisateurs auth)
        // Marquer une pénalité comme payée
        Route::post('/{penalty}/pay', [PenaltyController::class, 'markAsPaid'])->name('pay');
        
        // Remettre une pénalité (Admin seulement)
        Route::middleware(['admin'])->post('/{penalty}/remit', [PenaltyController::class, 'remit'])->name('remit');
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

});
