@extends('admin.layout')

@section('title', 'Détails de la Réservation #' . ($reservation->id ?? ''))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold" style="letter-spacing:-0.03em;"><i class="bi bi-calendar-check me-2" style="color:var(--bleu-profond);"></i>Réservation #{{ $reservation->id }}</h4>
        <p class="text-muted mb-0" style="font-size:0.85rem;">Détails complets de la réservation</p>
    </div>
    <a href="{{ route('admin.reservations.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Retour
    </a>
</div>

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

<div class="row g-4">
    {{-- Client Info --}}
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header">
                <h6 class="fw-bold mb-0" style="font-size:0.9rem;"><i class="bi bi-person me-2" style="color:var(--vert-foret);"></i>Informations client</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr>
                        <td class="text-muted" style="width:40%">Nom</td>
                        <td class="fw-bold">{{ $reservation->full_name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Email</td>
                        <td>{{ $reservation->email ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Téléphone</td>
                        <td>{{ $reservation->phone ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    {{-- Reservation Info --}}
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header">
                <h6 class="fw-bold mb-0" style="font-size:0.9rem;"><i class="bi bi-info-circle me-2" style="color:var(--dore);"></i>Détails de la réservation</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr>
                        <td class="text-muted" style="width:40%">Lieu</td>
                        <td class="fw-bold">{{ $reservation->place?->translate('fr')?->name ?? $reservation->place?->slug ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Excursion</td>
                        <td>{{ $reservation->excursion?->translate('fr')?->name ?? $reservation->excursion?->slug ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Date</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->visit_date)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Personnes</td>
                        <td>{{ $reservation->nb_persons ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    {{-- Payment Info --}}
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header">
                <h6 class="fw-bold mb-0" style="font-size:0.9rem;"><i class="bi bi-credit-card me-2" style="color:var(--bleu-profond);"></i>Informations de paiement</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr>
                        <td class="text-muted" style="width:40%">Montant</td>
                        <td class="fw-bold" style="font-size:1.2rem; color:var(--vert-foret);">
                            {{ number_format($reservation->total_amount ?? 0, 0, ',', ' ') }} F CFA
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Méthode</td>
                        <td>{{ $reservation->payment?->provider ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Statut paiement</td>
                        <td>
                            @if(($reservation->payment?->status ?? '') === 'success')
                                <span class="badge" style="background:rgba(46,125,50,0.1); color:var(--vert-foret); border-radius:8px;">Payé</span>
                            @else
                                <span class="badge" style="background:rgba(249,168,37,0.1); color:#B8860B; border-radius:8px;">En attente</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    {{-- Status Management --}}
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header">
                <h6 class="fw-bold mb-0" style="font-size:0.9rem;"><i class="bi bi-gear me-2" style="color:var(--admin-muted);"></i>Gestion du statut</h6>
            </div>
            <div class="card-body d-flex flex-column gap-3">
                <div class="d-flex align-items-center mb-2">
                    <span class="me-2" style="font-size:0.88rem;">Statut actuel :</span>
                    <span class="badge badge-status {{ $statusClass }}">{{ $statusLabel }}</span>
                </div>

                @if(($reservation->status ?? 'pending') !== 'confirmed')
                    <form action="{{ route('admin.reservations.status', $reservation) }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="confirmed">
                        <button type="submit" class="btn btn-success w-100 py-2" style="border-radius:10px;">
                            <i class="bi bi-check-circle me-1"></i> Confirmer la réservation
                        </button>
                    </form>
                @endif

                @if(($reservation->status ?? 'pending') !== 'pending')
                    <form action="{{ route('admin.reservations.status', $reservation) }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="pending">
                        <button type="submit" class="btn btn-warning w-100 py-2" style="border-radius:10px;">
                            <i class="bi bi-clock me-1"></i> Remettre en attente
                        </button>
                    </form>
                @endif

                @if(($reservation->status ?? 'pending') !== 'cancelled')
                    <form action="{{ route('admin.reservations.status', $reservation) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')">
                        @csrf
                        <input type="hidden" name="status" value="cancelled">
                        <button type="submit" class="btn btn-danger w-100 py-2" style="border-radius:10px;">
                            <i class="bi bi-x-circle me-1"></i> Annuler la réservation
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

@if($reservation->notes ?? false)
    <div class="card mt-4">
        <div class="card-header">
            <h6 class="fw-bold mb-0" style="font-size:0.9rem;"><i class="bi bi-chat-left-text me-2" style="color:var(--dore);"></i>Notes</h6>
        </div>
        <div class="card-body">
            <p class="mb-0" style="line-height:1.7;">{{ $reservation->notes }}</p>
        </div>
    </div>
@endif
@endsection
