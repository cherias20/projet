<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Loan extends Model
{
    use HasFactory;

    protected $table = 'emprunts';
    protected $primaryKey = 'id_emprunt';
    protected $fillable = [
        'date_emprunt', 'date_retour_prevue', 'date_retour', 'statut',
        'nombre_renouvellement', 'renouvellement_max', 'date_dernier_renouvellement',
        'id_membre', 'id_exemple'
    ];
    protected $casts = [
        'date_emprunt' => 'date',
        'date_retour_prevue' => 'date',
        'date_retour' => 'date',
        'date_dernier_renouvellement' => 'date',
    ];

    public function membre()
    {
        return $this->belongsTo(Membre::class, 'id_membre', 'id_membre');
    }

    public function exemplaire()
    {
        return $this->belongsTo(Exemplaire::class, 'id_exemple', 'id_exemple');
    }

    public function penalites()
    {
        return $this->hasMany(Penalty::class, 'id_emprunt', 'id_emprunt');
    }

    public function isOverdue()
    {
        return $this->statut === 'en_cours' && Carbon::now()->greaterThan($this->date_retour_prevue);
    }

    public function getDaysOverdue()
    {
        if (!$this->isOverdue()) {
            return 0;
        }
        return Carbon::now()->diffInDays($this->date_retour_prevue);
    }

    public function canRenew()
    {
        return $this->statut === 'en_cours' && 
               $this->nombre_renouvellement < $this->renouvellement_max &&
               !$this->isOverdue();
    }

    public function renew()
    {
        if ($this->canRenew()) {
            $this->nombre_renouvellement++;
            $this->date_retour_prevue = $this->date_retour_prevue->addDays(14);
            $this->date_dernier_renouvellement = Carbon::now();
            $this->save();
            return true;
        }
        return false;
    }

    public function returnBook()
    {
        $this->date_retour = Carbon::now();
        $this->statut = $this->isOverdue() ? 'retard' : 'termine';
        $this->save();

        // Mettre à jour le statut de l'exemplaire
        $this->exemplaire->statut = 'disponible';
        $this->exemplaire->save();

        return $this;
    }
}
