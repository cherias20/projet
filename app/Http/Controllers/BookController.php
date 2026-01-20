<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['authors', 'genres', 'exemplaires'])->paginate(12);
        
        // Si la route est /admin/books, afficher la vue admin
        if (request()->is('admin/*')) {
            return view('admin.books.index', compact('books'));
        }
        
        // Sinon afficher la vue publique
        return view('books.index', compact('books'));
    }

    public function show(Book $book)
    {
        $book->load(['authors', 'genres', 'exemplaires']);
        
        // Si la route est /admin/books, afficher la vue admin
        if (request()->is('admin/*')) {
            return view('admin.books.show', compact('book'));
        }
        
        // Sinon afficher la vue publique
        return view('books.show', compact('book'));
    }

    public function search(Request $request)
    {
        $query = Book::query()->with(['authors', 'genres', 'exemplaires']);
        
        $searchTerm = $request->input('query', '');

        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                // Recherche dans le titre et le résumé
                $q->where('titre', 'like', '%' . $searchTerm . '%')
                  ->orWhere('resume', 'like', '%' . $searchTerm . '%')
                  ->orWhere('editeur', 'like', '%' . $searchTerm . '%')
                  // Recherche par auteur
                  ->orWhereHas('authors', function ($subQ) use ($searchTerm) {
                      $subQ->where('nom', 'like', '%' . $searchTerm . '%');
                  })
                  // Recherche par genre
                  ->orWhereHas('genres', function ($subQ) use ($searchTerm) {
                      $subQ->where('nom', 'like', '%' . $searchTerm . '%');
                  });
            });
        }

        $books = $query->paginate(12);
        
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::all();
        $genres = Genre::all();
        return view('admin.books.create', compact('authors', 'genres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'editeur' => 'required|string|max:255',
            'annee_publication' => 'required|integer|min:1000|max:' . date('Y'),
            'resume' => 'nullable|string',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'exemplaires' => 'nullable|integer|min:1',
        ]);

        $nombreExemplaires = $validated['exemplaires'] ?? 1;
        unset($validated['exemplaires']);

        // Gérer l'upload de l'image
        if ($request->hasFile('images')) {
            $imagePath = $request->file('images')->store('books', 'public');
            $validated['images'] = $imagePath;
        } else {
            // Valeur par défaut si aucune image n'est fournie
            $validated['images'] = null;
        }

        $book = Book::create($validated);

        // Créer les exemplaires
        for ($i = 0; $i < $nombreExemplaires; $i++) {
            $book->exemplaires()->create([
                'code_barre' => 'CODE-' . $book->id_livre . '-' . ($i + 1),
                'statut' => 'disponible',
                'date_acquisition' => now()->toDateString(),
                'prix_achat' => 0,
                'date_creation' => now(),
            ]);
        }

        // Attacher les auteurs sélectionnés
        if ($request->has('authors') && !empty($request->authors)) {
            $book->authors()->attach($request->authors);
        }

        // Attacher les genres sélectionnés
        if ($request->has('genres') && !empty($request->genres)) {
            $book->genres()->attach($request->genres);
        }

        return redirect()->route('admin.books.index')->with('success', 'Livre créé avec succès.');
    }

    public function edit(Book $book)
    {
        $authors = Author::all();
        $genres = Genre::all();
        return view('admin.books.edit', compact('book', 'authors', 'genres'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'editeur' => 'required|string|max:255',
            'annee_publication' => 'required|integer|min:1000|max:' . date('Y'),
            'resume' => 'nullable|string',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Gérer l'upload de l'image
        if ($request->hasFile('images')) {
            $imagePath = $request->file('images')->store('books', 'public');
            $validated['images'] = $imagePath;
        }

        $book->update($validated);

        // Synchroniser les auteurs
        if ($request->has('authors') && !empty($request->authors)) {
            $book->authors()->sync($request->authors);
        } else {
            $book->authors()->detach();
        }

        // Synchroniser les genres
        if ($request->has('genres') && !empty($request->genres)) {
            $book->genres()->sync($request->genres);
        } else {
            $book->genres()->detach();
        }

        return redirect()->route('admin.books.index')->with('success', 'Livre mis à jour avec succès.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Livre supprimé avec succès.');
    }
}
