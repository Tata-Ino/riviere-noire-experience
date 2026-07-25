@extends('admin.layout')

@section('title', 'Gestion des Réservations')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold" style="letter-spacing:-0.03em;"><i class="bi bi-calendar-check me-2" style="color:var(--bleu-profond);"></i>Gestion des Réservations</h4>
        <p class="text-muted mb-0" style="font-size:0.85rem;">{{ $reservations->total() ?? 0 }} réservation(s)</p>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-2">
                <label class="form-label">Statut</label>
                <select name="status" class="form-select">
                    <option value="">Tous</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>En attente</option>
                    <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Annulée</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Date début</label>
                <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label">Date fin</label>
                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Lieu</label>
                <select name="place_id" class="form-select">
                    <option value="">Tous les lieux</option>
                    @foreach($places ?? [] as $placeOption)
                        <option value="{{ $placeOption->id }}" {{ request('place_id') == $placeOption->id ? 'selected' : '' }}>
                            {{ $placeOption->translations->where('locale','fr')->first()->name ?? $placeOption->slug }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-primary w-100">
                    <i class="bi bi-funnel me-1"></i> Filtrer
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Lieu</th>
                        <th>Date</th>
                        <th>Personnes</th>
                        <th>Montant</th>
                        <th>Statut</th>
                        <th>Créée le</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $reservation)
                        <tr>
                            <td>
                                <div class="fw-semibold" style="font-size:0.88rem;">{{ $reservation->full_name ?? '-' }}</div>
                                <small style="color:var(--admin-muted);">{{ $reservation->email ?? '' }}</small>
                            </td>
                            <td>{{ $reservation->place?->translate('fr')?->name ?? $reservation->place?->slug ?? '-' }}</td>
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
                            <td><span style="color:var(--admin-muted); font-size:0.82rem;">{{ $reservation->created_at ? $reservation->created_at->format('d/m/Y H:i') : '-' }}</span></td>
                            <td class="text-end">
                                <a href="{{ route('admin.reservations.show', $reservation) }}" class="btn btn-sm" style="background:rgba(21,101,192,0.08); color:var(--bleu-profond); border-radius:8px;" title="Voir">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="bi bi-calendar-x" style="font-size:2.5rem; color:#ddd;"></i>
                                <div class="mt-2 text-muted">Aucune réservation trouvée</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if(method_exists($reservations, 'links'))
        <div class="card-footer" style="background:transparent; border-top:1px solid var(--admin-border);">
            {{ $reservations->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection
