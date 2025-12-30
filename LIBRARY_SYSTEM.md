# Système de Gestion de Bibliothèque - Laravel

Un système complet de gestion de bibliothèque basé sur Laravel avec support pour la gestion des livres, auteurs, emprunts, réservations et pénalités.

## 🏗️ Architecture

### Base de Données (MLD)
- **LIVRES** : Catalogue des ouvrages
- **AUTEURS** : Gestion des auteurs (relation Many-to-Many avec les livres)
- **GENRES** : Classification par genres (relation Many-to-Many avec les livres)
- **EXEMPLAIRES** : Copies physiques des livres
- **MEMBRES** : Utilisateurs/abonnés de la bibliothèque
- **EMPRUNTS** : Gestion des prêts de livres
- **RÉSERVATIONS** : Réservation de livres non disponibles
- **PÉNALITÉS** : Suivi des amendes pour retards
- **PARAMÈTRES** : Configuration du système

### Modèles Eloquent

#### Book
```php
- belongsToMany(Author) // Relation Many-to-Many
- belongsToMany(Genre) // Relation Many-to-Many
- hasMany(Exemplaire)
- hasMany(Reservation)
- getAvailableCopiesCount() // Nombre de copies disponibles
- getTotalCopiesCount() // Total des copies
```

#### Author
```php
- belongsToMany(Book) // Relation Many-to-Many
```

#### Genre
```php
- belongsToMany(Book) // Relation Many-to-Many
```

#### Exemplaire
```php
- belongsTo(Book)
- hasMany(Loan)
- isAvailable() // Vérifier la disponibilité
- getCurrentLoan() // Emprunt actuel
```

#### Membre
```php
- hasMany(Loan)
- hasMany(Reservation)
- hasMany(Penalty)
- getActiveLoansCount()
- getPendingPenalties()
- isActive()
- getFullName()
```

#### Loan
```php
- belongsTo(Membre)
- belongsTo(Exemplaire)
- hasMany(Penalty)
- isOverdue() // Vérifier si retard
- getDaysOverdue() // Nombre de jours de retard
- canRenew() // Peut-on renouveler?
- renew() // Renouveler l'emprunt
- returnBook() // Retourner le livre
```

#### Reservation
```php
- belongsTo(Membre)
- belongsTo(Book)
- getWaitingCount() // Position dans la queue
- checkAvailability() // Vérifier disponibilité
- cancel() // Annuler la réservation
```

#### Penalty
```php
- belongsTo(Membre)
- belongsTo(Loan)
- markAsPaid() // Marquer comme payée
- isPaid() // Vérifier si payée
- createFromOverdueLoan() // Factory pour créer depuis un emprunt en retard
```

#### Parameter
```php
- get($key, $default) // Récupérer une valeur
- set($key, $value, $description) // Définir une valeur
```

## 📋 Contrôleurs

### BookController
- `index()` : Afficher tous les livres
- `show(Book)` : Détails d'un livre
- `search()` : Rechercher des livres
- `create()` : Formulaire création (Admin)
- `store()` : Enregistrer un livre (Admin)
- `edit(Book)` : Formulaire édition (Admin)
- `update(Book)` : Mettre à jour (Admin)
- `destroy(Book)` : Supprimer (Admin)

### AuthorController
- `index()` : Lister tous les auteurs
- `show(Author)` : Détails d'un auteur
- `create()` : Formulaire création (Admin)
- `store()` : Enregistrer un auteur (Admin)
- `edit(Author)` : Formulaire édition (Admin)
- `update(Author)` : Mettre à jour (Admin)
- `destroy(Author)` : Supprimer (Admin)

### LoanController
- `index()` : Lister tous les emprunts
- `show(Loan)` : Détails d'un emprunt
- `create()` : Formulaire création (Admin)
- `store()` : Enregistrer un emprunt (Admin)
- `renewLoan(Loan)` : Renouveler un emprunt
- `returnBook(Loan)` : Retourner un livre
- `memberLoans(Membre)` : Emprunts d'un membre
- `getOverdueLoans()` : Emprunts en retard (Admin)

### ReservationController
- `index()` : Lister les réservations
- `show(Reservation)` : Détails d'une réservation
- `create()` : Formulaire création (Admin)
- `store()` : Enregistrer une réservation (Admin)
- `cancel(Reservation)` : Annuler une réservation
- `checkAvailability(Reservation)` : Vérifier disponibilité
- `memberReservations(Membre)` : Réservations d'un membre
- `bookReservations(Book)` : Réservations d'un livre

### PenaltyController
- `index()` : Lister les pénalités
- `show(Penalty)` : Détails d'une pénalité
- `memberPenalties(Membre)` : Pénalités d'un membre
- `markAsPaid(Penalty)` : Marquer comme payée
- `getUnpaidPenalties()` : Pénalités non payées (Admin)
- `statistics()` : Statistiques des pénalités (Admin)
- `remit(Penalty)` : Remettre une pénalité (Admin)

### MemberController
- `index()` : Lister les membres (Admin)
- `show(Membre)` : Détails d'un membre
- `create()` : Formulaire création (Admin)
- `store()` : Enregistrer un membre (Admin)
- `edit(Membre)` : Formulaire édition (Admin)
- `update(Membre)` : Mettre à jour (Admin)
- `destroy(Membre)` : Supprimer (Admin)
- `suspend(Membre)` : Suspendre un membre (Admin)
- `activate(Membre)` : Activer un membre (Admin)

