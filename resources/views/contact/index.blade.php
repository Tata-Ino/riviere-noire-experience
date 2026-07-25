@extends('layouts.app')

@section('title', 'Contact - Rivière Noire Experience')
@section('navbar_class', 'force-scrolled')

@section('content')

    {{-- Hero Section --}}
    <section class="position-relative d-flex align-items-center" style="min-height: 45vh; background: linear-gradient(135deg, var(--c-dark) 0%, var(--c-primary-dark) 100%);">
        <div class="container text-white text-center py-5" style="padding-top: 8rem !important;">
            <div class="row justify-content-center">
                <div class="col-lg-8 reveal">
                    <span class="section-badge" style="background:rgba(249,168,37,0.15); color:var(--c-accent); border:1px solid rgba(249,168,37,0.25);"><i class="bi bi-envelope"></i> @if(App::getLocale() == 'en') Contact @elseif(App::getLocale() == 'pt') Contato @else Contact @endif</span>
                    <h1 class="section-title mt-3 mb-3" style="color:#fff; font-size:clamp(2rem,4vw,3.5rem);">
                        @if(App::getLocale() == 'en') Contact Us
                        @elseif(App::getLocale() == 'pt') Contate-nos
                        @else Contactez-nous
                        @endif
                    </h1>
                    <div class="section-divider mx-auto" style="background:linear-gradient(90deg, var(--c-accent), var(--c-accent-light));"></div>
                    <p class="mt-3" style="opacity:0.8; font-size:1.1rem;">
                        @if(App::getLocale() == 'en') We are here to answer all your questions.
                        @elseif(App::getLocale() == 'pt') Estamos aqui para responder a todas as suas perguntas.
                        @else Nous sommes ici pour répondre à toutes vos questions.
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="position-absolute bottom-0 start-0 w-100" style="height:80px; background:linear-gradient(to top, var(--c-bg), transparent);"></div>
    </section>

    {{-- Contact Section --}}
    <section class="py-5">
        <div class="container py-5">
            <div class="row g-5">
                {{-- Contact Info --}}
                <div class="col-lg-5">
                    <h3 class="fw-bold mb-4" style="color: var(--color-primary);">
                        @if(App::getLocale() == 'en') Get in Touch
                        @elseif(App::getLocale() == 'pt') Entre em Contato
                        @else Contactez-nous
                        @endif
                    </h3>
                    <p class="text-muted mb-4" style="line-height: 1.8;">
                        @if(App::getLocale() == 'en') Have a question or want to book an experience? Contact us through the following channels.
                        @elseif(App::getLocale() == 'pt') Tem uma pergunta ou quer reservar uma experiência? Entre em contato através dos seguintes canais.
                        @else Une question ou envie de réserver une expérience ? Contactez-nous par les canaux suivants.
                        @endif
                    </p>

                    {{-- Phone --}}
                    <div class="card border-0 shadow-sm p-4 mb-3" style="border-radius: 14px; border-left: 4px solid var(--color-primary) !important;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width: 55px; height: 55px; background-color: rgba(46, 125, 50, 0.1);">
                                <i class="bi bi-telephone-fill fs-5" style="color: var(--color-primary);"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Téléphone</h6>
                                <a href="tel:{{ $contacts->phone }}" class="text-muted text-decoration-none">{{ $contacts->phone }}</a>
                            </div>
                        </div>
                    </div>

                    {{-- WhatsApp --}}
                    <div class="card border-0 shadow-sm p-4 mb-3" style="border-radius: 14px; border-left: 4px solid #25D366 !important;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width: 55px; height: 55px; background-color: rgba(37, 211, 102, 0.1);">
                                <i class="bi bi-whatsapp fs-5" style="color: #25D366;"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">WhatsApp</h6>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contacts->whatsapp) }}" target="_blank" class="text-muted text-decoration-none">{{ $contacts->whatsapp }}</a>
                            </div>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 14px; border-left: 4px solid var(--color-secondary) !important;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width: 55px; height: 55px; background-color: rgba(21, 101, 192, 0.1);">
                                <i class="bi bi-envelope-fill fs-5" style="color: var(--color-secondary);"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Email</h6>
                                <a href="mailto:{{ $contacts->email }}" class="text-muted text-decoration-none">{{ $contacts->email }}</a>
                            </div>
                        </div>
                    </div>

                    {{-- Social Media --}}
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--color-primary);">
                            @if(App::getLocale() == 'en') Follow Us
                            @elseif(App::getLocale() == 'pt') Siga-nos
                            @else Suivez-nous
                            @endif
                        </h6>
                        <div class="d-flex gap-2">
                            <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-twitter-x"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-tiktok"></i></a>
                        </div>
                    </div>

                    {{-- Business Hours --}}
                    <div class="card border-0 shadow-sm p-4" style="border-radius: 14px; background: linear-gradient(135deg, rgba(46, 125, 50, 0.05), rgba(21, 101, 192, 0.05));">
                        <h6 class="fw-bold mb-3" style="color: var(--color-primary);">
                            <i class="bi bi-clock me-2"></i>
                            @if(App::getLocale() == 'en') Business Hours
                            @elseif(App::getLocale() == 'pt') Horário de Funcionamento
                            @else Horaires d'ouverture
                            @endif
                        </h6>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Lundi - Vendredi</span>
                            <span class="fw-semibold">08:00 - 18:00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Samedi</span>
                            <span class="fw-semibold">08:00 - 16:00</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Dimanche</span>
                            <span class="fw-semibold" style="color: var(--color-accent);">
                                @if(App::getLocale() == 'en') Closed
                                @elseif(App::getLocale() == 'pt') Fechado
                                @else Fermé
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Map --}}
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 16px; min-height: 500px;">
                        @if($contacts->maps_link ?? false)
                            <iframe
                                src="{{ $contacts->maps_link }}"
                                width="100%"
                                height="500"
                                style="border:0; min-height: 500px;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        @else
                            <div class="gradient-placeholder h-100" style="min-height: 500px; border-radius: 0; background: linear-gradient(135deg, #e8f5e9, #e3f2fd);">
                                <div class="text-center p-5">
                                    <i class="bi bi-map" style="font-size: 5rem; color: var(--color-primary); opacity: 0.3;"></i>
                                    <p class="mt-3 text-muted">
                                        <i class="bi bi-geo-alt-fill me-1" style="color: var(--color-primary);"></i>
                                        Adjarra, Ouémé, Bénin
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
