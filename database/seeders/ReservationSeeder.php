<?php

namespace Database\Seeders;

use App\Models\Excursion;
use App\Models\Language;
use App\Models\Payment;
use App\Models\Place;
use App\Models\Reservation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ReservationSeeder extends Seeder
{
    /**
     * Crée 15 réservations d'exemple réparties sur les 6 derniers mois
     * pour alimenter le tableau de bord avec des données réalistes.
     */
    public function run(): void
    {
        $places = Place::all();
        $excursions = Excursion::all();
        $langFr = Language::where('code', 'fr')->first();
        $langEn = Language::where('code', 'en')->first();

        $reservations = [
            [
                'place_slug' => 'riviere-noire-adjarra',
                'excursion_slug' => 'balade-en-pirogue',
                'full_name' => 'Jean-Pierre Agossa',
                'email' => 'jp.agossa@gmail.com',
                'phone' => '+229 96 12 34 56',
                'country' => 'Bénin',
                'language_id' => $langFr->id,
                'nb_persons' => 4,
                'months_ago' => 5,
                'day' => 12,
                'status' => 'confirmed',
                'payment_status' => 'success',
            ],
            [
                'place_slug' => 'riviere-noire-adjarra',
                'excursion_slug' => 'fabrication-sodabi',
                'full_name' => 'Marie Dupont',
                'email' => 'm.dupont@orange.fr',
                'phone' => '+33 6 12 34 56 78',
                'country' => 'France',
                'language_id' => $langFr->id,
                'nb_persons' => 2,
                'months_ago' => 5,
                'day' => 20,
                'status' => 'confirmed',
                'payment_status' => 'success',
            ],
            [
                'place_slug' => 'ouidah',
                'excursion_slug' => null,
                'full_name' => 'Sarah Johnson',
                'email' => 'sarah.j@outlook.com',
                'phone' => '+1 555 012 3456',
                'country' => 'USA',
                'language_id' => $langEn->id,
                'nb_persons' => 6,
                'months_ago' => 4,
                'day' => 5,
                'status' => 'confirmed',
                'payment_status' => 'success',
            ],
            [
                'place_slug' => 'abomey',
                'excursion_slug' => null,
                'full_name' => 'Adéola Kéhinde',
                'email' => 'kehinde.ad@yahoo.com',
                'phone' => '+234 802 345 6789',
                'country' => 'Nigeria',
                'language_id' => $langEn->id,
                'nb_persons' => 3,
                'months_ago' => 4,
                'day' => 18,
                'status' => 'confirmed',
                'payment_status' => 'success',
            ],
            [
                'place_slug' => 'riviere-noire-adjarra',
                'excursion_slug' => 'observation-ornithologique',
                'full_name' => 'Pierre Laurent',
                'email' => 'p.laurent@birdwatch.fr',
                'phone' => '+33 7 98 76 54 32',
                'country' => 'France',
                'language_id' => $langFr->id,
                'nb_persons' => 2,
                'months_ago' => 4,
                'day' => 25,
                'status' => 'confirmed',
                'payment_status' => 'success',
            ],
            [
                'place_slug' => 'porto-novo',
                'excursion_slug' => null,
                'full_name' => 'Kofi Mensah',
                'email' => 'k.mensah@gmail.com',
                'phone' => '+228 90 12 34 56',
                'country' => 'Togo',
                'language_id' => $langFr->id,
                'nb_persons' => 5,
                'months_ago' => 3,
                'day' => 3,
                'status' => 'confirmed',
                'payment_status' => 'success',
            ],
            [
                'place_slug' => 'riviere-noire-adjarra',
                'excursion_slug' => 'atelier-tambours',
                'full_name' => 'Emily Carter',
                'email' => 'emily.c@travel.com',
                'phone' => '+44 7700 900123',
                'country' => 'United Kingdom',
                'language_id' => $langEn->id,
                'nb_persons' => 2,
                'months_ago' => 3,
                'day' => 14,
                'status' => 'pending',
                'payment_status' => 'pending',
            ],
            [
                'place_slug' => 'ouidah',
                'excursion_slug' => null,
                'full_name' => 'Fatoumata Bamba',
                'email' => 'f.bamba@outlook.com',
                'phone' => '+225 07 12 34 56',
                'country' => 'Côte d\'Ivoire',
                'language_id' => $langFr->id,
                'nb_persons' => 8,
                'months_ago' => 3,
                'day' => 22,
                'status' => 'confirmed',
                'payment_status' => 'success',
            ],
            [
                'place_slug' => 'riviere-noire-adjarra',
                'excursion_slug' => 'balade-en-pirogue',
                'full_name' => 'Lucas Fernandes',
                'email' => 'lucas.f@live.com',
                'phone' => '+55 11 91234 5678',
                'country' => 'Brésil',
                'language_id' => $langEn->id,
                'nb_persons' => 4,
                'months_ago' => 2,
                'day' => 7,
                'status' => 'confirmed',
                'payment_status' => 'success',
            ],
            [
                'place_slug' => 'abomey',
                'excursion_slug' => null,
                'full_name' => 'Aminata Ouédraogo',
                'email' => 'a.ouedraogo@gmail.com',
                'phone' => '+226 70 12 34 56',
                'country' => 'Burkina Faso',
                'language_id' => $langFr->id,
                'nb_persons' => 6,
                'months_ago' => 2,
                'day' => 19,
                'status' => 'cancelled',
                'payment_status' => 'failed',
            ],
            [
                'place_slug' => 'riviere-noire-adjarra',
                'excursion_slug' => 'atelier-vannerie',
                'full_name' => 'Sophie Bernard',
                'email' => 's.bernard@wanadoo.fr',
                'phone' => '+33 6 54 32 10 98',
                'country' => 'France',
                'language_id' => $langFr->id,
                'nb_persons' => 3,
                'months_ago' => 1,
                'day' => 4,
                'status' => 'pending',
                'payment_status' => 'pending',
            ],
            [
                'place_slug' => 'riviere-noire-adjarra',
                'excursion_slug' => 'fabrication-sodabi',
                'full_name' => 'David Okonkwo',
                'email' => 'd.okonkwo@yahoo.com',
                'phone' => '+234 813 456 7890',
                'country' => 'Nigeria',
                'language_id' => $langEn->id,
                'nb_persons' => 2,
                'months_ago' => 1,
                'day' => 15,
                'status' => 'confirmed',
                'payment_status' => 'success',
            ],
            [
                'place_slug' => 'ouidah',
                'excursion_slug' => null,
                'full_name' => 'Isabelle Moreau',
                'email' => 'i.moreau@free.fr',
                'phone' => '+33 7 11 22 33 44',
                'country' => 'France',
                'language_id' => $langFr->id,
                'nb_persons' => 2,
                'months_ago' => 1,
                'day' => 28,
                'status' => 'confirmed',
                'payment_status' => 'success',
            ],
            [
                'place_slug' => 'riviere-noire-adjarra',
                'excursion_slug' => 'observation-ornithologique',
                'full_name' => 'Ahmed El-Sayed',
                'email' => 'ahmed.e@gmail.com',
                'phone' => '+20 100 123 4567',
                'country' => 'Égypte',
                'language_id' => $langEn->id,
                'nb_persons' => 2,
                'months_ago' => 0,
                'day' => 5,
                'status' => 'pending',
                'payment_status' => 'pending',
            ],
            [
                'place_slug' => 'riviere-noire-adjarra',
                'excursion_slug' => 'balade-en-pirogue',
                'full_name' => 'Grâce Adjei',
                'email' => 'g.adjei@outlook.com',
                'phone' => '+228 91 23 45 67',
                'country' => 'Togo',
                'language_id' => $langFr->id,
                'nb_persons' => 5,
                'months_ago' => 0,
                'day' => 12,
                'status' => 'pending',
                'payment_status' => 'pending',
            ],
        ];

        foreach ($reservations as $data) {
            $place = $places->firstWhere('slug', $data['place_slug']);
            $excursion = $data['excursion_slug']
                ? $excursions->firstWhere('slug', $data['excursion_slug'])
                : null;

            // Calculer le montant total
            $basePrice = $excursion ? $excursion->price : $place->price;
            $totalAmount = $basePrice * $data['nb_persons'];

            // Définir la date de visite (dans le passé ou le futur proche)
            $visitDate = Carbon::now()
                ->subMonths($data['months_ago'])
                ->day($data['day'])
                ->toDateString();

            // Créer la réservation
            $reservation = Reservation::create([
                'place_id' => $place->id,
                'excursion_id' => $excursion?->id,
                'full_name' => $data['full_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'country' => $data['country'],
                'language_id' => $data['language_id'],
                'nb_persons' => $data['nb_persons'],
                'visit_date' => $visitDate,
                'total_amount' => $totalAmount,
                'status' => $data['status'],
                'notes' => null,
            ]);

            // Créer le paiement associé
            Payment::create([
                'reservation_id' => $reservation->id,
                'provider' => $data['payment_status'] === 'pending' ? 'mobile_money' : 'orange_money',
                'transaction_id' => $data['payment_status'] === 'success'
                    ? 'TXN-'.strtoupper(uniqid())
                    : null,
                'amount' => $totalAmount,
                'currency' => 'XOF',
                'status' => $data['payment_status'],
                'paid_at' => $data['payment_status'] === 'success'
                    ? Carbon::now()->subMonths($data['months_ago'])->day($data['day'] - 1)->toDateTimeString()
                    : null,
                'raw_response' => null,
            ]);
        }
    }
}
