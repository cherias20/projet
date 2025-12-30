<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bibliothèque') - Système de Gestion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --text-dark: #2d3436;
            --text-light: #636e72;
            --bg-light: #f8f9fa;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f5f6fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-dark);
        }

        /* Navbar Moderne */
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
            position: relative;
        }

        .navbar-app .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: white !important;
            transform: translateY(-2px);
        }

        .user-info {
            background: rgba(255, 255, 255, 0.1);
            padding: 10px 15px;
            border-radius: 8px;
            margin-right: 15px;
            backdrop-filter: blur(10px);
        }

        .user-info .user-name {
            font-weight: 600;
            color: white;
            display: block;
            font-size: 0.95rem;
            margin-bottom: 2px;
        }

        .user-info .user-email {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.75);
        }

        /* Avatar Dropdown */
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
        }

        .avatar-btn:hover {
            background: rgba(255, 255, 255, 0.35);
            border-color: white;
            transform: scale(1.1);
        }

        .avatar-btn::after {
            margin-left: 0;
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

        .dropdown-divider {
            margin: 4px 0;
            opacity: 0.2;
        }

        /* Main Content */
        .main-content {
            padding: 30px 20px;
            min-height: calc(100vh - 70px);
        }

        .container-lg {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            margin-bottom: 25px;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
            transform: translateY(-4px);
        }

        .card-header {
            background: var(--primary-gradient);
            color: white;
            border: none;
            font-weight: 600;
            padding: 20px;
            font-size: 1.1rem;
        }

        .card-body {
            padding: 25px;
        }

        /* Buttons */
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
            background: var(--primary-gradient);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-danger {
            background: #ff6b6b;
            color: white;
        }

        .btn-danger:hover {
            background: #ee5a52;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 107, 0.3);
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

        /* Tables */
        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: #f1f3f5;
            border: none;
            font-weight: 700;
            color: var(--text-dark);
            padding: 15px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody td {
            padding: 15px;
            border-color: #e9ecef;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
        }

        /* Badges */
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .badge-success {
            background: #51cf66;
            color: white;
        }

        .badge-warning {
            background: #ffd43b;
            color: #1c1c1c;
        }

        .badge-danger {
            background: #ff6b6b;
            color: white;
        }

        /* Page Title */
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

        /* Forms */
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            padding: 10px 15px;
            font-size: 0.95rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                padding: 15px;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .user-info {
                margin-right: 0;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar Moderne -->
    <nav class="navbar navbar-expand-lg navbar-app">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('books.index') }}">
                <i class="fas fa-book-open"></i> Bibliothèque
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    @if(session('membre_id'))
                        <!-- Navigation Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('books.index') }}">
                                <i class="fas fa-book"></i> Catalogue
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('loans.index') }}">
                                <i class="fas fa-exchange-alt"></i> Emprunts
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reservations.index') }}">
                                <i class="fas fa-bookmark"></i> Réservations
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('penalties.index') }}">
                                <i class="fas fa-receipt"></i> Pénalités
                            </a>
                        </li>

                        <!-- Dropdown Avatar à la fin -->
                        <li class="nav-item dropdown ms-3">
                            <button class="avatar-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="{{ session('membre_nom', 'Membre') }}">
                                <i class="fas fa-user"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <span class="dropdown-item-text">
                                        <strong>{{ session('membre_nom', 'Membre') }}</strong><br>
                                        <small class="text-muted">{{ session('membre_email', 'user@email.com') }}</small>
                                    </span>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user-circle"></i> Mon Profil
                                    </a>
                                </li>
                                @if(session('is_admin'))
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            <i class="fas fa-tachometer-alt"></i> Tableau de Bord Admin
                                        </a>
                                    </li>
                                @endif
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
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong><i class="fas fa-exclamation-circle"></i> Erreur!</strong>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
