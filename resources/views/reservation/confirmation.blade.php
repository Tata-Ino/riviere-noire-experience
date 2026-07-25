@extends('layouts.app')

@section('title', 'Réservation Confirmée - Rivière Noire Experience')
@section('navbar_class', 'scrolled')

@section('content')

    <section class="py-5" style="margin-top: 100px;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-7">

                    {{-- Success Icon --}}
                    <div class="text-center mb-5">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-4" style="width: 100px; height: 100px; background-color: rgba(46, 125, 50, 0.1);">
                            <i class="bi bi-check-circle-fill" style="font-size: 3.5rem; color: var(--color-primary);"></i>
                        </div>
                        <h1 class="fw-bold mb-3" style="color: var(--color-primary);">
                            @if(App::getLocale() == 'en') Reservation Confirmed!
                            @elseif(App::getLocale() == 'pt') Reserva Confirmada!
                            @else Réservation confirmée !
                            @endif
                        </h1>
                        <p class="lead text-muted" style="max-width: 500px; margin: 0 auto;">
                            @if(App::getLocale() == 'en') Thank you for your booking. You will receive a confirmation email shortly.
                            @elseif(App::getLocale() == 'pt') Obrigado pela sua reserva. Você receberá um email de confirmação em breve.
                            @else Merci pour votre réservation. Vous recevrez un email de confirmation sous peu.
                            @endif
                        </p>
                    </div>

                    {{-- Reservation Details Card --}}
                    <div class="card border-0 shadow-sm p-4 p-md-5" style="border-radius: 20px; border-top: 4px solid var(--color-accent) !important;">
                        <h4 class="fw-bold mb-4" style="color: var(--color-primary);">
                            <i class="bi bi-receipt me-2"></i>
                            @if(App::getLocale() == 'en') Reservation Details
                            @elseif(App::getLocale() == 'pt') Detalhes da Reserva
                            @else Détails de la réservation
                            @endif
                        </h4>

                        <div class="row g-3">
                            {{-- Reference --}}
                            <div class="col-md-6">
                                <div class="p-3" style="background-color: #f8f9fa; border-radius: 10px;">
                                    <small class="text-muted d-block mb-1">
                                        @if(App::getLocale() == 'en') Reference
                                        @elseif(App::getLocale() == 'pt') Referência
                                        @else Référence
                                        @endif
                                    </small>
                                    <span class="fw-bold fs-5" style="color: var(--color-secondary);">{{ $reservation->reference ?? 'RNE-' . str_pad($reservation->id ?? 1, 5, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="col-md-6">
                                <div class="p-3" style="background-color: #f8f9fa; border-radius: 10px;">
                                    <small class="text-muted d-block mb-1">
                                        @if(App::getLocale() == 'en') Status
                                        @elseif(App::getLocale() == 'pt') Estado
                                        @else Statut
                                        @endif
                                    </small>
                                    <span class="badge px-3 py-2" style="background-color: rgba(249, 168, 37, 0.15); color: #c58a00; font-size: 0.85rem;">
                                        <i class="bi bi-clock me-1"></i>{{ $reservation->status ?? 'En attente' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Name --}}
                            <div class="col-md-6">
                                <div class="p-3" style="background-color: #f8f9fa; border-radius: 10px;">
                                    <small class="text-muted d-block mb-1">
                                        @if(App::getLocale() == 'en') Name
                                        @elseif(App::getLocale() == 'pt') Nome
                                        @else Nom
                                        @endif
                                    </small>
                                    <span class="fw-semibold">{{ $reservation->full_name ?? '' }}</span>
                                </div>
                            </div>

                            {{-- Date --}}
                            <div class="col-md-6">
                                <div class="p-3" style="background-color: #f8f9fa; border-radius: 10px;">
                                    <small class="text-muted d-block mb-1">
                                        @if(App::getLocale() == 'en') Visit Date
                                        @elseif(App::getLocale() == 'pt') Data da Visita
                                        @else Date de visite
                                        @endif
                                    </small>
                                    <span class="fw-semibold">{{ $reservation->visit_date ? \Carbon\Carbon::parse($reservation->visit_date)->format('d/m/Y') : '' }}</span>
                                </div>
                            </div>

                            {{-- Persons --}}
                            <div class="col-md-6">
                                <div class="p-3" style="background-color: #f8f9fa; border-radius: 10px;">
                                    <small class="text-muted d-block mb-1">
                                        @if(App::getLocale() == 'en') Number of People
                                        @elseif(App::getLocale() == 'pt') Número de Pessoas
                                        @else Nombre de personnes
                                        @endif
                                    </small>
                                    <span class="fw-semibold">{{ $reservation->nb_persons ?? 1 }}</span>
                                </div>
                            </div>

                            {{-- Amount --}}
                            <div class="col-md-6">
                                <div class="p-3" style="background-color: #f8f9fa; border-radius: 10px;">
                                    <small class="text-muted d-block mb-1">
                                        @if(App::getLocale() == 'en') Total Amount
                                        @elseif(App::getLocale() == 'pt') Valor Total
                                        @else Montant total
                                        @endif
                                    </small>
                                    <span class="fw-bold fs-5" style="color: var(--color-accent);">{{ number_format($reservation->total_amount ?? 0, 0, ',', '.') }} FCFA</span>
                                </div>
                            </div>
                        </div>

                        {{-- Note --}}
                        <div class="mt-4 p-3" style="background-color: rgba(21, 101, 192, 0.05); border-radius: 10px; border-left: 3px solid var(--color-secondary);">
                            <div class="d-flex align-items-start gap-2">
                                <i class="bi bi-envelope-check mt-1" style="color: var(--color-secondary);"></i>
                                <small class="text-muted">
                                    @if(App::getLocale() == 'en') A confirmation email has been sent to your address. Please check your inbox (and spam folder).
                                    @elseif(App::getLocale() == 'pt') Um email de confirmação foi enviado para o seu endereço. Verifique sua caixa de entrada (e pasta de spam).
                                    @else Un email de confirmation a été envoyé à votre adresse. Veuillez vérifier votre boîte de réception (et les spams).
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="text-center mt-5">
                        <a href="{{ route('home') }}" class="btn btn-accent btn-lg px-5 py-3">
                            <i class="bi bi-house me-2"></i>
                            @if(App::getLocale() == 'en') Back to Home
                            @elseif(App::getLocale() == 'pt') Voltar ao Início
                            @else Retour à l'accueil
                            @endif
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
