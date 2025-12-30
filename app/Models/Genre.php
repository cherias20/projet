<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $table = 'genres';
    protected $primaryKey = 'id_genre';
    protected $fillable = ['nom', 'description'];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_genre', 'id_genre', 'id_livre')
            ->withTimestamps();
    }
}
