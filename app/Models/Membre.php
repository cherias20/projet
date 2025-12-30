<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    use HasFactory;

    protected $table = 'membres';
    protected $primaryKey = 'id_membre';
    protected $fillable = [
        'nom', 'prenom', 'email', 'mot_de_passe', 'adresse', 'telephone',
        'role', 'numero_carte', 'biographie', 'date_inscription',
        'statut', 'note', 'remember_token'
    ];
    protected $hidden = [
        'mot_de_passe', 'remember_token',
    ];
    protected $casts = [
        'date_inscription' => 'date',
        'note' => 'decimal:2',
    ];

    public function emprunts()
    {
        return $this->hasMany(Loan::class, 'id_membre', 'id_membre');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'id_membre', 'id_membre');
    }

    public function penalites()
    {
        return $this->hasMany(Penalty::class, 'id_membre', 'id_membre');
    }

    public function getActiveLoansCount()
    {
        return $this->emprunts()
            ->where('statut', 'en_cours')
            ->count();
    }

    public function getPendingPenalties()
    {
        return $this->penalites()
            ->where('statut', 'non_payee')
            ->sum('montant');
    }

    public function isActive()
    {
        return $this->statut === 'actif';
    }

    public function getFullName()
    {
        return "{$this->prenom} {$this->nom}";
    }
}
