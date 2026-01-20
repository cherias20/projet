@extends('layouts.app')

@section('title', 'Nous contacter')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: white;
        padding: 3rem 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 15px 40px rgba(30, 60, 114, 0.25);
    }

    .page-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 15px;
        letter-spacing: -0.5px;
    }

    .contact-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    @media (max-width: 768px) {
        .contact-container {
            grid-template-columns: 1fr;
        }
    }

    .contact-info {
        background: white;
        border-radius: 15px;
        padding: 2.5rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    .contact-info h2 {
        color: #1e3c72;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding-bottom: 0.8rem;
        border-bottom: 3px solid #2a5298;
    }

    .contact-item {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 2rem;
        align-items: flex-start;
    }

    .contact-item i {
        font-size: 1.5rem;
        color: #1e3c72;
        margin-top: 0.3rem;
        flex-shrink: 0;
    }

    .contact-item-content h4 {
        color: #333;
        font-weight: 700;
        margin: 0 0 0.3rem 0;
    }

    .contact-item-content p {
        color: #666;
        margin: 0;
    }

    .contact-item-content a {
        color: #2a5298;
        text-decoration: none;
        font-weight: 600;
    }

    .contact-item-content a:hover {
        text-decoration: underline;
    }

    .contact-form {
        background: white;
        border-radius: 15px;
        padding: 2.5rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    .contact-form h2 {
        color: #1e3c72;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding-bottom: 0.8rem;
        border-bottom: 3px solid #2a5298;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        color: #333;
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 0.8rem;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-family: inherit;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #2a5298;
        box-shadow: 0 0 0 3px rgba(42, 82, 152, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 120px;
    }

    .submit-btn {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: white;
        padding: 0.8rem 2rem;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(30, 60, 114, 0.3);
    }

    .hours-badge {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
        padding: 1rem;
        border-radius: 8px;
        margin-top: 1.5rem;
    }

    .hours-badge h5 {
        margin: 0 0 0.8rem 0;
        font-weight: 700;
    }

    .hours-badge p {
        margin: 0.3rem 0;
        font-size: 0.95rem;
    }
</style>

<div class="page-header">
    <h1>
        <i class="fas fa-envelope"></i>
        Nous contacter
    </h1>
</div>

<div class="contact-container">
    <!-- Informations de contact -->
    <div class="contact-info">
        <h2>Informations de Contact</h2>

        <div class="contact-item">
            <i class="fas fa-map-marker-alt"></i>
            <div class="contact-item-content">
                <h4>Adresse</h4>
                <p>123 Rue de la Bibliothèque<br>75001 Paris, France</p>
            </div>
        </div>

        <div class="contact-item">
            <i class="fas fa-phone"></i>
            <div class="contact-item-content">
                <h4>Téléphone</h4>
                <p><a href="tel:+33123456789">+33 1 23 45 67 89</a></p>
            </div>
        </div>

        <div class="contact-item">
            <i class="fas fa-envelope"></i>
            <div class="contact-item-content">
                <h4>Email</h4>
                <p><a href="mailto:contact@bibliotheque.fr">contact@bibliotheque.fr</a></p>
            </div>
        </div>

        <div class="contact-item">
            <i class="fas fa-globe"></i>
            <div class="contact-item-content">
                <h4>Site Web</h4>
                <p><a href="#">www.bibliotheque.fr</a></p>
            </div>
        </div>

        <div class="hours-badge">
            <h5><i class="fas fa-clock"></i> Horaires d'ouverture</h5>
            <p><strong>Lundi - Vendredi:</strong> 9h00 - 19h00</p>
            <p><strong>Samedi:</strong> 10h00 - 18h00</p>
            <p><strong>Dimanche:</strong> Fermé</p>
        </div>
    </div>

    <!-- Formulaire de contact -->
    <div class="contact-form">
        <h2>Envoyez-nous un message</h2>
        <p style="color: #666; margin-bottom: 1.5rem;">
            Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais.
        </p>

        <form>
            <div class="form-group">
                <label for="name">Nom complet</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="subject">Sujet</label>
                <input type="text" id="subject" name="subject" required>
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" required></textarea>
            </div>

            <button type="submit" class="submit-btn">
                <i class="fas fa-paper-plane"></i> Envoyer le message
            </button>
        </form>

        <p style="color: #999; font-size: 0.9rem; margin-top: 1rem; text-align: center;">
            Nous respectons votre vie privée. Consultez notre <a href="{{ route('privacy') }}" style="color: #2a5298;">politique de confidentialité</a>.
        </p>
    </div>
</div>

@endsection
