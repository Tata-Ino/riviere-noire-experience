@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold" style="letter-spacing:-0.03em;">Dashboard</h4>
        <p class="text-muted mb-0" style="font-size:0.85rem;">Vue d'ensemble de votre activité</p>
    </div>
    <span class="fw-semibold" style="color:var(--admin-muted); font-size:0.88rem;">{{ now()->format('d M Y') }}</span>
</div>

{{-- Stats Cards --}}
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card p-4">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:linear-gradient(135deg, rgba(46,125,50,0.12), rgba(76,175,80,0.08)); color:var(--vert-foret);">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $totalReservationsMonth ?? 0 }}</div>
                    <div class="stat-label">Réservations du mois</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card p-4">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:linear-gradient(135deg, rgba(249,168,37,0.12), rgba(253,216,53,0.08)); color:var(--dore);">
                    <i class="bi bi-currency-exchange"></i>
                </div>
                <div>
                    <div class="stat-value">{{ number_format($totalRevenueMonth ?? 0, 0, ',', ' ') }} <span style="font-size:0.9rem; font-weight:600;">F</span></div>
                    <div class="stat-label">Revenu du mois</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card p-4">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:linear-gradient(135deg, rgba(21,101,192,0.12), rgba(66,165,245,0.08)); color:var(--bleu-profond);">
                    <i class="bi bi-clipboard-data"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $totalReservations ?? 0 }}</div>
                    <div class="stat-label">Total réservations</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card p-4">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:linear-gradient(135deg, rgba(46,125,50,0.12), rgba(76,175,80,0.08)); color:var(--vert-foret);">
                    <i class="bi bi-compass"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $activeExcursions ?? 0 }}</div>
                    <div class="stat-label">Excursions actives</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Charts --}}
<div class="row g-3 mb-4">
    <div class="col-xl-6">
        <div class="card p-4">
            <h6 class="fw-bold mb-3" style="font-size:0.9rem;"><i class="bi bi-graph-up me-2" style="color:var(--bleu-profond);"></i>Revenus par mois</h6>
            <canvas id="revenueChart" height="250"></canvas>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card p-4">
            <h6 class="fw-bold mb-3" style="font-size:0.9rem;"><i class="bi bi-bar-chart me-2" style="color:var(--vert-foret);"></i>Réservations par période</h6>
            <canvas id="reservationsChart" height="250"></canvas>
        </div>
    </div>
</div>
<div class="row g-3 mb-4">
    <div class="col-xl-4">
        <div class="card p-4">
            <h6 class="fw-bold mb-3" style="font-size:0.9rem;"><i class="bi bi-geo-alt me-2" style="color:var(--dore);"></i>Lieux les plus demandés</h6>
            <canvas id="placesChart" height="300"></canvas>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card p-4">
            <h6 class="fw-bold mb-3" style="font-size:0.9rem;"><i class="bi bi-globe me-2" style="color:var(--bleu-profond);"></i>Provenance des visiteurs</h6>
            <canvas id="countryChart" height="300"></canvas>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card p-4">
            <h6 class="fw-bold mb-3" style="font-size:0.9rem;"><i class="bi bi-translate me-2" style="color:var(--vert-foret);"></i>Répartition par langue</h6>
            <canvas id="languageChart" height="300"></canvas>
        </div>
    </div>
</div>

{{-- Recent Reservations --}}
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0" style="font-size:0.9rem;"><i class="bi bi-clock-history me-2"></i>Réservations récentes</h6>
        <a href="{{ route('admin.reservations.index') }}" class="btn btn-sm" style="background:rgba(46,125,50,0.08); color:var(--vert-foret); border-radius:8px;">Voir tout <i class="bi bi-arrow-right ms-1"></i></a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Lieu</th>
                        <th>Date</th>
                        <th>Personnes</th>
                        <th>Montant</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentReservations ?? [] as $reservation)
                        <tr>
                            <td>{{ $reservation->client_name ?? $reservation->name ?? '-' }}</td>
                            <td>{{ $reservation->place?->translate('fr')?->name ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($reservation->visit_date)->format('d/m/Y') }}</td>
                            <td>{{ $reservation->nb_persons ?? '-' }}</td>
                            <td class="fw-bold">{{ number_format($reservation->total_amount ?? 0, 0, ',', ' ') }} F</td>
                            <td>
                                @php
                                    $statusClass = match($reservation->status ?? 'pending') {
                                        'confirmed' => 'bg-success',
                                        'cancelled' => 'bg-danger',
                                        'pending' => 'bg-warning text-dark',
                                        default => 'bg-secondary'
                                    };
                                    $statusLabel = match($reservation->status ?? 'pending') {
                                        'confirmed' => 'Confirmée',
                                        'cancelled' => 'Annulée',
                                        'pending' => 'En attente',
                                        default => ucfirst($reservation->status)
                                    };
                                @endphp
                                <span class="badge badge-status {{ $statusClass }}">{{ $statusLabel }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="bi bi-inbox" style="font-size:2rem; opacity:0.3;"></i>
                                <div class="mt-2">Aucune réservation récente</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
@php
    $mChartMonths = $chartMonths ?? ['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'];
    $mChartRevenue = $chartRevenue ?? array_fill(0, 12, 0);
    $mChartReservations = $chartReservations ?? array_fill(0, 12, 0);
    $mChartPlacesLabels = $chartPlacesLabels ?? [];
    $mChartPlacesData = $chartPlacesData ?? [];
    $mChartCountryLabels = $chartCountryLabels ?? [];
    $mChartCountryData = $chartCountryData ?? [];
    $mChartLanguageLabels = $chartLanguageLabels ?? [];
    $mChartLanguageData = $chartLanguageData ?? [];
@endphp
<script>
    const months = @json($mChartMonths);
    const revenueData = @json($mChartRevenue);
    const reservationsData = @json($mChartReservations);
    const placesLabels = @json($mChartPlacesLabels);
    const placesData = @json($mChartPlacesData);
    const countryLabels = @json($mChartCountryLabels);
    const countryData = @json($mChartCountryData);
    const languageLabels = @json($mChartLanguageLabels);
    const languageData = @json($mChartLanguageData);

    new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Revenus (F)',
                data: revenueData,
                borderColor: '#2E7D32',
                backgroundColor: 'rgba(46,125,50,0.08)',
                fill: true, tension: 0.4, pointRadius: 4,
                pointBackgroundColor: '#2E7D32',
                borderWidth: 2
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });

    new Chart(document.getElementById('reservationsChart'), {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Réservations',
                data: reservationsData,
                backgroundColor: 'rgba(21,101,192,0.8)',
                borderRadius: 8,
                borderWidth: 0
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });

    new Chart(document.getElementById('placesChart'), {
        type: 'bar',
        data: {
            labels: placesLabels,
            datasets: [{
                label: 'Réservations',
                data: placesData,
                backgroundColor: 'rgba(249,168,37,0.8)',
                borderRadius: 8,
                borderWidth: 0
            }]
        },
        options: { indexAxis: 'y', responsive: true, plugins: { legend: { display: false } } }
    });

    new Chart(document.getElementById('countryChart'), {
        type: 'doughnut',
        data: {
            labels: countryLabels,
            datasets: [{ data: countryData, backgroundColor: ['#1565C0','#2E7D32','#F9A825','#e74c3c','#8e44ad','#1abc9c'] }]
        },
        options: { responsive: true, plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 16 } } } }
    });

    new Chart(document.getElementById('languageChart'), {
        type: 'pie',
        data: {
            labels: languageLabels,
            datasets: [{ data: languageData, backgroundColor: ['#2E7D32','#1565C0','#F9A825'] }]
        },
        options: { responsive: true, plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 16 } } } }
    });
</script>
@endpush
