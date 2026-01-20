@extends('layouts.app')

@section('title', 'Politique de confidentialité')

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
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 8px;
        margin: 1.5rem 0;
    }

    .highlight-box h4 {
        margin-top: 0;
        font-weight: 700;
    }

    .highlight-box p, .highlight-box ul {
        color: white;
        margin-bottom: 0;
    }
</style>

<div class="page-header">
    <h1>
        <i class="fas fa-lock"></i>
        Politique de confidentialité
    </h1>
</div>

<div class="page-content">
    <p style="font-style: italic; color: #999;">Dernière mise à jour : 19 janvier 2026</p>

    <h2>Introduction</h2>
    <p>
        La bibliothèque attache une grande importance à la protection de vos données personnelles. 
        Cette politique de confidentialité explique comment nous collectons, utilisons, stockons et 
        protégeons vos informations.
    </p>

    <h2>1. Responsable du traitement des données</h2>
    <p>
        <strong>Bibliothèque Centrale</strong><br>
        123 Rue de la Bibliothèque<br>
        75001 Paris, France<br>
        Email : <a href="mailto:contact@bibliotheque.fr" style="color: #2a5298;">contact@bibliotheque.fr</a>
    </p>

    <h2>2. Données collectées</h2>
    <h3>2.1 Informations d'identification</h3>
    <ul>
        <li>Nom complet</li>
        <li>Adresse email</li>
        <li>Numéro de téléphone</li>
        <li>Adresse postale</li>
        <li>Numéro de membre (généré automatiquement)</li>
    </ul>

    <h3>2.2 Informations de connexion</h3>
    <ul>
        <li>Adresse IP</li>
        <li>Historique de connexion</li>
        <li>Données de navigation et cookies</li>
    </ul>

    <h3>2.3 Historique de bibliothèque</h3>
    <ul>
        <li>Livres empruntés et dates</li>
        <li>Durée des prêts</li>
        <li>Réservations effectuées</li>
        <li>Pénalités applicables</li>
    </ul>

    <h2>3. Base légale du traitement</h2>
    <p>
        Nous traitons vos données personnelles sur la base de :
    </p>
    <ul>
        <li><strong>Votre consentement :</strong> Lors de votre inscription</li>
        <li><strong>L'exécution d'un contrat :</strong> Pour la gestion des emprunts et réservations</li>
        <li><strong>L'obligation légale :</strong> Conformément aux lois applicables</li>
        <li><strong>Nos intérêts légitimes :</strong> Pour la sécurité et la gestion du service</li>
    </ul>

    <h2>4. Utilisation de vos données</h2>
    <p>Vos données sont utilisées pour :</p>
    <ul>
        <li>Créer et gérer votre compte de membre</li>
        <li>Traiter vos emprunts et réservations</li>
        <li>Envoyer des notifications concernant vos emprunts (rappels, retards)</li>
        <li>Gérer les pénalités et les frais</li>
        <li>Améliorer la qualité de nos services</li>
        <li>Communiquer les informations importantes</li>
        <li>Assurer la sécurité et prévenir les fraudes</li>
    </ul>

    <h2>5. Partage des données</h2>
    <p>
        Nous ne partageons pas vos données personnelles avec des tiers, sauf :
    </p>
    <ul>
        <li>Lorsqu'il est légalement requis (autorités judiciaires)</li>
        <li>Avec nos prestataires de services (paiement, stockage cloud) sous contrats de confidentialité</li>
        <li>Avec votre consentement explicite</li>
    </ul>

    <h2>6. Conservation des données</h2>
    <p>
        Vos données sont conservées pendant la durée de votre adhésion et pour une période 
        supplémentaire de 3 ans après résiliation, conformément aux obligations légales.
    </p>

    <div class="highlight-box">
        <h4>Votre droit à l'oubli</h4>
        <p>
            Vous pouvez demander la suppression de vos données personnelles à tout moment, 
            sauf si des obligations légales nous obligent à les conserver.
        </p>
    </div>

    <h2>7. Sécurité des données</h2>
    <p>
        Nous mettons en place des mesures de sécurité appropriées pour protéger vos données contre :
    </p>
    <ul>
        <li>L'accès non autorisé</li>
        <li>La modification ou la destruction</li>
        <li>La divulgation accidentelle</li>
    </ul>
    <p>
        Ces mesures incluent le chiffrement, les pare-feu, les sauvegardes régulières et 
        les contrôles d'accès restreints.
    </p>

    <h2>8. Vos droits RGPD</h2>
    <p>
        Conformément au Règlement Général sur la Protection des Données (RGPD), vous avez le droit de :
    </p>
    <ul>
        <li><strong>Droit d'accès :</strong> Consulter vos données personnelles</li>
        <li><strong>Droit de rectification :</strong> Corriger des informations inexactes</li>
        <li><strong>Droit à l'oubli :</strong> Demander la suppression de vos données</li>
        <li><strong>Droit à la limitation du traitement :</strong> Restreindre certains traitements</li>
        <li><strong>Droit à la portabilité :</strong> Recevoir vos données dans un format structuré</li>
        <li><strong>Droit d'opposition :</strong> Vous opposer à certains traitements</li>
    </ul>

    <h2>9. Cookies et technologies de suivi</h2>
    <p>
        Notre site utilise des cookies pour :
    </p>
    <ul>
        <li>Maintenir votre session de connexion</li>
        <li>Mémoriser vos préférences</li>
        <li>Analyser l'utilisation du site</li>
    </ul>
    <p>
        Vous pouvez contrôler les cookies dans les paramètres de votre navigateur.
    </p>

    <h2>10. Exercer vos droits</h2>
    <p>
        Pour exercer l'un de vos droits RGPD, veuillez nous contacter :
    </p>
    <div style="background: #f5f7fa; padding: 1.5rem; border-radius: 8px;">
        <p style="margin: 0;">
            <strong>Email :</strong> <a href="mailto:privacy@bibliotheque.fr" style="color: #2a5298;">privacy@bibliotheque.fr</a><br>
            <strong>Adresse :</strong> 123 Rue de la Bibliothèque, 75001 Paris, France
        </p>
    </div>

    <h2>11. Modifications de cette politique</h2>
    <p>
        Nous nous réservons le droit de modifier cette politique de confidentialité à tout moment. 
        Les modifications seront communiquées par email et sur cette page.
    </p>

    <h2>12. Contact et réclamations</h2>
    <p>
        Si vous avez des questions ou des réclamations concernant notre traitement de vos données, 
        veuillez nous contacter en premier lieu. Vous avez également le droit de déposer une plainte 
        auprès de l'autorité de protection des données compétente.
    </p>
</div>

@endsection
