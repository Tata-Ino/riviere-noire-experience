@extends('layouts.app')

@section('title', 'Accueil - Rivière Noire Experience')

@section('navbar_class', 'force-scrolled')

@section('content')

    {{-- ═══════ HERO ═══════ --}}
    <section class="position-relative d-flex align-items-center hero-section" style="min-height:100vh; overflow: hidden;">
        <div class="hero-bg-desktop" style="position:absolute; top:0; left:0; width:100%; height:100%; background: url('{{ asset('images/hero-bg.png') }}') center/cover no-repeat;"></div>
        <div class="hero-bg-mobile" style="position:absolute; top:0; left:0; width:100%; height:100%; background: url('{{ asset('images/riviere3.jpeg') }}') center/cover no-repeat;"></div>
        <div style="position:absolute; top:0; left:0; width:100%; height:100%; background: linear-gradient(135deg, rgba(15,23,42,0.75) 0%, rgba(15,23,42,0.45) 50%, rgba(15,23,42,0.2) 100%);"></div>
        <div style="position:absolute; top:0; left:0; width:100%; height:100%; background: linear-gradient(to top, rgba(15,23,42,0.9) 0%, transparent 40%);"></div>

        <div class="container position-relative text-white py-5" style="padding-top: 8rem !important;">
            <div class="row">
                <div class="col-lg-6 offset-lg-6">
                    <div class="reveal" style="transition-delay:0.2s;">
                        <span class="section-badge" style="background: rgba(249,168,37,0.15); color: var(--c-accent); border: 1px solid rgba(249,168,37,0.25); margin-bottom: 1.5rem; display: inline-flex;">
                            <i class="bi bi-geo-alt-fill"></i> Adjarra, Bénin
                        </span>
                    </div>

                    <h1 class="hero-title" id="heroTitle"
                        data-line1="{{ App::getLocale() == 'en' ? 'Discover' : (App::getLocale() == 'pt' ? 'Descubra' : 'Découvrez') }}"
                        data-line2="{{ App::getLocale() == 'en' ? 'the Black River' : (App::getLocale() == 'pt' ? 'o Rio Negro' : 'la Rivière Noire') }}"
                        style="font-family:var(--font-heading); font-size:clamp(2.5rem,6vw,4.5rem); font-weight:800; line-height:1.1; min-height:2.8em; letter-spacing:-0.02em; margin-bottom:1.5rem; color:#fff;">
                    </h1>

                    <p class="mb-5" id="heroDesc" style="max-width:500px; font-size:1.1rem; opacity:0; line-height:1.8; color:rgba(255,255,255,0.8);">
                        @if(App::getLocale() == 'en') An unforgettable journey through pristine nature, rich culture and unique adventures in the heart of Benin.
                        @elseif(App::getLocale() == 'pt') Uma jornada inesquecível pela natureza intocada, cultura rica e aventuras únicas no coração do Benin.
                        @else Une aventure inoubliable au cœur de la nature préservée, de la culture riche et des paysages exceptionnels du Bénin.
                        @endif
                    </p>

                    <div class="d-flex flex-wrap gap-3" id="heroButtons" style="opacity:0;">
                        <a href="{{ route('reservations.create') }}" class="btn btn-accent px-5 py-3">
                            <i class="bi bi-calendar-check me-2"></i>
                            @if(App::getLocale() == 'en') Book Now
                            @elseif(App::getLocale() == 'pt') Reservar Agora
                            @else Réserver maintenant
                            @endif
                        </a>
                        <a href="{{ route('places.index') }}" class="btn btn-outline-white px-5 py-3">
                            <i class="bi bi-compass me-2"></i>
                            @if(App::getLocale() == 'en') Explore
                            @elseif(App::getLocale() == 'pt') Explorar
                            @else Explorer
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════ STATS BAR ═══════ --}}
    <section style="background: var(--c-dark); color: #fff; overflow: hidden; padding: 1.1rem 0; border-bottom: 1px solid rgba(255,255,255,0.06);">
        <div class="marquee-track">
            <div class="marquee-content">
                @foreach([
                    ['icon' => 'bi-people-fill', 'value' => '5 000+', 'label_fr' => 'Visiteurs par an', 'label_en' => 'Visitors per year', 'label_pt' => 'Visitantes por ano'],
                    ['icon' => 'bi-geo-alt-fill', 'value' => '10+', 'label_fr' => 'Destinations', 'label_en' => 'Destinations', 'label_pt' => 'Destinos'],
                    ['icon' => 'bi-compass-fill', 'value' => '15+', 'label_fr' => 'Excursions', 'label_en' => 'Excursions', 'label_pt' => 'Excursões'],
                    ['icon' => 'bi-award-fill', 'value' => '10+', 'label_fr' => "Ans d'expérience", 'label_en' => 'Years of experience', 'label_pt' => 'Anos de experiência'],
                ] as $item)
                    <div class="marquee-item">
                        <i class="bi {{ $item['icon'] }}" style="color:var(--c-accent);"></i>
                        <span class="fw-bold" style="color:#fff;">{{ $item['value'] }}</span>
                        <span style="opacity:0.7;">
                            @if(App::getLocale() == 'en') {{ $item['label_en'] }}
                            @elseif(App::getLocale() == 'pt') {{ $item['label_pt'] }}
                            @else {{ $item['label_fr'] }}
                            @endif
                        </span>
                    </div>
                @endforeach
            </div>
            <div class="marquee-content" aria-hidden="true">
                @foreach([
                    ['icon' => 'bi-people-fill', 'value' => '5 000+', 'label_fr' => 'Visiteurs par an', 'label_en' => 'Visitors per year', 'label_pt' => 'Visitantes por ano'],
                    ['icon' => 'bi-geo-alt-fill', 'value' => '10+', 'label_fr' => 'Destinations', 'label_en' => 'Destinations', 'label_pt' => 'Destinos'],
                    ['icon' => 'bi-compass-fill', 'value' => '15+', 'label_fr' => 'Excursions', 'label_en' => 'Excursions', 'label_pt' => 'Excursões'],
                    ['icon' => 'bi-award-fill', 'value' => '10+', 'label_fr' => "Ans d'expérience", 'label_en' => 'Years of experience', 'label_pt' => 'Anos de experiência'],
                ] as $item)
                    <div class="marquee-item">
                        <i class="bi {{ $item['icon'] }}" style="color:var(--c-accent);"></i>
                        <span class="fw-bold" style="color:#fff;">{{ $item['value'] }}</span>
                        <span style="opacity:0.7;">
                            @if(App::getLocale() == 'en') {{ $item['label_en'] }}
                            @elseif(App::getLocale() == 'pt') {{ $item['label_pt'] }}
                            @else {{ $item['label_fr'] }}
                            @endif
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════ ABOUT ═══════ --}}
    <section class="py-5" style="padding-top: 6rem !important; padding-bottom: 6rem !important;">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 reveal-left">
                    <div style="border-radius: var(--radius-2xl); overflow: hidden; box-shadow: var(--shadow-2xl); position: relative;">
                        <img src="{{ asset('images/riviere-noire.jpeg') }}" alt="La Rivière Noire d'Adjarra" class="img-fluid" style="width:100%; display:block;">
                        <div style="position:absolute; bottom:1.5rem; left:1.5rem; background:rgba(255,255,255,0.95); backdrop-filter:blur(10px); padding:0.8rem 1.2rem; border-radius:var(--radius-md); box-shadow:var(--shadow-lg);">
                            <div style="font-family:var(--font-heading); font-weight:700; font-size:1.4rem; color:var(--c-primary);">10+</div>
                            <div style="font-size:0.75rem; color:var(--c-text-light); font-weight:500;">@if(App::getLocale() == 'en') Years @elseif(App::getLocale() == 'pt') Anos @else Ans @endif</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 reveal-right">
                    <span class="section-badge section-badge-green mb-3">
                        <i class="bi bi-leaf"></i>
                        @if(App::getLocale() == 'en') About Us
                        @elseif(App::getLocale() == 'pt') Sobre Nós
                        @else À propos
                        @endif
                    </span>
                    <h2 class="section-title mt-3 mb-4">
                        @if(App::getLocale() == 'en') The Rivière Noire, a Natural Treasure
                        @elseif(App::getLocale() == 'pt') A Rivière Noire, um Tesouro Natural
                        @else La Rivière Noire, un trésor naturel
                        @endif
                    </h2>
                    <div class="section-divider"></div>
                    <p class="mt-4 mb-4" style="line-height:1.9; color:var(--c-text-light); font-size:1.05rem;">
                        @if(App::getLocale() == 'en')
                            The Black River of Adjarra is one of Benin's best-kept natural secrets. Flowing through lush vegetation, it offers breathtaking landscapes, unique biodiversity and cultural experiences rooted in local traditions.
                        @elseif(App::getLocale() == 'pt')
                            O Rio Negro de Adjarra é um dos segredos naturais mais bem guardados do Benin. Flui por uma vegetação exuberante, oferecendo paisagens deslumbrantes, biodiversidade única e experiências culturais enraizadas nas tradições locais.
                        @else
                            La Rivière Noire d'Adjarra est l'un des secrets naturels les mieux gardés du Bénin. Se frayant un chemin à travers une végétation luxuriante, elle offre des paysages à couper le souffle, une biodiversité unique et des expériences culturelles ancrées dans les traditions locales.
                        @endif
                    </p>
                    <a href="{{ route('about') }}" class="btn btn-ghost px-4 py-2">
                        @if(App::getLocale() == 'en') Discover our story
                        @elseif(App::getLocale() == 'pt') Descubra nossa história
                        @else Découvrir notre histoire
                        @endif <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════ DESTINATIONS ═══════ --}}
    <section class="py-5" style="background: var(--c-bg-alt); padding-top: 6rem !important; padding-bottom: 6rem !important;">
        <div class="container">
            <div class="text-center mb-5 reveal">
                <span class="section-badge section-badge-blue mb-3"><i class="bi bi-geo-alt"></i> @if(App::getLocale() == 'en') Destinations @elseif(App::getLocale() == 'pt') Destinos @else Destinations @endif</span>
                <h2 class="section-title mt-3">
                    @if(App::getLocale() == 'en') Our Destinations
                    @elseif(App::getLocale() == 'pt') Nossos Destinos
                    @else Nos Destinations
                    @endif
                </h2>
                <div class="section-divider mx-auto"></div>
                <p class="section-subtitle mx-auto mt-3">
                    @if(App::getLocale() == 'en') Discover the must-see tourist sites of Benin, from the shores of the Black River to the historical landmarks of the region.
                    @elseif(App::getLocale() == 'pt') Descubra os pontos turísticos imperdíveis do Benin, desde as margens do Rio Negro até os marcos históricos da região.
                    @else Découvrez les sites touristiques incontournables du Bénin, des rives de la Rivière Noire aux lieux emblématiques de la région.
                    @endif
                </p>
            </div>

            @php
                $placeImages = [
                    'riviere-noire-adjarra' => 'riviere3.jpeg',
                    'ouidah' => 'porte-du-non-retour.png',
                    'porto-novo' => 'place-bayol.png',
                    'abomey' => 'palais-roi-glele.png',
                    'ganvie' => 'ganvie.jpeg',
                ];
            @endphp
            <div class="row g-4">
                @forelse($places as $place)
                    @php
                        $slug = $place->slug ?? '';
                        $locations = [
                            'riviere-noire-adjarra' => 'Adjarra, Bénin',
                            'ouidah' => 'Ouidah, Bénin',
                            'porto-novo' => 'Porto-Novo, Bénin',
                            'abomey' => 'Abomey, Bénin',
                            'ganvie' => 'Ganvié, Bénin',
                        ];
                    @endphp
                    <div class="col-lg-3 col-md-6 reveal stagger-{{ $loop->iteration }}">
                        <a href="{{ route('places.show', $place->slug ?? $place->id) }}" class="text-decoration-none">
                            <div class="card-premium h-100">
                                <div class="card-img-wrap" style="aspect-ratio:4/3;">
                                    @if(isset($placeImages[$slug]))
                                        <img src="{{ asset('images/' . $placeImages[$slug]) }}" alt="{{ $place->name }}" style="width:100%; height:100%; object-fit:cover; display:block;">
                                    @else
                                        <div class="gradient-placeholder" style="height:100%;"><i class="bi bi-geo-alt" style="font-size:3rem;"></i></div>
                                    @endif
                                    <span class="position-absolute top-0 end-0 m-3 badge" style="background: var(--c-accent); color: var(--c-dark); font-weight:700; border-radius: var(--radius-full); padding:0.45rem 0.9rem;">
                                        {{ number_format($place->price ?? 0, 0, ',', '.') }} FCFA
                                    </span>
                                </div>
                                <div class="p-4">
                                    <h4 style="font-family:var(--font-heading); font-weight:700; font-size:1.2rem; color:var(--c-text); margin-bottom:0.5rem;">{{ $place->name }}</h4>
                                    <p style="color:var(--c-text-light); font-size:0.9rem; line-height:1.6; margin-bottom:0.75rem;">{{ Str::limit($place->short_description ?? $place->description ?? '', 80) }}</p>
                                    @if(isset($locations[$slug]))
                                        <span style="color:var(--c-primary); font-size:0.82rem; display:inline-flex; align-items:center; gap:0.35rem; margin-bottom:0.75rem;">
                                            <i class="bi bi-geo-alt-fill"></i> {{ $locations[$slug] }}
                                        </span>
                                    @endif
                                    <div>
                                        <span style="color:var(--c-primary); font-weight:600; font-size:0.9rem; display:inline-flex; align-items:center; gap:0.4rem;">
                                            @if(App::getLocale() == 'en') Discover @elseif(App::getLocale() == 'pt') Descobrir @else Découvrir @endif
                                            <i class="bi bi-arrow-right"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    @foreach([1, 2, 3, 4] as $i)
                        <div class="col-lg-3 col-md-6 reveal stagger-{{ $i }}">
                            <div class="card-premium h-100">
                                <div class="card-img-wrap" style="aspect-ratio:4/3;">
                                    <div class="gradient-placeholder" style="height:100%;"><i class="bi bi-geo-alt" style="font-size:3rem;"></i></div>
                                </div>
                                <div class="p-4">
                                    <h4 style="font-family:var(--font-heading); font-weight:700; font-size:1.2rem;">Destination {{ $i }}</h4>
                                    <p style="color:var(--c-text-light); font-size:0.9rem;">@if(App::getLocale() == 'en') A wonderful place to discover @elseif(App::getLocale() == 'pt') Um lugar maravilhoso @else Un lieu merveilleux @endif</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>

            <div class="text-center mt-5 reveal">
                <a href="{{ route('places.index') }}" class="btn btn-primary-custom px-5 py-3">
                    @if(App::getLocale() == 'en') View All Destinations
                    @elseif(App::getLocale() == 'pt') Ver Todos os Destinos
                    @else Voir toutes les destinations
                    @endif <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- ═══════ EXCURSIONS ═══════ --}}
    <section class="py-5" style="padding-top: 6rem !important; padding-bottom: 6rem !important;">
        <div class="container">
            <div class="text-center mb-5 reveal">
                <span class="section-badge section-badge-gold mb-3"><i class="bi bi-compass"></i> @if(App::getLocale() == 'en') Excursions @elseif(App::getLocale() == 'pt') Excursões @else Excursions @endif</span>
                <h2 class="section-title mt-3">
                    @if(App::getLocale() == 'en') Our Excursions
                    @elseif(App::getLocale() == 'pt') Nossas Excursões
                    @else Nos Excursions
                    @endif
                </h2>
                <div class="section-divider mx-auto"></div>
                <p class="section-subtitle mx-auto mt-3">
                    @if(App::getLocale() == 'en') Explore unique experiences designed for every type of traveler.
                    @elseif(App::getLocale() == 'pt') Explore experiências únicas projetadas para cada tipo de viajante.
                    @else Des expériences uniques conçues pour chaque type de voyageur.
                    @endif
                </p>
            </div>

            <div class="row g-4">
                @forelse($excursions->filter(fn($e) => ($e->place->slug ?? '') === 'riviere-noire-adjarra') as $excursion)
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
                    <div class="col-lg-4 col-md-6 reveal stagger-{{ $loop->iteration }}">
                        <div class="card-premium h-100">
                            <div class="card-img-wrap" style="aspect-ratio:16/10;">
                                @if(isset($excImages[$excSlug]))
                                    <img src="{{ asset('images/' . $excImages[$excSlug]) }}" alt="{{ $excursion->name }}" style="width:100%; height:100%; object-fit:cover; display:block;">
                                @else
                                    <div class="gradient-placeholder" style="height:100%;"><i class="bi bi-compass" style="font-size:3rem;"></i></div>
                                @endif
                            </div>
                            <div class="p-4">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <span class="section-badge section-badge-green" style="font-size:0.72rem; padding:0.3rem 0.7rem;"><i class="bi bi-geo-alt"></i> {{ $excursion->place->name ?? 'Adjarra' }}</span>
                                    <span class="section-badge section-badge-blue" style="font-size:0.72rem; padding:0.3rem 0.7rem;"><i class="bi bi-clock"></i> {{ $excursion->duration_formatted ?? $excursion->duration }}</span>
                                </div>
                                <h4 style="font-family:var(--font-heading); font-weight:700; font-size:1.2rem; margin-bottom:1rem;">{{ $excursion->name }}</h4>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge px-3 py-2" style="background-color:var(--c-secondary); color:#fff; font-size:0.75rem; border-radius:var(--radius-full);">
                                        @if(App::getLocale() == 'en') Included @elseif(App::getLocale() == 'pt') Incluído @else Inclus @endif
                                    </span>
                                    <a href="{{ route('excursions.show', $excursion->slug ?? $excursion->id) }}" class="btn btn-sm btn-ghost" style="font-size:0.85rem; padding:0.4rem 1rem;">
                                        @if(App::getLocale() == 'en') Discover @elseif(App::getLocale() == 'pt') Descobrir @else Découvrir @endif <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    @foreach([1, 2, 3] as $i)
                        <div class="col-lg-4 col-md-6 reveal stagger-{{ $i }}">
                            <div class="card-premium h-100">
                                <div class="card-img-wrap" style="aspect-ratio:16/10;">
                                    <div class="gradient-placeholder" style="height:100%;"><i class="bi bi-compass" style="font-size:3rem;"></i></div>
                                </div>
                                <div class="p-4">
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <span class="section-badge section-badge-green" style="font-size:0.72rem; padding:0.3rem 0.7rem;"><i class="bi bi-geo-alt"></i> Adjarra</span>
                                        <span class="section-badge section-badge-blue" style="font-size:0.72rem; padding:0.3rem 0.7rem;"><i class="bi bi-clock"></i> 3h 00min</span>
                                    </div>
                                    <h4 style="font-family:var(--font-heading); font-weight:700; font-size:1.2rem;">Excursion {{ $i }}</h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>

            <div class="text-center mt-5 reveal">
                <a href="{{ route('excursions.index') }}" class="btn btn-primary-custom px-5 py-3">
                    @if(App::getLocale() == 'en') View All Excursions
                    @elseif(App::getLocale() == 'pt') Ver Todas as Excursões
                    @else Voir toutes les excursions
                    @endif <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- ═══════ RESTAURANT ═══════ --}}
    <section class="py-5" style="background: var(--c-dark); color: #fff; padding-top: 6rem !important; padding-bottom: 6rem !important; position: relative; overflow: hidden;">
        <div style="position:absolute; top:-100px; right:-100px; width:400px; height:400px; border-radius:50%; background:rgba(249,168,37,0.05);"></div>
        <div style="position:absolute; bottom:-150px; left:-100px; width:350px; height:350px; border-radius:50%; background:rgba(46,125,50,0.05);"></div>

        <div class="container position-relative">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 reveal-left">
                    <span class="section-badge section-badge-gold mb-3"><i class="bi bi-cup-hot"></i> Restaurant</span>
                    <h2 class="section-title mt-3 mb-4" style="color:#fff;">
                        @if(App::getLocale() == 'en') The Riverside Restaurant
                        @elseif(App::getLocale() == 'pt') O Restaurante à Beira-Rio
                        @else Le Restaurant au bord de la Rivière
                        @endif
                    </h2>
                    <div class="section-divider" style="background:linear-gradient(90deg, var(--c-accent), var(--c-accent-light));"></div>
                    <p class="mt-4 mb-4" style="line-height:1.9; color:rgba(255,255,255,0.7); font-size:1.05rem;">
                        @if(App::getLocale() == 'en')
                            Enjoy an exceptional culinary experience with fresh local dishes served with a stunning view of the Black River. Our restaurant offers a unique fusion of traditional Beninese cuisine and modern flavors.
                        @elseif(App::getLocale() == 'pt')
                            Aproveite uma experiência culinária excepcional com pratos frescos locais servidos com uma vista impressionante do Rio Negro.
                        @else
                            Savourez une expérience culinaire exceptionnelle avec des plats locaux frais servis avec une vue imprenable sur la Rivière Noire.
                        @endif
                    </p>

                    <div style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08); border-radius:var(--radius-lg); padding:1.5rem; margin-bottom:2rem;">
                        <h5 style="color:#fff; font-family:var(--font-heading); font-weight:600; margin-bottom:1rem;">
                            <i class="bi bi-clock me-2" style="color:var(--c-accent);"></i>
                            @if(App::getLocale() == 'en') Opening Hours
                            @elseif(App::getLocale() == 'pt') Horário de Funcionamento
                            @else Horaires d'ouverture
                            @endif
                        </h5>
                        <div class="row">
                            <div class="col-6">
                                <p class="mb-1 fw-semibold" style="color:rgba(255,255,255,0.9);">Lundi - Vendredi</p>
                                <p style="color:rgba(255,255,255,0.5);">11h00 - 22h00</p>
                            </div>
                            <div class="col-6">
                                <p class="mb-1 fw-semibold" style="color:rgba(255,255,255,0.9);">Samedi - Dimanche</p>
                                <p style="color:rgba(255,255,255,0.5);">10h00 - 23h00</p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('contact') }}" class="btn btn-accent px-4 py-2">
                        <i class="bi bi-calendar-check me-2"></i>
                        @if(App::getLocale() == 'en') Make a Reservation
                        @elseif(App::getLocale() == 'pt') Fazer uma Reserva
                        @else Réserver une table
                        @endif
                    </a>
                </div>
                <div class="col-lg-6 reveal-right">
                    <div style="border-radius:var(--radius-2xl); overflow:hidden; box-shadow:var(--shadow-2xl); aspect-ratio:4/3; background:linear-gradient(135deg, var(--c-accent-dark), var(--c-primary)); display:flex; align-items:center; justify-content:center;">
                        <i class="bi bi-cup-hot" style="font-size:5rem; color:rgba(255,255,255,0.3);"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════ TESTIMONIALS ═══════ --}}
    <section class="py-5" style="padding-top: 6rem !important; padding-bottom: 6rem !important; overflow:hidden;">
        <div class="container mb-5 reveal">
            <div class="text-center">
                <span class="section-badge section-badge-green mb-3"><i class="bi bi-chat-quote"></i> @if(App::getLocale() == 'en') Testimonials @elseif(App::getLocale() == 'pt') Depoimentos @else Témoignages @endif</span>
                <h2 class="section-title mt-3">
                    @if(App::getLocale() == 'en') What Our Visitors Say
                    @elseif(App::getLocale() == 'pt') O que nossos visitantes dizem
                    @else Ce que disent nos visiteurs
                    @endif
                </h2>
                <div class="section-divider mx-auto"></div>
            </div>
        </div>

        @if($testimonials->isEmpty())
            @php
            $testimonials = collect([
                (object)['name' => 'Marie Dupont', 'message' => 'Une expérience magique ! La beauté de la Rivière Noire est à couper le souffle. Je recommande vivement !', 'country' => 'France', 'rating' => 5],
                (object)['name' => 'John Smith', 'message' => 'Une aventure incroyable ! Les guides sont passionnés et compétents. Inoubliable.', 'country' => 'Royaume-Uni', 'rating' => 5],
                (object)['name' => 'Ana Oliveira', 'message' => 'Une expérience merveilleuse ! Le Rio Negro est éblouissant et l\'hospitalité béninoise est incomparable.', 'country' => 'Brésil', 'rating' => 5],
            ]);
            @endphp
        @endif

        <div class="testimonial-marquee-track">
            <div class="testimonial-marquee-content">
                @foreach($testimonials as $t)
                    <div class="testimonial-card">
                        <div style="display:flex; align-items:center; gap:0.8rem; margin-bottom:1rem;">
                            <div style="width:44px; height:44px; border-radius:50%; background:linear-gradient(135deg, var(--c-primary), var(--c-secondary)); color:#fff; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:0.85rem; flex-shrink:0;">
                                {{ strtoupper(substr($t->name, 0, 2)) }}
                            </div>
                            <div>
                                <h6 style="font-family:var(--font-heading); font-weight:600; font-size:0.95rem; margin-bottom:0;">{{ $t->name }}</h6>
                                <small style="color:var(--c-text-muted); font-size:0.8rem;">{{ $t->country ?? '' }}</small>
                            </div>
                        </div>
                        <div class="d-flex gap-1 mb-3">
                            @for($s = 1; $s <= 5; $s++)
                                <i class="bi bi-star{{ $s <= ($t->rating ?? 5) ? '-fill' : '' }}" style="color:var(--c-accent); font-size:0.85rem;"></i>
                            @endfor
                        </div>
                        <p style="font-style:italic; line-height:1.7; font-size:0.92rem; color:var(--c-text-light); margin:0;">
                            "{{ $t->message }}"
                        </p>
                    </div>
                @endforeach
            </div>
            <div class="testimonial-marquee-content" aria-hidden="true">
                @foreach($testimonials as $t)
                    <div class="testimonial-card">
                        <div style="display:flex; align-items:center; gap:0.8rem; margin-bottom:1rem;">
                            <div style="width:44px; height:44px; border-radius:50%; background:linear-gradient(135deg, var(--c-primary), var(--c-secondary)); color:#fff; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:0.85rem; flex-shrink:0;">
                                {{ strtoupper(substr($t->name, 0, 2)) }}
                            </div>
                            <div>
                                <h6 style="font-family:var(--font-heading); font-weight:600; font-size:0.95rem; margin-bottom:0;">{{ $t->name }}</h6>
                                <small style="color:var(--c-text-muted); font-size:0.8rem;">{{ $t->country ?? '' }}</small>
                            </div>
                        </div>
                        <div class="d-flex gap-1 mb-3">
                            @for($s = 1; $s <= 5; $s++)
                                <i class="bi bi-star{{ $s <= ($t->rating ?? 5) ? '-fill' : '' }}" style="color:var(--c-accent); font-size:0.85rem;"></i>
                            @endfor
                        </div>
                        <p style="font-style:italic; line-height:1.7; font-size:0.92rem; color:var(--c-text-light); margin:0;">
                            "{{ $t->message }}"
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════ SHARE EXPERIENCE ═══════ --}}
    <section class="py-5" style="background: var(--c-bg-alt); padding-top: 6rem !important; padding-bottom: 6rem !important;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 reveal">
                    <div class="card-premium" style="border-radius:var(--radius-2xl); box-shadow:var(--shadow-xl);">
                        <div class="p-5">
                            <div class="text-center mb-4">
                                <div style="width:60px; height:60px; border-radius:50%; background:linear-gradient(135deg, var(--c-primary), var(--c-secondary)); display:inline-flex; align-items:center; justify-content:center; margin-bottom:1rem;">
                                    <i class="bi bi-chat-heart" style="font-size:1.5rem; color:#fff;"></i>
                                </div>
                                <h3 style="font-family:var(--font-heading); font-weight:700; color:var(--c-text);">
                                    @if(App::getLocale() == 'en') Share your experience
                                    @elseif(App::getLocale() == 'pt') Compartilhe sua experiência
                                    @else Partagez votre expérience
                                    @endif
                                </h3>
                                <p style="color:var(--c-text-light); font-size:0.95rem;">
                                    @if(App::getLocale() == 'en') Tell us about your adventure on the Black River.
                                    @elseif(App::getLocale() == 'pt') Conte-nos sobre sua aventura no Rio Negro.
                                    @else Parlez-nous de votre aventure sur la Rivière Noire.
                                    @endif
                                </p>
                            </div>

                            <form action="{{ route('testimonials.store') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold" style="font-size:0.85rem; color:var(--c-text-light);">
                                            @if(App::getLocale() == 'en') Full Name @elseif(App::getLocale() == 'pt') Nome completo @else Nom complet @endif
                                        </label>
                                        <input type="text" name="name" class="form-control" style="border-radius:var(--radius-md); padding:0.75rem 1rem; border:1.5px solid var(--c-border); font-size:0.95rem;" value="{{ old('name') }}" required>
                                        @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold" style="font-size:0.85rem; color:var(--c-text-light);">
                                            @if(App::getLocale() == 'en') Country @elseif(App::getLocale() == 'pt') País @else Pays @endif
                                        </label>
                                        <input type="text" name="country" class="form-control" style="border-radius:var(--radius-md); padding:0.75rem 1rem; border:1.5px solid var(--c-border); font-size:0.95rem;" value="{{ old('country') }}">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold" style="font-size:0.85rem; color:var(--c-text-light);">
                                            @if(App::getLocale() == 'en') Your experience @elseif(App::getLocale() == 'pt') Sua experiência @else Votre expérience @endif
                                        </label>
                                        <textarea name="message" rows="4" class="form-control" style="border-radius:var(--radius-md); padding:0.75rem 1rem; border:1.5px solid var(--c-border); resize:none; font-size:0.95rem;" required>{{ old('message') }}</textarea>
                                        @error('message')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold" style="font-size:0.85rem; color:var(--c-text-light);">
                                            @if(App::getLocale() == 'en') Rating @elseif(App::getLocale() == 'pt') Nota @else Note @endif
                                        </label>
                                        <div class="d-flex gap-1" id="ratingStars">
                                            @for($s = 1; $s <= 5; $s++)
                                                <i class="bi bi-star" style="font-size:1.4rem; color:var(--c-accent); cursor:pointer; transition:transform 0.2s;" data-star="{{ $s }}"></i>
                                            @endfor
                                            <input type="hidden" name="rating" id="ratingInput" value="{{ old('rating', 5) }}">
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-3">
                                        <button type="submit" class="btn btn-accent px-5 py-3">
                                            <i class="bi bi-send me-2"></i>
                                            @if(App::getLocale() == 'en') Submit @elseif(App::getLocale() == 'pt') Enviar @else Envoyer @endif
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('styles')
    <style>
        .hero-bg-mobile { display: none; }
        @media (max-width: 767.98px) {
            .hero-bg-desktop { display: none; }
            .hero-bg-mobile { display: block; }
        }
        .testimonial-marquee-track {
            display: flex;
            width: max-content;
            animation: testimonial-scroll 35s linear infinite;
        }
        .testimonial-marquee-track:hover { animation-play-state: paused; }
        .testimonial-marquee-content {
            display: flex;
            gap: 1.5rem;
            padding: 0 0.75rem;
        }
        .testimonial-card {
            min-width: 300px;
            max-width: 360px;
            background: var(--c-bg-card);
            border: 1px solid var(--c-border);
            border-radius: var(--radius-xl);
            padding: 2rem;
            box-shadow: var(--shadow-sm);
            display: flex;
            flex-direction: column;
            transition: all 0.3s var(--ease);
        }
        .testimonial-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }
        @keyframes testimonial-scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        #ratingStars .bi-star-fill { color: var(--c-accent) !important; }
        #ratingStars .bi:hover { transform: scale(1.2); }
        @media (max-width: 575.98px) {
            .testimonial-card { min-width: 300px; max-width: 300px; padding: 1.5rem; }
        }
    </style>
    @endpush

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var stars = document.querySelectorAll('#ratingStars .bi');
        var input = document.getElementById('ratingInput');
        function paint(val) {
            stars.forEach(function (s) {
                var v = parseInt(s.getAttribute('data-star'));
                s.className = v <= val ? 'bi bi-star-fill' : 'bi bi-star';
            });
        }
        paint(parseInt(input.value));
        stars.forEach(function (s) {
            s.addEventListener('click', function () {
                var v = parseInt(this.getAttribute('data-star'));
                input.value = v;
                paint(v);
            });
            s.addEventListener('mouseenter', function () { paint(parseInt(this.getAttribute('data-star'))); });
            s.addEventListener('mouseleave', function () { paint(parseInt(input.value)); });
        });
    });
    </script>
    @endpush

    {{-- ═══════ CTA FINAL ═══════ --}}
    <section class="py-5" style="background: linear-gradient(135deg, var(--c-primary-dark), var(--c-primary), var(--c-secondary)); color: #fff; padding-top: 6rem !important; padding-bottom: 6rem !important; position: relative; overflow: hidden;">
        <div style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); width:600px; height:600px; border-radius:50%; background:rgba(249,168,37,0.06); pointer-events:none;"></div>
        <div class="container text-center position-relative reveal">
            <h2 style="font-family:var(--font-heading); font-size:clamp(2rem,4vw,3.2rem); font-weight:700; margin-bottom:1.5rem; color:var(--c-accent);">
                @if(App::getLocale() == 'en') Ready to Explore?
                @elseif(App::getLocale() == 'pt') Pronto para Explorar?
                @else Prêt à explorer ?
                @endif
            </h2>
            <p class="mb-5" style="opacity:0.85; font-size:1.1rem; max-width:600px; margin-left:auto; margin-right:auto; line-height:1.8;">
                @if(App::getLocale() == 'en') Book your unforgettable experience on the Black River now. Limited spots available for each excursion.
                @elseif(App::getLocale() == 'pt') Reserve agora sua experiência inesquecível no Rio Negro. Vagas limitadas para cada excursão.
                @else Réservez dès maintenant votre expérience inoubliable sur la Rivière Noire. Places limitées pour chaque excursion.
                @endif
            </p>
            <a href="{{ route('reservations.create') }}" class="btn btn-accent btn-lg px-5 py-3" style="font-size:1.05rem;">
                <i class="bi bi-calendar-check me-2"></i>
                @if(App::getLocale() == 'en') Book Now
                @elseif(App::getLocale() == 'pt') Reservar Agora
                @else Réserver maintenant
                @endif
            </a>
        </div>
    </section>

@endsection