## 🔧 Service LibraryService

Le service `LibraryService` centralise la logique métier :

```php
// Créer un nouvel emprunt
$service->createLoan($memberId, $exemplairesId);

// Retourner un livre
$service->returnLoan($loan);

// Renouveler un emprunt
$service->renewLoan($loan);

// Créer une réservation
$service->createReservation($memberId, $bookId);

// Vérifier et notifier les réservations
$service->checkReservations($bookId);

// Générer les pénalités pour emprunts en retard
$service->generatePendingPenalties();

// Obtenir les statistiques
$service->getStatistics();

// Vérifier la disponibilité d'un livre
$service->getBookAvailability($bookId);
```

## 📁 Migrations

Les migrations créent automatiquement toutes les tables :

```bash
php artisan migrate
```

Les migrations incluent :
- `2025_01_01_create_books_table.php`
- `2025_01_02_create_authors_table.php`
- `2025_01_03_create_genres_table.php`
- `2025_01_04_create_book_author_table.php`
- `2025_01_05_create_book_genre_table.php`
- `2025_01_06_create_exemplaires_table.php`
- `2025_01_07_create_membres_table.php`
- `2025_01_08_create_emprunts_table.php`
- `2025_01_09_create_reservations_table.php`
- `2025_01_10_create_penalites_table.php`
- `2025_01_11_create_parametres_table.php`

## 🌱 Seeders et Factories

Générer des données de test :

```bash
php artisan db:seed
```

Les factories créent automatiquement :
- 10 genres
- 20 auteurs
- 30 livres avec relations auteur/genre
- 2-5 exemplaires par livre
- 15 membres
- 1 admin
- 8 emprunts
- Réservations aléatoires
- Paramètres de configuration

## 🛣️ Routes

### Routes Publiques
```
GET /books                    # Lister les livres
GET /books/{book}             # Détails d'un livre
GET /books/search             # Rechercher des livres
GET /authors                  # Lister les auteurs
GET /authors/{author}         # Détails d'un auteur
```

### Routes Authentifiées (Admin)
```
POST /admin/books             # Créer un livre
GET /admin/books/{book}/edit  # Éditer un livre
PUT /admin/books/{book}       # Mettre à jour un livre
DELETE /admin/books/{book}    # Supprimer un livre

POST /admin/authors           # Créer un auteur
GET /admin/authors/{author}/edit
PUT /admin/authors/{author}
DELETE /admin/authors/{author}

GET /admin/members            # Lister les membres
POST /admin/members           # Créer un membre
```

### Routes Authentifiées (Tous)
```
GET /loans                    # Lister les emprunts
GET /loans/{loan}             # Détails d'un emprunt
POST /loans/{loan}/renew      # Renouveler
POST /loans/{loan}/return     # Retourner

GET /reservations             # Lister les réservations
GET /reservations/{reservation}
POST /reservations/{reservation}/cancel

GET /penalties                # Lister les pénalités
GET /penalties/member/{membre}
POST /penalties/{penalty}/pay # Payer une pénalité
```

## ⚙️ Configuration des Paramètres

Les paramètres système peuvent être configurés via la table `parametres` :

```php
Parameter::set('loan_duration_days', '14');        // 14 jours
Parameter::set('max_renewals', '3');               // 3 renouvellements max
Parameter::set('daily_penalty_rate', '1.50');      // 1.50€ par jour de retard
Parameter::set('max_active_loans', '5');           // 5 emprunts actifs max
```

## 🔐 Authentification et Autorisation

Le système utilise deux rôles :
- **admin** : Gestion complète du système
- **membre** : Accès aux emprunts et réservations

Les middleware `auth` et `admin` contrôlent l'accès.

## 📊 Fonctionnalités Clés

### Gestion des Emprunts
- Durée configurable (défaut 14 jours)
- Renouvellement limité (défaut 3 fois)
- Détection automatique des retards
- Calcul de pénalités

### Gestion des Réservations
- File d'attente automatique
- Position dans la queue
- Notification de disponibilité
- Annulation avec réajustement des positions

### Gestion des Pénalités
- Calcul automatique des retards
- Tarif journalier configurable
- Suivi des paiements
- Statistiques de pénalités

### Recherche Avancée
- Par titre/résumé
- Par auteur
- Par genre
- Par éditeur

## 🚀 Installation Rapide

```bash
# 1. Cloner le projet
git clone ...

# 2. Installer les dépendances
composer install
npm install

# 3. Configurer l'environnement
cp .env.example .env
php artisan key:generate

# 4. Créer la base de données et migrer
php artisan migrate

# 5. Générer les données de test
php artisan db:seed

# 6. Démarrer le serveur
php artisan serve
npm run dev
```

## 📝 Exemple d'Utilisation

```php
use App\Services\LibraryService;
use App\Models\Book, Membre, Loan;

$service = new LibraryService();

// Créer un emprunt
$loan = $service->createLoan($memberId, $exemplairesId);

// Renouveler
$service->renewLoan($loan);

// Retourner et créer une pénalité si retard
$service->returnLoan($loan);

// Obtenir les stats
$stats = $service->getStatistics();
```

## 📧 Support

Pour toute question ou problème, veuillez contacter l'administrateur.

---

**Version** : 1.0.0  
**Dernière mise à jour** : 30 décembre 2025
