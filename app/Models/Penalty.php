<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    use HasFactory;

    protected $table = 'penalites';
    protected $primaryKey = 'id_penalite';
    protected $fillable = [
        'montant', 'date_calcul', 'date_paiement', 'raison',
        'statut', 'id_membre', 'id_emprunt'
    ];
    protected $casts = [
        'montant' => 'decimal:2',
        'date_calcul' => 'date',
        'date_paiement' => 'date',
    ];

    public function membre()
    {
        return $this->belongsTo(Membre::class, 'id_membre', 'id_membre');
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class, 'id_emprunt', 'id_emprunt');
    }

    public function markAsPaid()
    {
        $this->statut = 'payee';
        $this->date_paiement = now()->toDateString();
        $this->save();
        return $this;
    }

    public function isPaid()
    {
        return $this->statut === 'payee';
    }

    public static function createFromOverdueLoan(Loan $loan, $dailyRate = 1.50)
    {
        if ($loan->isOverdue()) {
            $daysOverdue = $loan->getDaysOverdue();
            $amount = $daysOverdue * $dailyRate;

            return self::create([
                'montant' => $amount,
                'date_calcul' => now()->toDateString(),
                'raison' => "Retard de {$daysOverdue} jours sur l'emprunt",
                'statut' => 'non_payee',
                'id_membre' => $loan->id_membre,
                'id_emprunt' => $loan->id_emprunt,
            ]);
        }
        return null;
    }
}
