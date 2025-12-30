<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';
    protected $primaryKey = 'id_reservation';
    protected $fillable = [
        'date_reservation', 'statut', 'notifier', 'position',
        'id_membre', 'id_livre'
    ];
    protected $casts = [
        'date_reservation' => 'date',
        'notifier' => 'boolean',
    ];

    public function membre()
    {
        return $this->belongsTo(Membre::class, 'id_membre', 'id_membre');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'id_livre', 'id_livre');
    }

    public function getWaitingCount()
    {
        return self::where('id_livre', $this->id_livre)
            ->where('statut', 'en_attente')
            ->where('position', '<', $this->position)
            ->count();
    }

    public function checkAvailability()
    {
        $availableCopy = $this->book->exemplaires()
            ->where('statut', 'disponible')
            ->first();

        if ($availableCopy) {
            $this->statut = 'disponible';
            $this->notifier = true;
            $this->save();
            return true;
        }
        return false;
    }

    public function cancel()
    {
        $this->statut = 'annulee';
        $this->save();
        
        // Réajuster les positions
        self::where('id_livre', $this->id_livre)
            ->where('position', '>', $this->position)
            ->where('statut', 'en_attente')
            ->decrement('position');
    }
}
