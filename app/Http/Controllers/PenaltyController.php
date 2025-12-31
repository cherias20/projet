<?php

namespace App\Http\Controllers;

use App\Models\Penalty;
use App\Models\Membre;
use App\Models\Loan;
use Illuminate\Http\Request;

class PenaltyController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            // Vue admin - toutes les pénalités
            $penalties = Penalty::with(['membre', 'loan.exemplaire.book'])
                ->orderBy('date_calcul', 'desc')
                ->paginate(20);
            return view('admin.penalties.index', compact('penalties'));
        }
        
        // Vue membre - pénalités du membre connecté
        if (auth()->check()) {
            $membre = auth()->user()->membre;
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
        if (auth()->check() && auth()->user()->role === 'admin') {
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

    public function remit(Request $request, Penalty $penalty)
    {
        $validated = $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $penalty->statut = 'remise';
        $penalty->save();

        return back()->with('success', 'Pénalité remise avec le motif: ' . $validated['reason']);
    }
}
