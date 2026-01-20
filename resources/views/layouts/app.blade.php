<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bibliothèque')</title>
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
            min-height: calc(100vh - 70px - 400px);
        }

        /* Footer Styles */
        .footer-app {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 3rem 0 0;
            margin-top: 4rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            padding: 3rem 0;
        }

        .footer-section {
            padding: 0 1rem;
        }

        .footer-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
        }

        .footer-section p {
            font-size: 0.9rem;
            opacity: 0.85;
            line-height: 1.6;
            margin-bottom: 0;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-links a:hover {
            color: white;
            transform: translateX(5px);
        }

        .footer-hours {
            list-style: none;
            padding: 0;
            margin: 0;
            font-size: 0.9rem;
        }

        .footer-hours li {
            margin-bottom: 0.8rem;
            opacity: 0.85;
            line-height: 1.5;
        }

        .footer-hours strong {
            color: white;
            opacity: 1;
        }

        .footer-divider {
            height: 1px;
            background: rgba(255, 255, 255, 0.1);
            margin: 1rem 0;
        }

        .footer-bottom {
            padding: 1.5rem 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .footer-bottom p {
            margin: 0;
        }

        .footer-social {
            display: flex;
            gap: 1rem;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            color: white;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .social-icon:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-3px);
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

        .btn-secondary {
            background: #636e72;
            color: white;
        }

        .btn-secondary:hover {
            background: #2d3436;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 110, 114, 0.3);
            color: white;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <!-- Navbar Moderne -->
    <nav class="navbar navbar-expand-lg navbar-app">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-book-open"></i> Bibliothèque
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('books.index') }}">
                            <i class="fas fa-book"></i> Livres
                        </a>
                    </li>
                    
                    
                    @if(session()->has('membre_id'))
                        @if(session()->get('membre_role') === 'admin')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                    <i class="fas fa-cog"></i> Admin
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.books.index') }}"><i class="fas fa-book"></i> Gestion des Livres</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.authors.index') }}"><i class="fas fa-pen-fancy"></i> Gestion des Auteurs</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.genres.index') }}"><i class="fas fa-tag"></i> Gestion des Genres</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.members.index') }}"><i class="fas fa-users"></i> Gestion des Membres</a></li>
                                </ul>
                            </li>
                        @endif
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="fas fa-exchange-alt"></i> Emprunts
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('loans.index') }}"><i class="fas fa-list"></i> Mes emprunts</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="{{ route('reservations.index') }}" data-bs-toggle="dropdown">
                                <i class="fas fa-bookmark"></i> Réservations
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('reservations.index') }}"><i class="fas fa-list"></i> Mes réservations</a></li>
                            </ul>
                        </li>

                        <!-- Avatar Dropdown -->
                        <li class="nav-item dropdown">
                            <button class="avatar-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="{{ session()->get('membre_nom') }}">
                                <i class="fas fa-user"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <span class="dropdown-item-text">
                                        <strong>{{ session()->get('membre_nom') }}</strong><br>
                                        <small class="text-muted">{{ session()->get('membre_email') }}</small>
                                    </span>
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
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> Connexion
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i> Inscription
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-lg">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-app">
        <div class="container-lg">
            <div class="footer-grid">
                <div class="footer-section">
                    <h5 class="footer-title"><i class="fas fa-book"></i> Bibliothèque</h5>
                    <p>Votre source complète pour découvrir, emprunter et réserver des livres. Accédez à une collection diverse et constamment mise à jour.</p>
                </div>
                <div class="footer-section">
                    <h5 class="footer-title"><i class="fas fa-link"></i> Liens Rapides</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('books.index') }}"><i class="fas fa-book-open"></i> Catalogue</a></li>
                        @if(session()->has('membre_id'))
                            <li><a href="{{ route('admin.loans.index') }}"><i class="fas fa-exchange-alt"></i> Emprunts</a></li>
                            <li><a href="{{ route('reservations.index') }}"><i class="fas fa-bookmark"></i> Réservations</a></li>
                        @else
                            <li><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Connexion</a></li>
                            <li><a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Inscription</a></li>
                        @endif
                    </ul>
                </div>
                <div class="footer-section">
                    <h5 class="footer-title"><i class="fas fa-info-circle"></i> Informations</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('about') }}"><i class="fas fa-question-circle"></i> À propos</a></li>
                        <li><a href="{{ route('contact') }}"><i class="fas fa-phone"></i> Contact</a></li>
                        <li><a href="{{ route('terms') }}"><i class="fas fa-file-alt"></i> Conditions</a></li>
                        <li><a href="{{ route('privacy') }}"><i class="fas fa-lock"></i> Confidentialité</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h5 class="footer-title"><i class="fas fa-clock"></i> Horaires</h5>
                    <ul class="footer-hours">
                        <li><strong>Lundi - Vendredi:</strong> 9h - 19h</li>
                        <li><strong>Samedi:</strong> 10h - 18h</li>
                        <li><strong>Dimanche:</strong> Fermé</li>
                    </ul>
                </div>
            </div>
            <div class="footer-divider"></div>
            <div class="footer-bottom">
                <p>&copy; 2026 Bibliothèque. Tous droits réservés.</p>
                <div class="footer-social">
                    <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
