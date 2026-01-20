@extends('layouts.app')

@section('title', 'Conditions d\'utilisation')

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
        font-size: 1.6rem;
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1rem;
        padding-bottom: 0.8rem;
        border-bottom: 3px solid #2a5298;
    }

    .page-content h2:first-child {
        margin-top: 0;
    }

    .page-content h3 {
        color: #333;
        font-size: 1.2rem;
        font-weight: 700;
        margin-top: 1.5rem;
        margin-bottom: 0.8rem;
    }

    .page-content p {
        color: #555;
        font-size: 1rem;
        margin-bottom: 1rem;
    }

    .page-content ul, .page-content ol {
        color: #555;
        font-size: 1rem;
        margin-bottom: 1rem;
        margin-left: 2rem;
    }

    .page-content li {
        margin-bottom: 0.5rem;
    }

    .highlight-box {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        padding: 1.5rem;
        border-left: 5px solid #2a5298;
        border-radius: 8px;
        margin: 1.5rem 0;
    }
</style>

<div class="page-header">
    <h1>
        <i class="fas fa-file-alt"></i>
        Conditions d'utilisation
    </h1>
</div>

<div class="page-content">
    <p style="font-style: italic; color: #999;">Dernière mise à jour : 19 janvier 2026</p>

    <h2>1. Acceptation des conditions</h2>
    <p>
        En accédant et en utilisant cette plateforme de gestion de bibliothèque, vous acceptez 
        de vous conformer à ces conditions d'utilisation. Si vous n'acceptez pas ces conditions, 
        veuillez ne pas utiliser ce service.
    </p>

    <h2>2. Services offerts</h2>
    <h3>2.1 Inscription</h3>
    <p>
        Pour accéder aux services, vous devez créer un compte en fournissant des informations exactes et complètes. 
        Vous êtes responsable de la confidentialité de vos identifiants de connexion.
    </p>

    <h3>2.2 Catalogue et recherche</h3>
    <p>
        Vous pouvez consulter le catalogue complet de la bibliothèque et effectuer des recherches 
        parmi les livres disponibles.
    </p>

    <h3>2.3 Emprunts et réservations</h3>
    <p>
        Les membres en règle peuvent emprunter des livres selon les conditions de prêt établies. 
        Les réservations sont possibles pour les livres non disponibles.
    </p>

    <h2>3. Responsabilités des membres</h2>
    <h3>3.1 Respect des règles de la bibliothèque</h3>
    <ul>
        <li>Respecter les délais de retour des livres</li>
        <li>Maintenir les livres en bon état</li>
        <li>Payer les pénalités en cas de retard ou de dommage</li>
        <li>Utiliser les ressources de manière responsable</li>
    </ul>

    <h3>3.2 Interdictions</h3>
    <p>Les membres s'engagent à ne pas :</p>
    <ul>
        <li>Reproduire, modifier ou distribuer du contenu sans permission</li>
        <li>Utiliser de faux identifiants ou d'autres comptes</li>
        <li>Endommager intentionnellement les livres ou l'équipement</li>
        <li>Harceler ou insulter le personnel ou d'autres membres</li>
        <li>Utiliser la plateforme pour des activités illégales</li>
    </ul>

    <h2>4. Politique de retard et de pénalités</h2>
    <div class="highlight-box">
        <h3 style="margin-top: 0;">Tarification des pénalités</h3>
        <ul style="margin-bottom: 0;">
            <li><strong>Retard de 1 à 7 jours :</strong> 0,50 € par jour</li>
            <li><strong>Retard de 8 à 14 jours :</strong> 1,00 € par jour</li>
            <li><strong>Retard supérieur à 14 jours :</strong> 2,00 € par jour + frais de recouvrement</li>
            <li><strong>Livre endommagé ou perdu :</strong> Remplacement ou indemnisation</li>
        </ul>
    </div>

    <h2>5. Durées de prêt</h2>
    <ul>
        <li><strong>Livres :</strong> 30 jours (renouvelables si aucune réservation)</li>
        <li><strong>Magazines :</strong> 15 jours</li>
        <li><strong>Ressources numériques :</strong> Selon les conditions spécifiques</li>
    </ul>

    <h2>6. Protection des données personnelles</h2>
    <p>
        Vos données personnelles sont traitées conformément à notre politique de confidentialité 
        et à la réglementation applicable en matière de protection des données (RGPD).
    </p>
    <p>
        Pour plus d'informations, consultez notre <a href="{{ route('privacy') }}" style="color: #2a5298; font-weight: 600;">politique de confidentialité</a>.
    </p>

    <h2>7. Limitation de responsabilité</h2>
    <p>
        La bibliothèque n'est pas responsable des pertes, dommages ou interruptions de service 
        découlant de l'utilisation de cette plateforme, sauf en cas de faute grave ou de négligence manifeste.
    </p>

    <h2>8. Modification des conditions</h2>
    <p>
        Nous nous réservons le droit de modifier ces conditions à tout moment. Les modifications 
        seront communiquées aux membres au moins 30 jours à l'avance.
    </p>

    <h2>9. Résiliation de compte</h2>
    <p>
        Un compte peut être suspendu ou supprimé en cas de non-respect des conditions d'utilisation 
        ou des politiques de la bibliothèque.
    </p>

    <h2>10. Contact</h2>
    <p>
        Pour toute question concernant ces conditions, veuillez nous contacter à 
        <a href="mailto:contact@bibliotheque.fr" style="color: #2a5298; font-weight: 600;">contact@bibliotheque.fr</a>
    </p>
</div>

@endsection
