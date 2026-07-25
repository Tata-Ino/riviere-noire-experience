@extends('layouts.app')

@section('title', 'Paiement - Rivière Noire Experience')
@section('navbar_class', 'force-scrolled')

@section('content')

    <section class="reservation-hero">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-5 fw-bold mb-3">
                        <i class="bi bi-shield-lock me-2"></i>
                        @if(App::getLocale() == 'en') Secure Payment
                        @elseif(App::getLocale() == 'pt') Pagamento Seguro
                        @else Paiement Sécurisé
                        @endif
                    </h1>
                    <p class="lead" style="opacity: 0.9;">
                        @if(App::getLocale() == 'en') Complete your reservation by paying securely via MTN Mobile Money.
                        @elseif(App::getLocale() == 'pt') Complete sua reserva pagando de forma segura via MTN Mobile Money.
                        @else Complétez votre réservation en payant de manière sécurisée via MTN Mobile Money.
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <div class="card border-0 shadow-sm" style="border-radius: 16px; overflow: hidden;">
                        <div class="card-header bg-white border-bottom p-4">
                            <h4 class="fw-bold mb-0" style="color: var(--color-primary);">
                                <i class="bi bi-receipt me-2"></i>
                                @if(App::getLocale() == 'en') Reservation Summary
                                @elseif(App::getLocale() == 'pt') Resumo da Reserva
                                @else Résumé de la réservation
                                @endif
                            </h4>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <div class="p-3" style="background: #f8f9fa; border-radius: 10px;">
                                        <small class="text-muted d-block mb-1">Réf. Réservation</small>
                                        <strong class="fs-5" style="color: var(--color-primary);">#{{ $reservation->id }}</strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3" style="background: #f8f9fa; border-radius: 10px;">
                                        <small class="text-muted d-block mb-1">
                                            @if(App::getLocale() == 'en') Status
                                            @elseif(App::getLocale() == 'pt') Status
                                            @else Statut
                                            @endif
                                        </small>
                                        <span class="badge badge-pending fs-6">
                                            <i class="bi bi-clock me-1"></i>
                                            @if(App::getLocale() == 'en') Awaiting Payment
                                            @elseif(App::getLocale() == 'pt') Aguardando Pagamento
                                            @else En attente de paiement
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td class="text-muted" style="width: 50%;">
                                            <i class="bi bi-person me-2" style="color: var(--color-accent);"></i>
                                            @if(App::getLocale() == 'en') Name
                                            @elseif(App::getLocale() == 'pt') Nome
                                            @else Nom
                                            @endif
                                        </td>
                                        <td class="fw-semibold">{{ $reservation->full_name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <i class="bi bi-envelope me-2" style="color: var(--color-accent);"></i>Email
                                        </td>
                                        <td class="fw-semibold">{{ $reservation->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <i class="bi bi-telephone me-2" style="color: var(--color-accent);"></i>
                                            @if(App::getLocale() == 'en') Phone
                                            @elseif(App::getLocale() == 'pt') Telefone
                                            @else Téléphone
                                            @endif
                                        </td>
                                        <td class="fw-semibold">{{ $reservation->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <i class="bi bi-geo-alt me-2" style="color: var(--color-accent);"></i>
                                            @if(App::getLocale() == 'en') Country
                                            @elseif(App::getLocale() == 'pt') País
                                            @else Pays
                                            @endif
                                        </td>
                                        <td class="fw-semibold">{{ $reservation->country }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <i class="bi bi-calendar me-2" style="color: var(--color-accent);"></i>
                                            @if(App::getLocale() == 'en') Visit Date
                                            @elseif(App::getLocale() == 'pt') Data da Visita
                                            @else Date de visite
                                            @endif
                                        </td>
                                        <td class="fw-semibold">{{ \Carbon\Carbon::parse($reservation->visit_date)->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <i class="bi bi-people me-2" style="color: var(--color-accent);"></i>
                                            @if(App::getLocale() == 'en') Number of People
                                            @elseif(App::getLocale() == 'pt') Número de Pessoas
                                            @else Nombre de personnes
                                            @endif
                                        </td>
                                        <td class="fw-semibold">{{ $reservation->nb_persons }}</td>
                                    </tr>
                                    @if($reservation->place)
                                    <tr>
                                        <td class="text-muted">
                                            <i class="bi bi-map me-2" style="color: var(--color-accent);"></i>
                                            @if(App::getLocale() == 'en') Destination
                                            @elseif(App::getLocale() == 'pt') Destino
                                            @else Lieu
                                            @endif
                                        </td>
                                        <td class="fw-semibold">{{ $reservation->place->translate(App::getLocale())?->name ?? $reservation->place->translate('fr')?->name }}</td>
                                    </tr>
                                    @endif
                                    @if($reservation->excursion)
                                    <tr>
                                        <td class="text-muted">
                                            <i class="bi bi-compass me-2" style="color: var(--color-accent);"></i>Excursion
                                        </td>
                                        <td class="fw-semibold">{{ $reservation->excursion->translate(App::getLocale())?->name ?? $reservation->excursion->translate('fr')?->name }}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>

                            <hr class="my-4">

                            <div class="d-flex justify-content-between align-items-center px-3 py-2">
                                <h4 class="fw-bold mb-0" style="color: var(--color-primary);">
                                    @if(App::getLocale() == 'en') Total to Pay
                                    @elseif(App::getLocale() == 'pt') Total a Pagar
                                    @else Total à payer
                                    @endif
                                </h4>
                                <h3 class="fw-bold mb-0" style="color: var(--color-accent);">
                                    {{ number_format($payment->amount, 0, ',', '.') }} {{ $payment->currency }}
                                </h3>
                            </div>
                        </div>
                    </div>

                    {{-- Kkiapay Payment Widget --}}
                    <div class="card border-0 shadow-sm mt-4" style="border-radius: 16px; overflow: hidden;">
                        <div class="card-body p-4 text-center">
                            <h5 class="fw-bold mb-3" style="color: var(--color-secondary);">
                                <i class="bi bi-phone me-2"></i>
                                @if(App::getLocale() == 'en') Pay with Mobile Money
                                @elseif(App::getLocale() == 'pt') Pague com Mobile Money
                                @else Payer avec Mobile Money
                                @endif
                            </h5>
                            <p class="text-muted mb-4">
                                @if(App::getLocale() == 'en') Click the button below to open the secure payment widget.
                                @elseif(App::getLocale() == 'pt') Clique no botão abaixo para abrir o widget de pagamento seguro.
                                @else Cliquez sur le bouton ci-dessous pour ouvrir le widget de paiement sécurisé.
                                @endif
                            </p>

                            <button id="kkiapay-button" class="btn btn-accent btn-lg px-5 py-3" style="font-size: 1.1rem;">
                                <i class="bi bi-credit-card me-2"></i>
                                @if(App::getLocale() == 'en') Pay {{ number_format($payment->amount, 0, ',', '.') }} {{ $payment->currency }}
                                @elseif(App::getLocale() == 'pt') Pagar {{ number_format($payment->amount, 0, ',', '.') }} {{ $payment->currency }}
                                @else Payer {{ number_format($payment->amount, 0, ',', '.') }} {{ $payment->currency }}
                                @endif
                            </button>

                            <div class="mt-4">
                                <small class="text-muted">
                                    <i class="bi bi-shield-check me-1"></i>
                                    @if(App::getLocale() == 'en') Payment secured by Kkiapay. Your data is encrypted.
                                    @elseif(App::getLocale() == 'pt') Pagamento garantido pela Kkiapay. Seus dados são criptografados.
                                    @else Paiement sécurisé par Kkiapay. Vos données sont chiffrées.
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>

                    {{-- Reservation Reference --}}
                    <div class="text-center mt-4">
                        <small class="text-muted">
                            @if(App::getLocale() == 'en') Reservation Reference: #{{ $reservation->id }} | Payment Reference: #{{ $payment->id }}
                            @elseif(App::getLocale() == 'pt') Referência da Reserva: #{{ $reservation->id }} | Referência do Pagamento: #{{ $payment->id }}
                            @else Référence de réservation : #{{ $reservation->id }} | Référence de paiement : #{{ $payment->id }}
                            @endif
                        </small>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script src="https://cdn.kkiapay.me/k.js"></script>
<script>
    document.getElementById('kkiapay-button').addEventListener('click', function() {
        openKkiapayWidget({
            amount: {{ $payment->amount }},
            position: "center",
            callback: "",
            data: "",
            theme: "#F9A825",
            key: "{{ config('services_custom.kkiapay.public_key') }}",
            sandbox: {{ config('app.env') !== 'production' ? 'true' : 'false' }},
            token: ""
        });
    });

    window.addEventListener('message', function(event) {
        if (event.data && event.data.transactionId) {
            // Redirect to confirmation page
            window.location.href = "{{ route('reservations.confirmation', $reservation->id) }}";
        }
    });
</script>
@endpush
