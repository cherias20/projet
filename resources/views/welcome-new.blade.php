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
            background: rgba(255, 255, 255, 0.95) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            color: #667eea !important;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .navbar-brand i {
            margin-right: 8px;
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
            background: rgba(0, 0, 0, 0.85);
            color: white;
            padding: 50px 0 20px 0;
        }

        footer h5 {
            color: #667eea;
            margin-bottom: 20px;
            font-weight: 600;
        }

        footer a {
            color: #999;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        footer a:hover {
            color: #667eea;
        }

        footer .list-unstyled li {
            margin-bottom: 10px;
        }

        footer .text-center {
            padding-top: 20px;
            border-top: 1px solid #333;
            margin-top: 30px;
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('authors.index') }}">Auteurs</a>
                    </li>
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
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5><i class="fas fa-book-reader"></i> Bibliothèque</h5>
                    <p class="text-muted small">Votre source de savoir et de découvertes littéraires depuis 2025.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Liens Rapides</h5>
                    <ul class="list-unstyled small">
                        <li><a href="{{ route('books.index') }}">Catalogue</a></li>
                        <li><a href="{{ route('authors.index') }}">Auteurs</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Contact</h5>
                    <p class="text-muted small">
                        📧 info@bibliotheque.local<br>
                        📞 +1 (555) 123-4567<br>
                        📍 123 Rue des Livres
                    </p>
                </div>
            </div>
            <div class="text-center text-muted small">
                <p>&copy; 2025 Bibliothèque. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
