@extends('layouts.app')

@section('title', ($place->name ?? 'Destination') . ' - Rivière Noire Experience')
@section('navbar_class', 'force-scrolled')

@section('content')

    {{-- Breadcrumb --}}
    <section class="pt-5 pb-3" style="margin-top:70px;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="background:transparent; padding:0;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:var(--c-primary); font-weight:500;">@if(App::getLocale() == 'en') Home @elseif(App::getLocale() == 'pt') Início @else Accueil @endif</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('places.index') }}" style="color:var(--c-primary); font-weight:500;">@if(App::getLocale() == 'en') Places @elseif(App::getLocale() == 'pt') Locais @else Lieux @endif</a></li>
                    <li class="breadcrumb-item active" style="color:var(--c-text-muted);">{{ $place->name ?? '' }}</li>
                </ol>
            </nav>
        </div>
    </section>

    {{-- Cover Image --}}
    <section class="pb-5">
        <div class="container">
            @php
                $coverImages = [
                    'riviere-noire-adjarra' => 'image_riviere_noire2.jpeg',
                    'ouidah' => 'porte-du-non-retour.png',
                    'porto-novo' => 'place-bayol.png',
                    'abomey' => 'statut-roi-behanzin.png',
                    'ganvie' => 'ganvie2.jpeg',
                ];
                $slug = $place->slug ?? '';
            @endphp
            @if(isset($coverImages[$slug]))
                <div class="reveal" style="border-radius:var(--radius-2xl); overflow:hidden; box-shadow:var(--shadow-2xl);">
                    <img src="{{ asset('images/' . $coverImages[$slug]) }}" alt="{{ $place->name }}" style="width:100%; display:block;">
                </div>
            @else
                <div class="gradient-placeholder reveal" style="min-height:400px; border-radius:var(--radius-2xl);">
                    <i class="bi bi-geo-alt" style="font-size:5rem;"></i>
                </div>
            @endif
        </div>
    </section>

    {{-- Place Details --}}
    <section class="pb-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="reveal">
                        <div class="d-flex align-items-center gap-3 mb-3 flex-wrap">
                            <h1 style="font-family:var(--font-heading); font-weight:700; color:var(--c-text); font-size:clamp(1.8rem,3vw,2.5rem);">{{ $place->name ?? '' }}</h1>
                            @if($place->price ?? false)
                                <span class="badge" style="background:linear-gradient(135deg, var(--c-accent), var(--c-accent-light)); color:var(--c-dark); font-weight:700; padding:0.5rem 1rem; border-radius:var(--radius-full); font-size:0.95rem;">
                                    {{ number_format($place->price, 0, ',', '.') }} FCFA
                                </span>
                            @endif
                        </div>

                        @if($place->short_description ?? false)
                            <p style="line-height:1.9; color:var(--c-text-light); font-size:1.1rem; margin-bottom:1.5rem;">{{ $place->short_description }}</p>
                        @endif

                        <div class="section-divider mb-4"></div>

                        <div style="line-height:1.9; color:var(--c-text);">
                            {!! $place->description ?? '' !!}
                        </div>
                    </div>

                    {{-- Gallery --}}
                    @if(isset($place->media) && $place->media->count())
                        <div class="mb-5 mt-5 reveal">
                            <h3 style="font-family:var(--font-heading); font-weight:700; color:var(--c-text); margin-bottom:1.5rem;">
                                <i class="bi bi-images me-2" style="color:var(--c-primary);"></i>
                                @if(App::getLocale() == 'en') Photo Gallery
                                @elseif(App::getLocale() == 'pt') Galeria de Fotos
                                @else Galerie Photos
                                @endif
                            </h3>
                            <div class="row g-3">
                                @foreach($place->media as $media)
                                    <div class="col-md-4 col-6">
                                        <div class="card-premium" style="border-radius:var(--radius-lg);">
                                            <div class="gradient-placeholder gradient-placeholder-sm" style="min-height:160px;"><i class="bi bi-image"></i></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- DB Excursions --}}
                    @if(isset($place->excursions) && $place->excursions->count())
                        <div class="mb-5 mt-5 reveal">
                            <h3 style="font-family:var(--font-heading); font-weight:700; color:var(--c-text); margin-bottom:1.5rem;">
                                <i class="bi bi-compass me-2" style="color:var(--c-primary);"></i>
                                @if(App::getLocale() == 'en') Related Excursions
                                @elseif(App::getLocale() == 'pt') Excursões Relacionadas
                                @else Excursions associées
                                @endif
                            </h3>
                            <div class="row g-3">
                                @foreach($place->excursions as $excursion)
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
                                    <div class="col-md-6">
                                        <div class="card-premium">
                                            @if(isset($excImages[$excSlug]))
                                                <div class="card-img-wrap" style="aspect-ratio:16/10;">
                                                    <img src="{{ asset('images/' . $excImages[$excSlug]) }}" alt="{{ $excursion->name }}" style="width:100%; height:100%; object-fit:cover; display:block;">
                                                </div>
                                            @endif
                                            <div class="p-4">
                                                <h5 style="font-family:var(--font-heading); font-weight:700;">{{ $excursion->name }}</h5>
                                                <div class="d-flex gap-3 mt-2 mb-3">
                                                    <span class="section-badge section-badge-blue" style="font-size:0.72rem; padding:0.3rem 0.7rem;"><i class="bi bi-clock"></i> {{ $excursion->duration_formatted ?? $excursion->duration }}</span>
                                                    <span class="badge px-3 py-2" style="background-color: var(--color-secondary); color: #fff; font-size: 0.8rem; border-radius: var(--radius-full);">
                                                    @if(App::getLocale() == 'en') Included
                                                    @elseif(App::getLocale() == 'pt') Incluído
                                                    @else Inclus
                                                    @endif
                                                </span>
                                                </div>
                                                <a href="{{ route('excursions.show', $excursion->slug ?? $excursion->id) }}" class="btn btn-sm btn-ghost" style="font-size:0.85rem;">
                                                    @if(App::getLocale() == 'en') View @elseif(App::getLocale() == 'pt') Ver @else Voir @endif <i class="bi bi-arrow-right ms-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($slug === 'ouidah')
                        <div class="mb-5 mt-5">
                            <h3 style="font-family:var(--font-heading); font-weight:700; color:var(--c-text); margin-bottom:1.5rem;">
                                <i class="bi bi-compass me-2" style="color:var(--c-primary);"></i>
                                @if(App::getLocale() == 'en') Sites to Discover
                                @elseif(App::getLocale() == 'pt') Locais para Descobrir
                                @else Sites à découvrir
                                @endif
                            </h3>

                            <div class="card-premium mb-4 reveal stagger-1">
                                <div class="card-img-wrap" style="aspect-ratio:16/9;">
                                    <img src="{{ asset('images/Temple-Pyhons-2-1024x768.jpg') }}" alt="Temple des Pythons" style="width:100%; height:100%; object-fit:cover; display:block;">
                                </div>
                                <div class="p-4">
                                    <h4 style="font-family:var(--font-heading); font-weight:700; color:var(--c-text);">Temple des Pythons</h4>
                                    <p style="line-height:1.8; color:var(--c-text-light); margin-top:0.75rem;">
                                        @if(App::getLocale() == 'en')
                                            One of Ouidah's most fascinating sites, the Python Temple is a sacred sanctuary where dozens of royal pythons roam freely. In Vodun tradition, these snakes are revered as messengers of the divine.
                                        @elseif(App::getLocale() == 'pt')
                                            Um dos sites mais fascinantes de Ouidah, o Templo das Pítons é um santuário sagrado onde dezenas de pítons reais vagueiam livremente.
                                        @else
                                            L'un des sites les plus fascinants d'Ouidah, le Temple des Pythons est un sanctuaire sacré où des dizaines de pythons royaux évoluent en liberté.
                                        @endif
                                    </p>
                                    <div class="d-flex gap-2 mt-3">
                                        <span class="section-badge section-badge-green" style="font-size:0.72rem; padding:0.3rem 0.7rem;"><i class="bi bi-geo-alt"></i> Ouidah Centre</span>
                                        <span class="section-badge section-badge-blue" style="font-size:0.72rem; padding:0.3rem 0.7rem;"><i class="bi bi-clock"></i> 1h</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($slug === 'abomey')
                        <div class="mb-5 mt-5">
                            <h3 style="font-family:var(--font-heading); font-weight:700; color:var(--c-text); margin-bottom:1.5rem;">
                                <i class="bi bi-compass me-2" style="color:var(--c-primary);"></i>
                                @if(App::getLocale() == 'en') Sites to Discover
                                @elseif(App::getLocale() == 'pt') Locais para Descobrir
                                @else Sites à découvrir
                                @endif
                            </h3>

                            <div class="card-premium mb-4 reveal stagger-1">
                                <div class="card-img-wrap" style="aspect-ratio:16/9;">
                                    <img src="{{ asset('images/palais-roi-glele.png') }}" alt="Palais du Roi Glèlè" style="width:100%; height:100%; object-fit:cover; display:block;">
                                </div>
                                <div class="p-4">
                                    <h4 style="font-family:var(--font-heading); font-weight:700; color:var(--c-text);">Palais du Roi Glèlè</h4>
                                    <p style="line-height:1.8; color:var(--c-text-light); margin-top:0.75rem;">
                                        @if(App::getLocale() == 'en')
                                            A UNESCO World Heritage Site, the Palace of King Glèlè is a masterpiece of Dahomean architecture and art. The palace walls are adorned with intricate bas-reliefs depicting the kingdom's military victories.
                                        @elseif(App::getLocale() == 'pt')
                                            Patrimônio Mundial da UNESCO, o Palácio do Rei Glèlè é uma obra-prima da arquitetura e arte dahomeanas.
                                        @else
                                            Site du patrimoine mondial de l'UNESCO, le Palais du roi Glèlè est un chef-d'œuvre de l'architecture et de l'art dahoméens.
                                        @endif
                                    </p>
                                    <div class="d-flex gap-2 mt-3">
                                        <span class="section-badge section-badge-green" style="font-size:0.72rem; padding:0.3rem 0.7rem;"><i class="bi bi-geo-alt"></i> Abomey</span>
                                        <span class="section-badge section-badge-blue" style="font-size:0.72rem; padding:0.3rem 0.7rem;"><i class="bi bi-clock"></i> 2-3h</span>
                                    </div>
                                </div>
                            </div>

                            <div class="card-premium mb-4 reveal stagger-2">
                                <div class="card-img-wrap" style="aspect-ratio:16/9;">
                                    <img src="{{ asset('images/Musée historique d_Abomey- (1).webp') }}" alt="Musée Historique d'Abomey" style="width:100%; height:100%; object-fit:cover; display:block;">
                                </div>
                                <div class="p-4">
                                    <h4 style="font-family:var(--font-heading); font-weight:700; color:var(--c-text);">Musée Historique d'Abomey</h4>
                                    <p style="line-height:1.8; color:var(--c-text-light); margin-top:0.75rem;">
                                        @if(App::getLocale() == 'en')
                                            Housed within the former royal palaces, the Abomey Historical Museum is a treasure trove of Dahomean civilization. Its collection includes thrones, ceremonial costumes, weapons, and famous narrative bas-reliefs.
                                        @elseif(App::getLocale() == 'pt')
                                            Localizado nos antigos palácios reais, o Museu Histórico de Abomey é um tesouro da civilização dahomeana.
                                        @else
                                            Installé dans les anciens palais royaux, le Musée Historique d'Abomey est un trésor de la civilisation dahoméenne.
                                        @endif
                                    </p>
                                    <div class="d-flex gap-2 mt-3">
                                        <span class="section-badge section-badge-green" style="font-size:0.72rem; padding:0.3rem 0.7rem;"><i class="bi bi-geo-alt"></i> Abomey</span>
                                        <span class="section-badge section-badge-blue" style="font-size:0.72rem; padding:0.3rem 0.7rem;"><i class="bi bi-clock"></i> 2-3h</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Restaurant Info --}}
                    @if(isset($place->restaurant))
                        <div class="card-premium p-4 mb-5 reveal" style="border-left:4px solid var(--c-accent);">
                            <div class="d-flex align-items-start gap-3">
                                <div style="width:48px; height:48px; border-radius:50%; background:linear-gradient(135deg, var(--c-accent), var(--c-accent-light)); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                    <i class="bi bi-cup-hot-fill" style="color:var(--c-dark);"></i>
                                </div>
                                <div>
                                    <h4 style="font-family:var(--font-heading); font-weight:700; color:var(--c-text); margin-bottom:0.5rem;">
                                        @if(App::getLocale() == 'en') On-site Restaurant
                                        @elseif(App::getLocale() == 'pt') Restaurante no Local
                                        @else Restaurant sur place
                                        @endif
                                    </h4>
                                    <p class="mb-0" style="line-height:1.7; color:var(--c-text-light);">
                                        @if(App::getLocale() == 'en') Enjoy a meal with a view of the river. Fresh local dishes prepared with love.
                                        @elseif(App::getLocale() == 'pt') Aproveite uma refeição com vista para o rio.
                                        @else Savourez un repas avec vue sur la rivière.
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="col-lg-4">
                    <div class="card-premium p-4" style="position:sticky; top:100px; border-radius:var(--radius-xl);">
                        <h5 style="font-family:var(--font-heading); font-weight:700; color:var(--c-text); margin-bottom:1.5rem;">
                            <i class="bi bi-info-circle me-2" style="color:var(--c-primary);"></i>
                            @if(App::getLocale() == 'en') Summary
                            @elseif(App::getLocale() == 'pt') Resumo
                            @else Résumé
                            @endif
                        </h5>

                        @if($place->price ?? false)
                            <div class="d-flex justify-content-between align-items-center mb-3 pb-3" style="border-bottom:1px solid var(--c-border);">
                                <span style="color:var(--c-text-light); font-size:0.9rem;">
                                    @if(App::getLocale() == 'en') Entry fee
                                    @elseif(App::getLocale() == 'pt') Taxa de entrada
                                    @else Tarif d'entrée
                                    @endif
                                </span>
                                <span class="fw-bold" style="color:var(--c-accent-dark); font-size:1.1rem;">{{ number_format($place->price, 0, ',', '.') }} FCFA</span>
                            </div>
                        @endif

                        <div class="mb-3 pb-3" style="border-bottom:1px solid var(--c-border);">
                            <span style="color:var(--c-text-light); font-size:0.85rem; display:block; margin-bottom:0.3rem;">
                                @if(App::getLocale() == 'en') Opening hours
                                @elseif(App::getLocale() == 'pt') Horário de funcionamento
                                @else Horaires
                                @endif
                            </span>
                            <span class="fw-semibold" style="font-size:0.95rem;">08:00 - 18:00</span>
                        </div>

                        <div class="mb-4 pb-3" style="border-bottom:1px solid var(--c-border);">
                            <span style="color:var(--c-text-light); font-size:0.85rem; display:block; margin-bottom:0.3rem;">
                                @if(App::getLocale() == 'en') Location
                                @elseif(App::getLocale() == 'pt') Localização
                                @else Localisation
                                @endif
                            </span>
                            <span class="fw-semibold" style="font-size:0.95rem;">
                                <i class="bi bi-geo-alt me-1" style="color:var(--c-primary);"></i>{{ $place->name }}, Bénin
                            </span>
                        </div>

                        <a href="{{ route('reservations.create') }}" class="btn btn-accent w-100 py-3" style="font-size:1rem;">
                            <i class="bi bi-calendar-check me-2"></i>
                            @if(App::getLocale() == 'en') Book this experience
                            @elseif(App::getLocale() == 'pt') Reservar esta experiência
                            @else Réserver cette expérience
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
