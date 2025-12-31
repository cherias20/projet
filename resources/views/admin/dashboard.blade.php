<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Bibliothèque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --text-dark: #2d3436;
            --text-light: #636e72;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f6fa;
            color: var(--text-dark);
        }

        .navbar-app {
            background: var(--primary-gradient);
            box-shadow: 0 2px 15px rgba(102, 126, 234, 0.15);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-app .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: white !important;
            letter-spacing: -0.5px;
        }

        .navbar-app .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 500;
            margin: 0 8px;
            padding: 8px 12px !important;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .navbar-app .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: white !important;
            transform: translateY(-2px);
        }

        .avatar-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.25);
            border: 2px solid rgba(255, 255, 255, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 0;
            margin-left: 15px;
        }

        .avatar-btn:hover {
            background: rgba(255, 255, 255, 0.35);
            border-color: white;
            transform: scale(1.1);
        }

        .dropdown-menu {
            border: none;
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            margin-top: 8px;
            min-width: 200px;
        }

        .dropdown-item {
            padding: 12px 18px;
            border-radius: 6px;
            margin: 4px 8px;
            transition: all 0.2s ease;
            color: var(--text-dark);
            font-weight: 500;
        }

        .dropdown-item:hover {
            background: var(--primary-gradient);
            color: white;
            transform: translateX(4px);
        }

        .main-content {
            padding: 30px 20px;
            min-height: calc(100vh - 70px);
        }

        .container-lg {
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .page-title i {
            color: #667eea;
        }

        .page-subtitle {
            color: var(--text-light);
            font-size: 0.95rem;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .stat-card:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
            transform: translateY(-4px);
        }

        .stat-card h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 0;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
        }

        .card-header {
            background: var(--primary-gradient);
            color: white;
            border: none;
            font-weight: 600;
            padding: 20px;
            font-size: 1.1rem;
        }

        .btn {
            border-radius: 8px;
            font-weight: 600;
            padding: 10px 20px;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: var(--primary-gradient);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
            color: white;
        }

        .btn-success {
            background: #51cf66;
            color: white;
        }

        .btn-success:hover {
            background: #37b24d;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(81, 207, 102, 0.3);
        }

        .btn-warning {
            background: #ffd43b;
            color: #1c1c1c;
        }

        .btn-warning:hover {
            background: #ffc220;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 212, 59, 0.3);
        }
    </style>
</head>
<body>
    <!-- Navbar Moderne -->
    <nav class="navbar navbar-expand-lg navbar-app">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-book-open"></i> Bibliothèque
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="fas fa-pen-fancy"></i> Auteurs
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.authors.index') }}"><i class="fas fa-list"></i> Liste</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.authors.create') }}"><i class="fas fa-plus"></i> Ajouter</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="fas fa-book"></i> Livres
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.books.index') }}"><i class="fas fa-list"></i> Liste</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.books.create') }}"><i class="fas fa-plus"></i> Ajouter</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="fas fa-tag"></i> Genres
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.genres.index') }}"><i class="fas fa-list"></i> Liste</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.genres.create') }}"><i class="fas fa-plus"></i> Ajouter</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="fas fa-exchange-alt"></i> Emprunts
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('loans.index') }}"><i class="fas fa-list"></i> Liste</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="fas fa-users"></i> Membres
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.members.index') }}"><i class="fas fa-list"></i> Liste</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="fas fa-bookmark"></i> Réservations
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('reservations.index') }}"><i class="fas fa-list"></i> Liste</a></li>
                        </ul>
                    </li>

                    <!-- Avatar Dropdown -->
                    <li class="nav-item dropdown">
                        <button class="avatar-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="{{ session('membre_nom', 'Admin') }}">
                            <i class="fas fa-user"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <span class="dropdown-item-text">
                                    <strong>{{ session('membre_nom', 'Admin') }}</strong><br>
                                    <small class="text-muted">{{ session('membre_email', 'admin@exemple.com') }}</small>
                                </span>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('books.index') }}">
                                    <i class="fas fa-arrow-left"></i> Retour à la Bibliothèque
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}" 
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-lg">
            <div class="row mb-4">
                <div class="col">
                    <h1 class="page-title">
                        <i class="fas fa-tachometer-alt"></i> Tableau de Bord Admin
                    </h1>
                    <p class="page-subtitle">Bienvenue, <strong>{{ session('membre_nom') }}</strong> ! Voici un aperçu des statistiques de la bibliothèque.</p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <!-- Livres -->
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-1">Total Livres</p>
                                    <h2 class="mb-0">{{ DB::table('books')->count() }}</h2>
                                </div>
                                <div style="font-size: 2rem; color: #667eea; opacity: 0.2;">
                                    <i class="fas fa-book"></i>
                                </div>
                            </div>
                            <small class="text-muted">Livres disponibles</small>
                        </div>
                    </div>
                </div>

                <!-- Membres -->
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-1">Total Membres</p>
                                    <h2 class="mb-0">{{ DB::table('membres')->count() }}</h2>
                                </div>
                                <div style="font-size: 2rem; color: #51cf66; opacity: 0.2;">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <small class="text-muted">Comptes actifs</small>
                        </div>
                    </div>
                </div>

                <!-- Emprunts -->
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-1">Emprunts Actifs</p>
                                    <h2 class="mb-0">{{ DB::table('emprunts')->where('statut', 'en_cours')->count() }}</h2>
                                </div>
                                <div style="font-size: 2rem; color: #ffd43b; opacity: 0.2;">
                                    <i class="fas fa-exchange-alt"></i>
                                </div>
                            </div>
                            <small class="text-muted">En cours</small>
                        </div>
                    </div>
                </div>

                <!-- Réservations -->
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-1">Réservations</p>
                                    <h2 class="mb-0">{{ DB::table('reservations')->count() }}</h2>
                                </div>
                                <div style="font-size: 2rem; color: #ff6b6b; opacity: 0.2;">
                                    <i class="fas fa-bookmark"></i>
                                </div>
                            </div>
                            <small class="text-muted">En attente</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-lightning-bolt"></i> Actions Rapides
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <a href="{{ route('books.index') }}" class="btn btn-primary w-100">
                                        <i class="fas fa-book"></i> Gérer les Livres
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="{{ route('authors.index') }}" class="btn btn-success w-100">
                                        <i class="fas fa-pen-fancy"></i> Gérer les Auteurs
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="{{ route('loans.index') }}" class="btn btn-warning w-100">
                                        <i class="fas fa-exchange-alt"></i> Gérer les Emprunts
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <a href="#" class="btn btn-info w-100">
                                        <i class="fas fa-bookmark"></i> Réservations
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="#" class="btn btn-secondary w-100">
                                        <i class="fas fa-tag"></i> Genres
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="#" class="btn btn-dark w-100">
                                        <i class="fas fa-users"></i> Membres
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
