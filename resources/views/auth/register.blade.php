<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Bibliothèque</title>
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
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        body::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
            border-radius: 50%;
        }

        .register-container {
            width: 100%;
            max-width: 550px;
            position: relative;
            z-index: 2;
        }

        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 60px rgba(30, 60, 114, 0.4);
            overflow: hidden;
            animation: slideInUp 0.6s ease;
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

        .register-header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 50px 30px;
            text-align: center;
            position: relative;
        }

        .register-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: -20%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .register-header::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: 0;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
            border-radius: 50%;
        }

        .register-header h1 {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 5px;
            letter-spacing: -0.5px;
            position: relative;
            z-index: 1;
        }

        .register-header i {
            font-size: 3.5rem;
            margin-bottom: 15px;
            display: block;
            position: relative;
            z-index: 1;
        }

        .register-header p {
            font-size: 1rem;
            opacity: 0.9;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .register-body {
            padding: 40px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            color: #1e3c72;
            font-weight: 700;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
        }

        .form-label i {
            color: #2a5298;
        }

        .form-control {
            border: 2px solid #e8eef5;
            border-radius: 12px;
            padding: 13px 16px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-control:focus {
            border-color: #2a5298;
            background: white;
            box-shadow: 0 0 0 4px rgba(42, 82, 152, 0.1);
            outline: none;
        }

        .form-control::placeholder {
            color: #999;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .terms-section {
            margin-bottom: 25px;
            padding: 16px;
            background: #f0f5fb;
            border-radius: 12px;
            border-left: 5px solid #2a5298;
        }

        .terms-section .form-check {
            margin-bottom: 0;
        }

        .form-check {
            display: flex;
            align-items: flex-start;
            margin-bottom: 0;
        }

        .form-check-input {
            border: 2px solid #e8eef5;
            cursor: pointer;
            width: 20px;
            height: 20px;
            margin: 3px 0 0 0;
            accent-color: #2a5298;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .form-check-input:checked {
            background-color: #2a5298;
            border-color: #2a5298;
            box-shadow: none;
        }

        .form-check-input:focus {
            border-color: #2a5298;
            box-shadow: 0 0 0 0.2rem rgba(42, 82, 152, 0.25);
        }

        .form-check-label {
            color: #555;
            font-size: 0.9rem;
            margin-left: 10px;
            cursor: pointer;
            margin-bottom: 0;
            line-height: 1.4;
        }

        .form-check-label a {
            color: #2a5298;
            text-decoration: none;
            font-weight: 600;
        }

        .form-check-label a:hover {
            text-decoration: underline;
        }

        .btn-register {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            border: none;
            padding: 14px 20px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1rem;
            width: 100%;
            transition: all 0.3s ease;
            cursor: pointer;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 8px 20px rgba(30, 60, 114, 0.25);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(30, 60, 114, 0.35);
            color: white;
        }

        .divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
            color: #999;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .divider::before,
        .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background: #e0e0e0;
        }

        .divider::before {
            left: 0;
        }

        .divider::after {
            right: 0;
        }

        .login-link {
            text-align: center;
            color: #555;
            font-size: 0.95rem;
        }

        .login-link a {
            color: #2a5298;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .login-link a:hover {
            color: #1e3c72;
            text-decoration: underline;
        }

        .error-message {
            color: #d32f2f;
            font-size: 0.85rem;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            background: #ffebee;
            border-radius: 8px;
            border-left: 4px solid #d32f2f;
        }

        .error-message i {
            flex-shrink: 0;
        }

        .error-alert {
            background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%);
            color: #c62828;
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            border-left: 5px solid #d32f2f;
            display: flex;
            gap: 12px;
            animation: slideInDown 0.4s ease;
        }

        .error-alert i {
            flex-shrink: 0;
            font-size: 1.2rem;
            margin-top: 2px;
        }

        .error-alert strong {
            display: block;
            margin-bottom: 5px;
        }

        .error-alert ul {
            margin: 0;
            padding-left: 20px;
            font-size: 0.9rem;
        }

        .error-alert li {
            margin-bottom: 3px;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .is-invalid {
            border-color: #d32f2f !important;
            background-color: #fffbfc !important;
        }

        @media (max-width: 480px) {
            .register-header {
                padding: 40px 25px;
            }

            .register-header h1 {
                font-size: 1.8rem;
            }

            .register-header i {
                font-size: 2.8rem;
            }

            .register-body {
                padding: 30px 25px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .form-group {
                margin-bottom: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <!-- Header -->
            <div class="register-header">
                <i class="fas fa-user-plus"></i>
                <h1>Inscription</h1>
                <p>Créez votre compte Bibliothèque</p>
            </div>

            <!-- Body -->
            <div class="register-body">
                @if ($errors->any())
                    <div class="error-alert">
                        <i class="fas fa-exclamation-circle"></i>
                        <div>
                            <strong>Erreurs d'inscription</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form action="{{ route('register.submit') }}" method="POST">
                    @csrf

                    <!-- Full Name -->
                    <div class="form-group">
                        <label for="name" class="form-label">
                            <i class="fas fa-user"></i> Nom complet
                        </label>
                        <input 
                            type="text" 
                            class="form-control @error('name') is-invalid @enderror" 
                            id="name" 
                            name="name" 
                            placeholder="Jean Dupont"
                            value="{{ old('name') }}"
                            required
                        >
                        @error('name')
                            <div class="error-message">
                                <i class="fas fa-times-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope"></i> Email
                        </label>
                        <input 
                            type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            id="email" 
                            name="email" 
                            placeholder="votre.email@exemple.com"
                            value="{{ old('email') }}"
                            required
                        >
                        @error('email')
                            <div class="error-message">
                                <i class="fas fa-times-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password Row -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock"></i> Mot de passe
                            </label>
                            <input 
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                id="password" 
                                name="password" 
                                placeholder="Minimum 8 caractères"
                                required
                            >
                            @error('password')
                                <div class="error-message">
                                    <i class="fas fa-times-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">
                                <i class="fas fa-lock"></i> Confirmer
                            </label>
                            <input 
                                type="password" 
                                class="form-control" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                placeholder="Confirmez le mot de passe"
                                required
                            >
                        </div>
                    </div>

                    <!-- Terms -->
                    <div class="terms-section">
                        <div class="form-check">
                            <input 
                                class="form-check-input @error('terms') is-invalid @enderror" 
                                type="checkbox" 
                                id="terms" 
                                name="terms"
                                required
                            >
                            <label class="form-check-label" for="terms">
                                J'accepte les <a href="{{ route('terms') }}">conditions d'utilisation</a> et la <a href="{{ route('privacy') }}">politique de confidentialité</a>
                            </label>
                        </div>
                        @error('terms')
                            <div class="error-message" style="margin-top: 8px;">
                                <i class="fas fa-times-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-register">
                        <i class="fas fa-user-check"></i> Créer mon compte
                    </button>
                </form>

                <!-- Divider -->
                <div class="divider">OU</div>

                <!-- Login Link -->
                <div class="login-link">
                    Vous avez déjà un compte ? <a href="{{ route('login') }}">Se connecter</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
