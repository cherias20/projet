<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Afficher le formulaire de connexion
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Traiter la connexion
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'L\'email est obligatoire',
            'email.email' => 'Veuillez entrer un email valide',
            'password.required' => 'Le mot de passe est obligatoire',
            'password.min' => 'Le mot de passe doit contenir au moins 6 caractères',
        ]);

        // Rechercher le membre
        $membre = Membre::where('email', $request->email)->first();

        // Vérifier si le membre existe et le mot de passe est correct
        if (!$membre || !Hash::check($request->password, $membre->mot_de_passe ?? '')) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Email ou mot de passe incorrect']);
        }

        // Vérifier si le membre est actif
        if ($membre->statut !== 'actif') {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Votre compte a été désactivé']);
        }

        // Connexion réussie - Stocker en session
        Session::put('membre_id', $membre->id_membre);
        Session::put('membre_nom', $membre->nom . ' ' . $membre->prenom);
        Session::put('membre_email', $membre->email);
        Session::put('membre_role', $membre->role);
        Session::put('is_admin', $membre->role === 'admin');

        // Se souvenir de moi
        if ($request->remember) {
            cookie('membre_id', $membre->id_membre, 60 * 24 * 30); // 30 jours
        }

        // Redirection selon le rôle
        if ($membre->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Bienvenue Admin !');
        }

        return redirect()->route('books.index')->with('success', 'Connexion réussie !');
    }

    /**
     * Afficher le formulaire d'inscription
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Traiter l'inscription
     */
    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'nullable|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'email' => 'required|email|unique:membres,email',
            'telephone' => 'nullable|string|max:20',
            'password' => 'required|min:8|confirmed',
            'terms' => 'required',
        ], [
            'email.required' => 'L\'email est obligatoire',
            'email.email' => 'Veuillez entrer un email valide',
            'email.unique' => 'Cet email est déjà utilisé',
            'telephone.max' => 'Le téléphone ne doit pas dépasser 20 caractères',
            'password.required' => 'Le mot de passe est obligatoire',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères',
            'password.confirmed' => 'Les mots de passe ne correspondent pas',
            'terms.required' => 'Vous devez accepter les conditions d\'utilisation',
        ]);

        // Créer un nouveau membre
        $membre = Membre::create([
            'nom' => $request->nom ?? '',
            'prenom' => $request->prenom ?? '',
            'email' => $request->email,
            'telephone' => $request->telephone,
            'mot_de_passe' => Hash::make($request->password),
            'role' => 'membre', // Par défaut, nouveau membre
            'numero_carte' => 'MBR-' . time() . '-' . rand(1000, 9999),
            'date_inscription' => now(),
            'statut' => 'actif',
        ]);

        return redirect()->route('login')
            ->with('success', 'Inscription réussie ! Vous pouvez maintenant vous connecter.');
    }

    /**
     * Se déconnecter
     */
    public function logout(Request $request)
    {
        Session::forget([
            'membre_id',
            'membre_nom',
            'membre_email',
            'membre_role',
            'is_admin'
        ]);

        return redirect()->route('home')->with('success', 'Vous avez été déconnecté');
    }

    /**
     * Dashboard admin (exemple)
     */
    public function adminDashboard()
    {
        if (Session::get('is_admin') !== true) {
            return redirect()->route('books.index')->withErrors(['error' => 'Accès réservé aux administrateurs']);
        }

        return view('admin.dashboard');
    }
}
