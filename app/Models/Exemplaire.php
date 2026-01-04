<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exemplaire extends Model
{
    use HasFactory;

    protected $table = 'exemplaires';
    protected $primaryKey = 'id_exemple';
    protected $fillable = ['code_barre', 'format', 'statut', 'date_acquisition', 'prix_achat', 'id_livre', 'date_creation'];
    protected $casts = [
        'date_acquisition' => 'date',
        'prix_achat' => 'decimal:2',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'id_livre', 'id_livre');
    }

    public function emprunts()
    {
        return $this->hasMany(Loan::class, 'id_exemple', 'id_exemple');
    }

    public function getCurrentLoan()
    {
        return $this->emprunts()
            ->where('statut', 'en_cours')
            ->latest()
            ->first();
    }

    public function isAvailable()
    {
        return $this->statut === 'disponible' && $this->getCurrentLoan() === null;
    }
}
