<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $membres = Membre::paginate(15);
        return view('admin.members.index', compact('membres'));
    }

    public function show(Membre $membre)
    {
        return view('admin.members.show', compact('membre'));
    }

    public function create()
    {
        return view('admin.members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:membres',
            'adresse' => 'required|string|max:500',
            'telephone' => 'nullable|string|max:20',
            'numero_carte' => 'required|string|unique:membres',
            'biographie' => 'nullable|string',
            'role' => 'required|in:admin,membre',
        ]);

        $validated['date_inscription'] = now()->toDateString();
        $validated['statut'] = 'actif';

        Membre::create($validated);
        return redirect()->route('admin.members.index')->with('success', 'Membre créé avec succès.');
    }

    public function edit(Membre $membre)
    {
        return view('admin.members.edit', compact('membre'));
    }

    public function update(Request $request, Membre $membre)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:membres,email,' . $membre->id_membre . ',id_membre',
            'adresse' => 'required|string|max:500',
            'telephone' => 'nullable|string|max:20',
            'numero_carte' => 'required|string|unique:membres,numero_carte,' . $membre->id_membre . ',id_membre',
            'biographie' => 'nullable|string',
            'role' => 'required|in:admin,membre',
            'statut' => 'required|in:actif,suspendu,inactif',
        ]);

        $membre->update($validated);
        return redirect()->route('admin.members.index')->with('success', 'Membre mis à jour avec succès.');
    }

    public function destroy(Membre $membre)
    {
        // Vérifier s'il y a des emprunts actifs
        if ($membre->emprunts()->where('statut', 'en_cours')->count() > 0) {
            return back()->withErrors('Impossible de supprimer un membre ayant des emprunts actifs.');
        }

        $membre->delete();
        return redirect()->route('admin.members.index')->with('success', 'Membre supprimé avec succès.');
    }

    public function suspend(Membre $membre)
    {
        $membre->statut = 'suspendu';
        $membre->save();
        return back()->with('success', 'Membre suspendu.');
    }

    public function activate(Membre $membre)
    {
        $membre->statut = 'actif';
        $membre->save();
        return back()->with('success', 'Membre activé.');
    }
}
