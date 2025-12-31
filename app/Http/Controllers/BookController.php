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
        
        // Afficher la vue admin ou membre selon le rôle
        if (auth()->check() && auth()->user()->role === 'admin') {
            return view('admin.books.index', compact('books'));
        }
        return view('books.index', compact('books'));
    }

    public function show(Book $book)
    {
        $book->load(['authors', 'genres', 'exemplaires']);
        return view('books.show', compact('book'));
    }

    public function search(Request $request)
    {
        $query = Book::query()->with(['authors', 'genres', 'exemplaires']);

        if ($request->has('titre') && $request->titre) {
            $query->where('titre', 'like', '%' . $request->titre . '%')
                  ->orWhere('resume', 'like', '%' . $request->titre . '%');
        }

        if ($request->has('auteur') && $request->auteur) {
            $query->whereHas('authors', function ($q) {
                $q->where('nom', 'like', '%' . request('auteur') . '%');
            });
        }

        if ($request->has('genre') && $request->genre) {
            $query->whereHas('genres', function ($q) {
                $q->where('nom', 'like', '%' . request('genre') . '%');
            });
        }

        if ($request->has('editeur') && $request->editeur) {
            $query->where('editeur', 'like', '%' . $request->editeur . '%');
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
            'sous_titre' => 'nullable|string|max:255',
            'editeur' => 'required|string|max:255',
            'annee_publication' => 'required|integer|min:1000|max:' . date('Y'),
            'resume' => 'nullable|string',
            'langue' => 'required|string|max:50',
            'pages' => 'nullable|integer|min:1',
            'authors' => 'array',
            'genres' => 'array',
        ]);

        $book = Book::create($validated);

        if ($request->has('authors')) {
            $book->authors()->attach($request->authors);
        }

        if ($request->has('genres')) {
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
            'sous_titre' => 'nullable|string|max:255',
            'editeur' => 'required|string|max:255',
            'annee_publication' => 'required|integer|min:1000|max:' . date('Y'),
            'resume' => 'nullable|string',
            'langue' => 'required|string|max:50',
            'pages' => 'nullable|integer|min:1',
            'authors' => 'array',
            'genres' => 'array',
        ]);

        $book->update($validated);

        if ($request->has('authors')) {
            $book->authors()->sync($request->authors);
        }

        if ($request->has('genres')) {
            $book->genres()->sync($request->genres);
        }

        return redirect()->route('admin.books.index')->with('success', 'Livre mis à jour avec succès.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Livre supprimé avec succès.');
    }
}
