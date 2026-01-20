@extends('layouts.app')

@section('title', 'À propos de nous')

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

    .page-content {
        background: white;
        border-radius: 15px;
        padding: 2.5rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
        line-height: 1.8;
    }

    .page-content h2 {
        color: #1e3c72;
        font-size: 1.8rem;
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1rem;
        padding-bottom: 0.8rem;
        border-bottom: 3px solid #2a5298;
    }

    .page-content h2:first-child {
        margin-top: 0;
    }

    .page-content p {
        color: #555;
        font-size: 1.05rem;
        margin-bottom: 1rem;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin: 2rem 0;
    }

    .feature-card {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        padding: 1.5rem;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .feature-card i {
        font-size: 2.5rem;
        color: #1e3c72;
        margin-bottom: 1rem;
        display: block;
    }

    .feature-card h4 {
        color: #1e3c72;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .feature-card p {
        color: #666;
        font-size: 0.95rem;
        margin: 0;
    }
</style>

<div class="page-header">
    <h1>
        <i class="fas fa-info-circle"></i>
        À propos de nous
    </h1>
</div>

<div class="page-content">
    <h2>Bienvenue à notre Bibliothèque</h2>
    <p>
        Notre bibliothèque est un lieu de savoir, de découverte et de culture, ouvert à tous. 
        Fondée avec la mission de promouvoir la lecture et l'accès à l'information pour tous, 
        nous nous engageons à fournir une collection riche et variée de ressources documentaires.
    </p>

    <h2>Notre Mission</h2>
    <p>
        Nous croyons fermement que l'accès à l'information est un droit fondamental. Notre mission est de :
    </p>
    <ul style="color: #555; font-size: 1.05rem;">
        <li><strong>Promouvoir la lecture</strong> et l'apprentissage tout au long de la vie</li>
        <li><strong>Fournir l'accès</strong> à une large gamme de ressources documentaires et numériques</li>
        <li><strong>Créer un espace</strong> accueillant et inclusif pour tous les publics</li>
        <li><strong>Soutenir</strong> l'éducation, la recherche et le développement personnel</li>
    </ul>

    <h2>Nos Services</h2>
    <div class="features-grid">
        <div class="feature-card">
            <i class="fas fa-book"></i>
            <h4>Vaste Collection</h4>
            <p>Des milliers de livres, magazines et ressources numériques</p>
        </div>
        <div class="feature-card">
            <i class="fas fa-laptop"></i>
            <h4>Plateforme en Ligne</h4>
            <p>Réservez et consultez vos emprunts en ligne</p>
        </div>
        <div class="feature-card">
            <i class="fas fa-users"></i>
            <h4>Communauté</h4>
            <p>Rejoignez une communauté de lecteurs passionnés</p>
        </div>
        <div class="feature-card">
            <i class="fas fa-headset"></i>
            <h4>Support</h4>
            <p>Une équipe dévouée prête à vous aider</p>
        </div>
    </div>

    <h2>Notre Histoire</h2>
    <p>
        Depuis sa création, notre bibliothèque n'a cessé d'évoluer pour mieux servir les besoins 
        de nos lecteurs. Nous avons progressivement modernisé nos services, notamment avec le lancement 
        de notre plateforme de gestion en ligne, qui permet aux membres de consulter le catalogue, 
        emprunter et réserver des livres de manière simple et rapide.
    </p>

    <h2>Rejoignez-nous</h2>
    <p>
        Que vous soyez un lecteur passionné, un chercheur ou simplement curieux, il y a une place pour vous 
        dans notre bibliothèque. Adhérez gratuitement et commencez à explorer notre collection dès aujourd'hui !
    </p>
    <div style="text-align: center; margin-top: 2rem;">
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); border: none;">
            <i class="fas fa-user-plus"></i> S'inscrire maintenant
        </a>
    </div>
</div>

@endsection
