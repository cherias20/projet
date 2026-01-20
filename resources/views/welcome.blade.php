<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            color: #333;
        }

        /* Navigation */
        .navbar {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%) !important;
            box-shadow: 0 4px 20px rgba(30, 60, 114, 0.25);
            padding: 1rem 0;
        }

        .navbar-brand {
            color: white !important;
            font-size: 1.6rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .navbar-brand i {
            margin-right: 10px;
            font-size: 1.8rem;
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 500;
            font-size: 1rem;
            margin-left: 1.5rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar-nav .nav-link:hover {
            color: white !important;
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 3px;
            background: white;
            transition: width 0.3s ease;
            border-radius: 2px;
        }

        .navbar-nav .nav-link:hover::after {
            width: 100%;
        }

        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5) !important;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255,255,255,0.9%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        }

        .btn-login {
            background: white;
            color: #1e3c72;
            border: none;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-left: 1rem;
        }

        .btn-login:hover {
            background: #f0f0f0;
            color: #2a5298;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 150px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);
            animation: slideInDown 0.8s ease;
        }

        .hero p {
            font-size: 1.5rem;
            margin-bottom: 50px;
            opacity: 0.95;
            animation: slideInUp 0.8s ease 0.2s backwards;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            animation: slideInUp 0.8s ease 0.4s backwards;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Button Styles */
        .btn-primary-hero {
            background: white;
            border: none;
            color: #1e3c72;
            padding: 16px 40px;
            font-weight: 700;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 1.1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .btn-primary-hero:hover {
            background: #f0f0f0;
            color: #2a5298;
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .btn-secondary-hero {
            background: transparent;
            border: 2px solid white;
            color: white;
            padding: 14px 38px;
            font-weight: 700;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 1.1rem;
        }

        .btn-secondary-hero:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        /* Features Section */
        .features-section {
            padding: 100px 0;
            background: white;
        }

        .section-title {
            text-align: center;
            margin-bottom: 80px;
        }

        .section-title h2 {
            font-size: 2.8rem;
            font-weight: 800;
            color: #1e3c72;
            margin-bottom: 15px;
        }

        .section-title p {
            font-size: 1.2rem;
            color: #666;
        }

        .feature-card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            border: none;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            margin-bottom: 30px;
            text-align: center;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(30, 60, 114, 0.15);
        }

        .feature-card i {
            font-size: 3.5rem;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 20px;
            display: block;
        }

        .feature-card h3 {
            color: #1e3c72;
            margin-bottom: 15px;
            font-weight: 700;
            font-size: 1.4rem;
        }

        .feature-card p {
            color: #666;
            font-size: 1rem;
            line-height: 1.6;
        }

        /* Stats Section */
        .stats-section {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            padding: 100px 0;
            color: white;
            margin: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .stats-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: -50%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .stat-box {
            text-align: center;
            position: relative;
            z-index: 2;
            padding: 40px;
        }

        .stat-number {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
            font-weight: 500;
        }

        /* Categories Section */
        .categories-section {
            padding: 100px 0;
            background: #f8f9fa;
        }

        .category-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 280px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #1e3c72, #2a5298);
        }

        .category-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(30, 60, 114, 0.15);
        }

        .category-icon {
            font-size: 3rem;
            color: #1e3c72;
            margin-bottom: 20px;
        }

        .category-card h4 {
            color: #1e3c72;
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 1.2rem;
        }

        .category-card p {
            color: #666;
            font-size: 0.95rem;
            margin: 0;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            padding: 100px 0;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .cta-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .cta-content {
            position: relative;
            z-index: 2;
        }

        .cta-section h2 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .cta-section p {
            font-size: 1.3rem;
            margin-bottom: 50px;
            opacity: 0.95;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 80px 0 30px 0;
            margin-top: 0;
            box-shadow: 0 -4px 20px rgba(30, 60, 114, 0.1);
        }

        footer h5 {
            color: white;
            margin-bottom: 25px;
            font-weight: 800;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }

        footer h5 i {
            margin-right: 10px;
        }

        footer p {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.8;
            font-size: 0.95rem;
            margin-bottom: 20px;
        }

        footer a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            margin: 8px 0;
            padding: 5px 0;
        }

        footer a:hover {
            color: white;
            padding-left: 10px;
        }

        footer a i {
            margin-right: 8px;
            color: white;
        }

        footer .footer-col {
            margin-bottom: 30px;
        }

        footer .footer-bottom {
            padding: 30px 0 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 30px;
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
        }

        footer .social-links {
            display: flex;
            gap: 15px;
            margin-top: 25px;
            justify-content: center;
        }

        footer .social-links a {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transition: all 0.3s ease;
            margin: 0;
            padding: 0;
        }

        footer .social-links a:hover {
            background: white;
            color: #1e3c72;
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero {
                padding: 80px 0;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.2rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn-primary-hero,
            .btn-secondary-hero {
                width: 100%;
                justify-content: center;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .cta-section h2 {
                font-size: 2rem;
            }

            .stat-number {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-book-reader"></i> Bibliothèque
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('books.index') }}">Catalogue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">À propos</a>
                    </li>
                  
                    @if(session()->has('membre_id'))
                        <li class="nav-item dropdown ms-3">
                            <button class="btn btn-login dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle"></i> {{ session()->get('membre_nom') }}
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
                                    <a class="dropdown-item" href="{{ route('admin.loans.index') }}">
                                        <i class="fas fa-exchange-alt"></i> Mes emprunts
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('reservations.index') }}">
                                        <i class="fas fa-bookmark"></i> Mes réservations
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form-welcome').submit();">
                                        <i class="fas fa-sign-out-alt"></i> Déconnexion
                                    </a>
                                    <form id="logout-form-welcome" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item ms-3">
                            <a href="{{ route('login') }}" class="btn btn-login">
                                <i class="fas fa-sign-in-alt"></i> Connexion
                            </a>
                        </li>
                        <li class="nav-item ms-2">
                            <a href="{{ route('register') }}" class="btn btn-login">
                                <i class="fas fa-user-plus"></i> Inscription
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>
                    <i class="fas fa-book-open"></i> Découvrez Notre Bibliothèque
                </h1>
                <p>Explorez une collection exceptionnelle et trouvez vos prochains livres préférés</p>
                <div class="hero-buttons">
                    <a href="{{ route('books.index') }}" class="btn-primary-hero">
                        <i class="fas fa-search"></i> Consulter le Catalogue
                    </a>
                    @if(!session()->has('membre_id'))
                        <a href="{{ route('register') }}" class="btn-secondary-hero">
                            <i class="fas fa-user-plus"></i> S'inscrire Gratuitement
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="features-section">
        <div class="container">
            <div class="section-title">
                <h2>Pourquoi Nous Choisir ?</h2>
                <p>Les avantages de notre plateforme</p>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-book"></i>
                        <h3>5000+ Livres</h3>
                        <p>Une collection diverse et complète pour tous les goûts et tous les âges</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-lightning-bolt"></i>
                        <h3>Simple & Rapide</h3>
                        <p>Empruntez et réservez vos livres en quelques clics seulement</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-mobile-alt"></i>
                        <h3>Disponible 24/7</h3>
                        <p>Accédez à votre compte depuis n'importe quel appareil</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="stat-box">
                        <div class="stat-number">5000+</div>
                        <div class="stat-label">Livres</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-box">
                        <div class="stat-number">1200+</div>
                        <div class="stat-label">Auteurs</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-box">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">Genres</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-box">
                        <div class="stat-number">2000+</div>
                        <div class="stat-label">Membres</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="categories-section">
        <div class="container">
            <div class="section-title">
                <h2>Catégories Populaires</h2>
                <p>Explorez nos collections par genre</p>
            </div>
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="category-card">
                        <i class="fas fa-book-open category-icon"></i>
                        <h4>Romans</h4>
                        <p>Histoires captivantes et émotionnantes</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="category-card">
                        <i class="fas fa-flask category-icon"></i>
                        <h4>Sciences</h4>
                        <p>Découvrez le monde à travers la science</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="category-card">
                        <i class="fas fa-lightbulb category-icon"></i>
                        <h4>Développement</h4>
                        <p>Améliorez vos compétences et connaissances</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="category-card">
                        <i class="fas fa-child category-icon"></i>
                        <h4>Jeunesse</h4>
                        <p>Histoires magiques pour les enfants</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Prêt à Commencer ?</h2>
                <p>Rejoignez notre communauté de lecteurs passionnés</p>
                @if(!session()->has('membre_id'))
                    <div>
                        <a href="{{ route('register') }}" class="btn-primary-hero">
                            <i class="fas fa-user-plus"></i> S'inscrire Gratuitement
                        </a>
                    </div>
                @else
                    <div>
                        <a href="{{ route('books.index') }}" class="btn-primary-hero">
                            <i class="fas fa-arrow-right"></i> Commencer à Emprunter
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <!-- About -->
                <div class="col-md-4 footer-col">
                    <h5><i class="fas fa-book-reader"></i> Bibliothèque</h5>
                    <p>Votre source de savoir et de découvertes littéraires. Nous mettons à disposition une collection exceptionnelle de livres pour tous les âges.</p>
                </div>

                <!-- Quick Links -->
                <div class="col-md-4 footer-col">
                    <h5><i class="fas fa-link"></i> Liens Rapides</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('books.index') }}"><i class="fas fa-chevron-right"></i> Catalogue</a></li>
                        <li><a href="{{ route('about') }}"><i class="fas fa-chevron-right"></i> À propos</a></li>
                        <li><a href="{{ route('contact') }}"><i class="fas fa-chevron-right"></i> Contact</a></li>
                        <li><a href="{{ route('terms') }}"><i class="fas fa-chevron-right"></i> Conditions</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="col-md-4 footer-col">
                    <h5><i class="fas fa-envelope"></i> Contact</h5>
                    <p>
                        <i class="fas fa-envelope"></i> 
                        <a href="mailto:contact@bibliotheque.fr">contact@bibliotheque.fr</a>
                    </p>
                    <p>
                        <i class="fas fa-phone"></i> 
                        <a href="tel:+33123456789">+33 1 23 45 67 89</a>
                    </p>
                    <p>
                        <i class="fas fa-map-marker-alt"></i> 
                        123 Rue de la Bibliothèque, 75001 Paris
                    </p>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="social-links">
                    <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <p style="margin-top: 20px;">&copy; 2025 Bibliothèque. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
