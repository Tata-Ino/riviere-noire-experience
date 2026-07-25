<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Liste de toutes les réservations avec filtres (statut, date, lieu) et pagination.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $query = Reservation::with(['place', 'excursion', 'language', 'payment']);

        // Filtre par statut
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        // Filtre par plage de dates
        if ($dateFrom = $request->input('date_from')) {
            $query->where('visit_date', '>=', $dateFrom);
        }

        if ($dateTo = $request->input('date_to')) {
            $query->where('visit_date', '<=', $dateTo);
        }

        // Filtre par lieu
        if ($placeId = $request->input('place_id')) {
            $query->where('place_id', $placeId);
        }

        // Recherche par nom ou email
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $reservations = $query->latest('visit_date')->paginate(20)->withQueryString();

        $places = Place::active()->get();
        $statuses = Reservation::STATUSES;

        return view('admin.reservations.index', compact('reservations', 'places', 'statuses'));
    }

    /**
     * Afficher les détails d'une réservation.
     */
    public function show(Request $request, $id)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $reservation = Reservation::with(['place', 'excursion', 'language', 'payment'])
            ->findOrFail($id);

        return view('admin.reservations.show', compact('reservation'));
    }

    /**
     * Mettre à jour le statut d'une réservation.
     */
    public function updateStatus(Request $request, $id)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $reservation = Reservation::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:' . implode(',', Reservation::STATUSES),
        ]);

        $reservation->update([
            'status' => $validated['status'],
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Statut mis à jour avec succès.',
                'status' => $reservation->status,
            ]);
        }

        return back()->with('success', 'Statut de la réservation mis à jour avec succès.');
    }
}
