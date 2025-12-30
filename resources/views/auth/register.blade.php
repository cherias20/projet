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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-container {
            width: 100%;
            max-width: 500px;
        }

        .register-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .register-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .register-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .register-header i {
            font-size: 3rem;
            margin-bottom: 15px;
            display: block;
        }

        .register-header p {
            font-size: 0.95rem;
            opacity: 0.9;
            margin: 0;
        }

        .register-body {
            padding: 40px 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            color: #333;
            font-weight: 600;
            margin-bottom: 10px;
            display: block;
            font-size: 0.95rem;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
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
            margin-bottom: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }

        .terms-section input {
            cursor: pointer;
        }

        .terms-section label {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0;
            cursor: pointer;
        }

        .terms-section a {
            color: #667eea;
            text-decoration: none;
        }

        .terms-section a:hover {
            text-decoration: underline;
        }

        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            width: 100%;
            transition: all 0.3s ease;
            cursor: pointer;
            margin-bottom: 15px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            color: white;
        }

        .divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
            color: #999;
            font-size: 0.9rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 35%;
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
            color: #666;
            font-size: 0.95rem;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .login-link a:hover {
            color: #764ba2;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 5px;
            display: flex;
            align-items: center;
        }

        .error-message i {
            margin-right: 5px;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        @media (max-width: 480px) {
            .register-header {
                padding: 30px 20px;
            }

            .register-header h1 {
                font-size: 1.5rem;
            }

            .register-header i {
                font-size: 2rem;
            }

            .register-body {
                padding: 30px 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
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
                    <div style="background: #f8d7da; color: #721c24; padding: 12px 15px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #dc3545;">
                        <strong>Erreurs :</strong>
                        <ul style="margin: 5px 0 0 0; padding-left: 20px; font-size: 0.85rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
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
                                J'accepte les <a href="#">conditions d'utilisation</a> et la <a href="#">politique de confidentialité</a>
                            </label>
                        </div>
                        @error('terms')
                            <div class="error-message">
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
