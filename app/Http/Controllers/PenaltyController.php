<?php

namespace App\Http\Controllers;

use App\Models\Penalty;
use App\Models\Membre;
use App\Models\Loan;
use App\Models\Parameter;
use App\Services\PenaltyService;
use Illuminate\Http\Request;

class PenaltyController extends Controller
{
    public function index()
    {
        if (session()->has('membre_id') && session()->get('membre_role') === 'admin') {
            // Vue admin - toutes les pénalités
            $penalties = Penalty::with(['membre', 'loan.exemplaire.book'])
                ->orderBy('date_calcul', 'desc')
                ->paginate(20);
            return view('admin.penalties.index', compact('penalties'));
        }
        
        // Vue membre - pénalités du membre connecté
        if (session()->has('membre_id')) {
            $membre = Membre::find(session()->get('membre_id'));
            $penalties = $membre->penalites()
                ->with('loan.exemplaire.book')
                ->orderBy('date_calcul', 'desc')
                ->paginate(20);
        } else {
            $penalties = collect();
        }
        
        return view('penalties.index', compact('penalties'));
    }

    public function show(Penalty $penalty)
    {
        $penalty->load(['membre', 'loan.exemplaire.book']);
        
        // Afficher la vue admin ou membre selon le rôle
        if (session()->has('membre_id') && session()->get('membre_role') === 'admin') {
            return view('admin.penalties.show', compact('penalty'));
        }
        return view('penalties.show', compact('penalty'));
    }

    public function memberPenalties(Membre $membre)
    {
        $unpaidPenalties = $membre->penalites()
            ->where('statut', 'non_payee')
            ->with('loan.exemplaire.book')
            ->get();

        $paidPenalties = $membre->penalites()
            ->where('statut', 'payee')
            ->with('loan.exemplaire.book')
            ->latest()
            ->paginate(10);

        $totalUnpaid = $unpaidPenalties->sum('montant');

        return view('penalties.member', compact('membre', 'unpaidPenalties', 'paidPenalties', 'totalUnpaid'));
    }

    public function markAsPaid(Penalty $penalty)
    {
        if ($penalty->statut === 'payee') {
            return back()->withErrors('Cette pénalité est déjà payée.');
        }

        $penalty->markAsPaid();

        return back()->with('success', 'Pénalité marquée comme payée.');
    }

    public function getUnpaidPenalties()
    {
        $penalties = Penalty::where('statut', 'non_payee')
            ->with(['membre', 'loan.exemplaire.book'])
            ->orderBy('date_calcul', 'desc')
            ->paginate(20);

        $totalUnpaid = Penalty::where('statut', 'non_payee')
            ->sum('montant');

        return view('penalties.unpaid', compact('penalties', 'totalUnpaid'));
    }

    public function statistics()
    {
        $stats = [
            'total_penalties' => Penalty::count(),
            'total_amount' => Penalty::sum('montant'),
            'unpaid_amount' => Penalty::where('statut', 'non_payee')->sum('montant'),
            'paid_amount' => Penalty::where('statut', 'payee')->sum('montant'),
            'unpaid_count' => Penalty::where('statut', 'non_payee')->count(),
            'paid_count' => Penalty::where('statut', 'payee')->count(),
        ];

        return view('penalties.statistics', compact('stats'));
    }

    public function unpaid()
    {
        return $this->getUnpaidPenalties();
    }

    public function remit(Request $request, Penalty $penalty)
    {
        $validated = $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $penalty->statut = 'remise';
        $penalty->save();

        return back()->with('success', 'Pénalité remise avec le motif: ' . $validated['reason']);
    }

    /**
     * Afficher les paramètres de pénalité (Admin)
     */
    public function settings()
    {
        if (session()->get('membre_role') !== 'admin') {
            return redirect()->route('books.index')->with('error', 'Accès non autorisé.');
        }

        $dailyRate = Parameter::get('penalty_daily_rate', 1.50);
        $blockThreshold = Parameter::get('penalty_block_threshold', 30.00);

        return view('admin.penalties.settings', compact('dailyRate', 'blockThreshold'));
    }

    /**
     * Mettre à jour les paramètres de pénalité
     */
    public function updateSettings(Request $request)
    {
        if (session()->get('membre_role') !== 'admin') {
            return redirect()->route('books.index')->with('error', 'Accès non autorisé.');
        }

        $validated = $request->validate([
            'daily_rate' => 'required|numeric|min:0|max:100',
            'block_threshold' => 'required|numeric|min:0|max:1000',
        ], [
            'daily_rate.required' => 'Le taux journalier est obligatoire',
            'daily_rate.numeric' => 'Le taux doit être un nombre',
            'block_threshold.required' => 'Le seuil de blocage est obligatoire',
            'block_threshold.numeric' => 'Le seuil doit être un nombre',
        ]);

        Parameter::set('penalty_daily_rate', $validated['daily_rate'], 'Taux de pénalité par jour en euros');
        Parameter::set('penalty_block_threshold', $validated['block_threshold'], 'Montant seuil pour bloquer un compte');

        return redirect()->route('penalties.settings')
            ->with('success', 'Paramètres mis à jour avec succès !');
    }

    /**
     * Débloquer manuellement un compte membre
     */
    public function unblockMember(Membre $membre)
    {
        if (session()->get('membre_role') !== 'admin') {
            return redirect()->route('books.index')->with('error', 'Accès non autorisé.');
        }

        if ($membre->statut === 'bloqué') {
            $membre->statut = 'actif';
            $membre->save();

            return back()->with('success', 'Compte débloqué avec succès !');
        }

        return back()->with('info', 'Ce compte n\'est pas bloqué.');
    }

    /**
     * Afficher les comptes bloqués
     */
    public function blockedMembers()
    {
        if (session()->get('membre_role') !== 'admin') {
            return redirect()->route('books.index')->with('error', 'Accès non autorisé.');
        }

        $members = Membre::where('statut', 'bloqué')
            ->with('penalites')
            ->paginate(20);

        return view('admin.penalties.blocked-members', compact('members'));
    }
}
