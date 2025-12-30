<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $primaryKey = 'id_livre';
    protected $fillable = ['titre', 'sous_titre', 'editeur', 'annee_publication', 'resume', 'langue', 'pages'];

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_author', 'id_livre', 'id_auteur')
            ->withTimestamps();
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genre', 'id_livre', 'id_genre')
            ->withTimestamps();
    }

    public function exemplaires()
    {
        return $this->hasMany(Exemplaire::class, 'id_livre', 'id_livre');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'id_livre', 'id_livre');
    }

    public function getAvailableCopiesCount()
    {
        return $this->exemplaires()->where('statut', 'disponible')->count();
    }

    public function getTotalCopiesCount()
    {
        return $this->exemplaires()->count();
    }
}
