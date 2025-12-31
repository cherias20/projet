<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::with('books')->paginate(15);
        
        // Afficher la vue admin ou membre selon le rôle
        if (auth()->check() && auth()->user()->role === 'admin') {
            return view('admin.authors.index', compact('authors'));
        }
        return view('authors.index', compact('authors'));
    }

    public function show(Author $author)
    {
        $author->load('books');
        return view('authors.show', compact('author'));
    }
    {
        return view('admin.authors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:authors',
            'biographie' => 'nullable|string',
        ]);

        Author::create($validated);
        return redirect()->route('admin.authors.index')->with('success', 'Auteur créé avec succès.');
    }

    public function edit(Author $author)
    {
        return view('admin.authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:authors,nom,' . $author->id_auteur . ',id_auteur',
            'biographie' => 'nullable|string',
        ]);

        $author->update($validated);
        return redirect()->route('admin.authors.index')->with('success', 'Auteur mis à jour avec succès.');
    }

    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('admin.authors.index')->with('success', 'Auteur supprimé avec succès.');
    }
}
