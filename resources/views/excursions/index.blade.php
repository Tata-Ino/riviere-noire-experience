@extends('layouts.app')

@section('title', 'Nos Excursions - Rivière Noire Experience')
@section('navbar_class', 'force-scrolled')

@section('content')

    {{-- Hero Section --}}
    <section class="position-relative d-flex align-items-center" style="min-height: 45vh; background: linear-gradient(135deg, var(--c-dark) 0%, var(--c-primary-dark) 100%);">
        <div class="container text-white text-center py-5" style="padding-top: 8rem !important;">
            <div class="row justify-content-center">
                <div class="col-lg-8 reveal">
                    <span class="section-badge" style="background:rgba(249,168,37,0.15); color:var(--c-accent); border:1px solid rgba(249,168,37,0.25);"><i class="bi bi-compass"></i> @if(App::getLocale() == 'en') Adventures @elseif(App::getLocale() == 'pt') Aventuras @else Excursions @endif</span>
                    <h1 class="section-title mt-3 mb-3" style="color:#fff; font-size:clamp(2rem,4vw,3.5rem);">
                        @if(App::getLocale() == 'en') Our Excursions
                        @elseif(App::getLocale() == 'pt') Nossas Excursões
                        @else Nos Excursions
                        @endif
                    </h1>
                    <div class="section-divider mx-auto" style="background:linear-gradient(90deg, var(--c-accent), var(--c-accent-light));"></div>
                    <p class="mt-3" style="opacity:0.8; font-size:1.1rem;">
                        @if(App::getLocale() == 'en') Unique adventures tailored to every type of traveler.
                        @elseif(App::getLocale() == 'pt') Aventuras únicas adaptadas a cada tipo de viajante.
                        @else Des aventures uniques adaptées à chaque type de voyageur.
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="position-absolute bottom-0 start-0 w-100" style="height:80px; background:linear-gradient(to top, var(--c-bg), transparent);"></div>
    </section>

    {{-- Excursions Grid --}}
    <section class="py-5">
        <div class="container py-5">
            <div class="row g-4">
                @forelse($excursions as $excursion)
                    @php
                        $excImages = [
                            'balade-en-pirogue' => 'image_riviere_noire2.jpeg',
                            'atelier-vannerie' => 'atelier_de_vanerie.jpeg',
                            'observation-ornithologique' => 'visite_Ornithologique.jpeg',
                            'atelier-tambours' => 'atelier_de_tambour.jpeg',
                            'fabrication-sodabi' => 'fabrication_de_sodabi.jpeg',
                            'musee-honme-palais-royal' => 'palais-honme.jpeg',
                            'musee-des-masques' => 'musee-des-masques.jpeg',
                            'quartier-afro-bresilien-musee-da-silva' => 'musee-da-silva.jpeg',
                            'jardin-des-plantes-et-de-la-nature' => 'jpn.jpeg',
                            'temple-vodoun-abessan' => 'place-vodun-abessan4.jpg',
                        ];
                        $excSlug = $excursion->slug ?? '';
                    @endphp
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-custom h-100">
                            <div class="position-relative">
                                @if(isset($excImages[$excSlug]))
                                    <img src="{{ asset('images/' . $excImages[$excSlug]) }}" alt="{{ $excursion->name }}" style="width:100%; height:220px; object-fit:cover; display:block;">
                                @else
                                    <div class="gradient-placeholder gradient-placeholder-sm" style="border-radius: 0; min-height: 220px;">
                                        <i class="bi bi-compass" style="font-size: 3rem;"></i>
                                    </div>
                                @endif
                                @if($excursion->place ?? false)
                                    <span class="position-absolute top-0 start-0 m-3 badge" style="background-color: rgba(46, 125, 50, 0.9); color: #fff;">
                                        <i class="bi bi-geo-alt me-1"></i>{{ $excursion->place->name }}
                                    </span>
                                @endif
                            </div>
                            <div class="card-body p-4">
                                <h4 class="fw-bold mb-2" style="color: var(--color-text);">{{ $excursion->name }}</h4>

                                <div class="d-flex flex-wrap gap-3 mb-3">
                                    <span class="small" style="color: var(--color-secondary);">
                                        <i class="bi bi-clock me-1"></i>{{ $excursion->duration_formatted ?? $excursion->duration }}
                                    </span>
                                    @if($excursion->max_participants ?? false)
                                        <span class="small text-muted">
                                            <i class="bi bi-people me-1"></i>Max {{ $excursion->max_participants }}
                                        </span>
                                    @endif
                                </div>

                                <p class="text-muted mb-3" style="line-height: 1.7;">
                                    {{ Str::limit($excursion->description ?? '', 120) }}
                                </p>

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge px-3 py-2" style="background-color: var(--color-secondary); color: #fff; border-radius: var(--radius-full);">
                                        @if(App::getLocale() == 'en') Included
                                        @elseif(App::getLocale() == 'pt') Incluído
                                        @else Inclus @endif
                                    </span>
                                    <a href="{{ route('excursions.show', $excursion->slug ?? $excursion->id) }}" class="btn btn-sm btn-ghost" style="font-size:0.85rem; padding:0.4rem 1rem;">
                                        @if(App::getLocale() == 'en') Discover @elseif(App::getLocale() == 'pt') Descobrir @else Découvrir @endif <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-compass" style="font-size: 4rem; color: var(--color-primary); opacity: 0.3;"></i>
                        <h3 class="mt-3 text-muted">
                            @if(App::getLocale() == 'en') No excursions available yet.
                            @elseif(App::getLocale() == 'pt') Nenhuma excursão disponível ainda.
                            @else Aucune excursion disponible pour le moment.
                            @endif
                        </h3>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Floating Reserve Button --}}
    <a href="{{ route('reservations.create') }}" style="position:fixed; top:50%; right:24px; transform:translateY(-50%); z-index:9999; padding:16px 28px; border-radius:50px; background:linear-gradient(135deg,var(--c-accent),var(--c-accent-light)); color:var(--c-dark); display:flex; align-items:center; justify-content:center; font-size:1rem; font-weight:600; box-shadow:0 4px 20px rgba(249,168,37,0.35); text-decoration:none; transition:all 0.3s var(--ease); white-space:nowrap;">
        <i class="bi bi-calendar-check me-2"></i>
        @if(App::getLocale() == 'en') Book
        @elseif(App::getLocale() == 'pt') Reservar
        @else Réserver
        @endif
    </a>

@endsection
