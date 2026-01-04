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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        /* Navigation */
        .navbar {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.98) 0%, rgba(118, 75, 162, 0.98) 100%) !important;
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
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
            color: #667eea;
            border: none;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-left: 1rem;
        }

        .btn-login:hover {
            background: #f0f0f0;
            color: #764ba2;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            color: white;
            padding: 120px 0;
            text-align: center;
            margin-bottom: 60px;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 40px;
            opacity: 0.95;
        }

        .hero i {
            margin-right: 10px;
        }

        /* Button Styles */
        .btn-hero {
            background: white;
            border: none;
            color: #667eea;
            padding: 14px 35px;
            font-weight: 600;
            border-radius: 50px;
            display: inline-block;
            transition: all 0.3s ease;
            text-decoration: none;
            margin: 10px;
        }

        .btn-hero:hover {
            background: #f0f0f0;
            color: #764ba2;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        /* Features Section */
        .features-section {
            background: white;
            padding: 80px 0;
            margin-bottom: 60px;
        }

        .feature-card {
            text-align: center;
            padding: 30px 20px;
            border-radius: 10px;
            transition: all 0.3s ease;
            background: #f8f9fa;
            border: 1px solid #e0e0e0;
            margin-bottom: 30px;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.15);
            border-color: #667eea;
        }

        .feature-card i {
            font-size: 2.5rem;
            color: #667eea;
            margin-bottom: 20px;
        }

        .feature-card h3 {
            color: #333;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .feature-card p {
            color: #666;
            font-size: 0.95rem;
        }

        /* Stats Section */
        .stats-section {
            background: rgba(255, 255, 255, 0.95);
            padding: 60px 0;
            margin-bottom: 60px;
            border-radius: 10px;
        }

        .stat-box {
            text-align: center;
            padding: 30px;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 10px;
        }

        .stat-label {
            color: #666;
            font-weight: 500;
        }

        /* CTA Section */
        .cta-section {
            background: rgba(255, 255, 255, 0.1);
            padding: 80px 0;
            text-align: center;
            color: white;
            margin-bottom: 60px;
        }

        .cta-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .cta-section p {
            font-size: 1.1rem;
            margin-bottom: 40px;
            opacity: 0.95;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #0f0f1e 0%, #1a1a2e 50%, #16213e 100%);
            color: white;
            padding: 0;
            margin-top: 100px;
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 50%, #667eea 100%);
        }

        footer::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100px;
            background: radial-gradient(circle at 20% 50%, rgba(102, 126, 234, 0.1) 0%, transparent 50%),
                        radial-gradient(circle at 80% 80%, rgba(118, 75, 162, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        footer .footer-content {
            padding: 80px 0 40px 0;
            position: relative;
            z-index: 1;
        }

        footer .footer-col {
            margin-bottom: 40px;
        }

        footer h5 {
            color: #667eea;
            margin-bottom: 30px;
            font-weight: 800;
            font-size: 1.3rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            position: relative;
            padding-bottom: 15px;
        }

        footer h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            border-radius: 2px;
        }

        footer i {
            color: #667eea;
            margin-right: 12px;
            font-size: 1.2rem;
        }

        footer p {
            color: #b0b0b0;
            line-height: 1.9;
            font-size: 0.95rem;
            margin: 0;
        }

        footer a {
            color: #b0b0b0;
            text-decoration: none;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            display: block;
            position: relative;
            padding: 8px 0;
            margin: 5px 0;
        }

        footer a::before {
            content: '';
            position: absolute;
            left: -10px;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 0;
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
            transition: height 0.35s ease;
            border-radius: 2px;
        }

        footer a:hover {
            color: #667eea;
            padding-left: 10px;
        }

        footer a:hover::before {
            height: 20px;
        }

        footer .list-unstyled li {
            margin-bottom: 8px;
        }

        footer .contact-info {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        footer .contact-item {
            display: flex;
            align-items: center;
            color: #b0b0b0;
            font-size: 0.95rem;
        }

        footer .contact-item i {
            min-width: 25px;
            color: #667eea;
        }

        footer .footer-bottom {
            padding: 30px 0;
            border-top: 1px solid rgba(102, 126, 234, 0.15);
            margin-top: 40px;
            position: relative;
            z-index: 1;
            text-align: center;
        }

        footer .footer-bottom p {
            margin: 0;
            font-size: 0.9rem;
            color: #808080;
        }

        footer .social-links {
            display: flex;
            gap: 20px;
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
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            transition: all 0.3s ease;
            padding: 0 !important;
            margin: 0 !important;
        }

        footer .social-links a:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        footer .social-links a::before {
            display: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero {
                padding: 60px 0;
                margin-bottom: 40px;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .features-section {
                padding: 40px 0;
            }

            .stat-number {
                font-size: 2rem;
            }

            .cta-section {
                padding: 40px 0;
            }

            .cta-section h2 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('books.index') }}">
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
                                    <a class="dropdown-item" href="{{ route('loans.index') }}">
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
            <h1>
                <i class="fas fa-book-open"></i> Bienvenue à la Bibliothèque
            </h1>
            <p>Découvrez notre collection exceptionnelle de livres</p>
            <div>
                <a href="{{ route('books.index') }}" class="btn-hero">
                    <i class="fas fa-search"></i> Consulter le Catalogue
                </a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="features-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-book"></i>
                        <h3>Large Collection</h3>
                        <p>Des milliers de livres disponibles pour tous les goûts et tous les âges</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-hand-holding-heart"></i>
                        <h3>Emprunts Faciles</h3>
                        <p>Empruntez rapidement et facilement vos livres préférés en quelques clics</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <i class="fas fa-calendar-check"></i>
                        <h3>Gestion Simplifiée</h3>
                        <p>Suivi des emprunts, réservations et renouvellement depuis votre compte</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="container">
        <div class="stats-section">
            <div class="row">
                <div class="col-md-3">
                    <div class="stat-box">
                        <div class="stat-number">5000+</div>
                        <div class="stat-label">Livres Disponibles</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-box">
                        <div class="stat-number">1200+</div>
                        <div class="stat-label">Auteurs</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-box">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">Genres</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-box">
                        <div class="stat-number">2000+</div>
                        <div class="stat-label">Membres Actifs</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-section">
        <div class="container">
            <h2>Prêt à commencer ?</h2>
            <p>Explorez notre catalogue complet et trouvez votre prochain livre</p>
            <a href="{{ route('books.index') }}" class="btn-hero">
                <i class="fas fa-arrow-right"></i> Commencer
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container footer-content">
            <div class="row">
                <!-- About -->
                <div class="col-md-4 footer-col">
                    <h5><i class="fas fa-book-reader"></i> Bibliothèque</h5>
                    <p>Votre source de savoir et de découvertes littéraires depuis 2025. Nous proposons une collection exceptionnelle de livres pour tous les âges et tous les goûts.</p>
                </div>

                <!-- Quick Links -->
                <div class="col-md-4 footer-col">
                    <h5><i class="fas fa-link"></i> Liens Rapides</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('books.index') }}"><i class="fas fa-chevron-right"></i> Catalogue</a></li>
                        <li><a href="{{ route('authors.index') }}"><i class="fas fa-chevron-right"></i> Auteurs</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> À propos</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Support</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="col-md-4 footer-col">
                    <h5><i class="fas fa-envelope"></i> Contact</h5>
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>info@bibliotheque.local</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span>+1 (555) 123-4567</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>123 Rue des Livres</span>
                        </div>
                    </div>
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
                <p style="margin-top: 20px;">&copy; 2025 Bibliothèque. Tous droits réservés. | Design professionnel</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
