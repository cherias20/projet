<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::orderBy('nom')->paginate(20);
        return view('admin.genres.index', compact('genres'));
    }

    public function create()
    {
        return view('admin.genres.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:genres,nom',
            'description' => 'nullable|string',
        ]);

        Genre::create($validated);
        return redirect()->route('admin.genres.index')->with('success', 'Genre créé avec succès.');
    }

    public function edit(Genre $genre)
    {
        return view('admin.genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:genres,nom,' . $genre->id,
            'description' => 'nullable|string',
        ]);

        $genre->update($validated);
        return redirect()->route('admin.genres.index')->with('success', 'Genre mis à jour avec succès.');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('admin.genres.index')->with('success', 'Genre supprimé avec succès.');
    }
}
