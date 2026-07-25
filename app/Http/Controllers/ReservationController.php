<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Excursion;
use App\Models\Language;
use App\Models\Payment;
use App\Models\Place;
use App\Models\Reservation;
use App\Models\SiteContact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Afficher le formulaire de réservation.
     */
    public function create()
    {
        $places = Place::active()
            ->with(['translations.language'])
            ->get();

        $excursions = Excursion::active()
            ->with(['translations.language', 'place'])
            ->get();

        $languages = Language::active()->get();

        $contacts = SiteContact::getSettings();

        return view('reservation.create', compact('places', 'excursions', 'languages', 'contacts'));
    }

    /**
     * Enregistrer une nouvelle réservation et initier le paiement.
     */
    public function store(StoreReservationRequest $request)
    {
        $validated = $request->validated();

        // Calculer le montant total
        $totalAmount = $this->calculateTotal(
            $validated['place_id'],
            $validated['excursion_id'] ?? null,
            $validated['nb_persons']
        );

        // Créer la réservation
        $reservation = Reservation::create([
            'place_id' => $validated['place_id'],
            'excursion_id' => $validated['excursion_id'] ?? null,
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'country' => $validated['country'],
            'language_id' => $validated['language_id'],
            'nb_persons' => $validated['nb_persons'],
            'visit_date' => $validated['visit_date'],
            'total_amount' => $totalAmount,
            'status' => Reservation::STATUS_PENDING,
            'notes' => $validated['notes'] ?? null,
        ]);

        // Créer le paiement associé
        $payment = Payment::create([
            'reservation_id' => $reservation->id,
            'provider' => Payment::PROVIDER_MTN_MONEY,
            'amount' => $totalAmount,
            'currency' => 'XOF',
            'status' => Payment::STATUS_PENDING,
        ]);

        // Rediriger vers la page de paiement
        return redirect()->route('reservations.payment', $reservation->id);
    }

    /**
     * Afficher la page de paiement.
     */
    public function payment($id)
    {
        $reservation = Reservation::with(['place.translations.language', 'excursion.translations.language', 'payment'])
            ->findOrFail($id);

        return view('reservation.payment', compact('reservation'));
    }

    /**
     * Afficher la page de confirmation après paiement réussi.
     */
    public function confirmation($id)
    {
        $reservation = Reservation::with(['place', 'excursion', 'language', 'payment'])
            ->findOrFail($id);

        return view('reservation.confirmation', compact('reservation'));
    }

    /**
     * Gérer le callback/webhook de Kkiapay.
     */
    public function callback(Request $request): JsonResponse
    {
        $transactionId = $request->input('transaction_id');
        $status = $request->input('status');
        $metadata = $request->input('metadata', []);

        // Trouver le paiement par transaction_id
        $payment = Payment::where('transaction_id', $transactionId)->firstOrFail();

        // Mettre à jour le statut du paiement
        $payment->update([
            'status' => $status === 'successful' ? Payment::STATUS_COMPLETED : Payment::STATUS_FAILED,
            'transaction_id' => $transactionId,
            'raw_response' => $request->all(),
            'paid_at' => $status === 'successful' ? now() : null,
        ]);

        // Mettre à jour le statut de la réservation si le paiement est réussi
        if ($status === 'successful') {
            $payment->reservation->update([
                'status' => Reservation::STATUS_CONFIRMED,
            ]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Calculer le montant total de la réservation.
     */
    private function calculateTotal(int $placeId, ?int $excursionId, int $nbPersons): float
    {
        $place = Place::findOrFail($placeId);
        $total = (float) $place->price;

        if ($excursionId) {
            $excursion = Excursion::findOrFail($excursionId);
            $total += (float) $excursion->price;
        }

        return $total * $nbPersons;
    }
}
