<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Excursion;
use App\Models\Place;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        abort_unless($user->hasAdminRole(), 403);

        $now = now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        $totalReservationsMonth = Reservation::whereBetween('visit_date', [$startOfMonth, $endOfMonth])->count();

        $totalRevenueMonth = (float) Reservation::whereBetween('visit_date', [$startOfMonth, $endOfMonth])
            ->where('status', '!=', Reservation::STATUS_CANCELLED)
            ->sum('total_amount');

        $totalReservations = Reservation::count();
        $activeExcursions = Excursion::count();

        $recentReservations = Reservation::with(['place.translations.language', 'excursion.translations.language'])
            ->latest()
            ->limit(10)
            ->get();

        // Chart: monthly revenue (12 months)
        $monthlyRevenueRaw = Reservation::select(
                DB::raw("DATE_FORMAT(visit_date, '%Y-%m') as month"),
                DB::raw('SUM(total_amount) as total')
            )
            ->where('visit_date', '>=', $now->copy()->subMonths(12)->startOfMonth())
            ->where('status', '!=', Reservation::STATUS_CANCELLED)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Chart: reservations by month
        $reservationsByPeriodRaw = Reservation::select(
                DB::raw("DATE_FORMAT(visit_date, '%Y-%m') as month"),
                DB::raw('COUNT(*) as count')
            )
            ->where('visit_date', '>=', $now->copy()->subMonths(12)->startOfMonth())
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Build chart arrays (12 months)
        $chartMonths = [];
        $chartRevenue = [];
        $chartReservations = [];
        for ($m = 11; $m >= 0; $m--) {
            $key = $now->copy()->subMonths($m)->format('Y-m');
            $label = $now->copy()->subMonths($m)->format('M');
            $chartMonths[] = $label;
            $found = $monthlyRevenueRaw->firstWhere('month', $key);
            $chartRevenue[] = $found ? (float) $found->total : 0;
            $foundR = $reservationsByPeriodRaw->firstWhere('month', $key);
            $chartReservations[] = $foundR ? (int) $foundR->count : 0;
        }

        // Top places
        $topPlacesData = Reservation::select('place_id', DB::raw('COUNT(*) as count'))
            ->whereNotNull('place_id')
            ->groupBy('place_id')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        $chartPlacesLabels = [];
        $chartPlacesData = [];
        foreach ($topPlacesData as $tp) {
            $place = Place::with('translations')->find($tp->place_id);
            $chartPlacesLabels[] = $place?->translate('fr')?->name ?? $place?->translate('en')?->name ?? 'Lieu';
            $chartPlacesData[] = (int) $tp->count;
        }

        // Visitors by country
        $visitorsByCountryRaw = Reservation::select('country', DB::raw('COUNT(*) as count'))
            ->whereNotNull('country')
            ->groupBy('country')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        $chartCountryLabels = [];
        $chartCountryData = [];
        foreach ($visitorsByCountryRaw as $vc) {
            $chartCountryLabels[] = $vc->country;
            $chartCountryData[] = (int) $vc->count;
        }

        // Reservations by language
        $reservationsByLanguageRaw = Reservation::select('language_id', DB::raw('COUNT(*) as count'))
            ->whereNotNull('language_id')
            ->groupBy('language_id')
            ->orderByDesc('count')
            ->get();

        $chartLanguageLabels = [];
        $chartLanguageData = [];
        foreach ($reservationsByLanguageRaw as $rl) {
            $lang = \App\Models\Language::find($rl->language_id);
            $chartLanguageLabels[] = $lang?->name ?? 'Inconnue';
            $chartLanguageData[] = (int) $rl->count;
        }

        return view('admin.dashboard', compact(
            'totalReservationsMonth',
            'totalRevenueMonth',
            'totalReservations',
            'activeExcursions',
            'recentReservations',
            'chartMonths',
            'chartRevenue',
            'chartReservations',
            'chartPlacesLabels',
            'chartPlacesData',
            'chartCountryLabels',
            'chartCountryData',
            'chartLanguageLabels',
            'chartLanguageData'
        ));
    }
}
