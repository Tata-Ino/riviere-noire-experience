@extends('layouts.app')

@section('title', 'Nos Destinations - Rivière Noire Experience')

@section('navbar_class', 'force-scrolled')

@section('content')

    {{-- Hero --}}
    <section class="position-relative d-flex align-items-center" style="min-height:45vh; background: linear-gradient(135deg, var(--c-dark) 0%, var(--c-primary-dark) 100%);">
        <div class="container text-white text-center py-5" style="padding-top: 8rem !important;">
            <div class="row justify-content-center">
                <div class="col-lg-8 reveal">
                    <span class="section-badge" style="background:rgba(249,168,37,0.15); color:var(--c-accent); border:1px solid rgba(249,168,37,0.25);"><i class="bi bi-geo-alt"></i> @if(App::getLocale() == 'en') Destinations @elseif(App::getLocale() == 'pt') Destinos @else Destinations @endif</span>
                    <h1 class="section-title mt-3 mb-3" style="color:#fff; font-size:clamp(2rem,4vw,3.5rem);">
                        @if(App::getLocale() == 'en') Our Destinations
                        @elseif(App::getLocale() == 'pt') Nossos Destinos
                        @else Nos Destinations
                        @endif
                    </h1>
                    <div class="section-divider mx-auto" style="background:linear-gradient(90deg, var(--c-accent), var(--c-accent-light));"></div>
                    <p class="mt-3" style="opacity:0.8; font-size:1.1rem;">
                        @if(App::getLocale() == 'en') Discover the most beautiful sites along the Black River.
                        @elseif(App::getLocale() == 'pt') Explore os mais belos locais ao longo do Rio Negro.
                        @else Explorez les plus beaux sites le long de la Rivière Noire.
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="position-absolute bottom-0 start-0 w-100" style="height:80px; background:linear-gradient(to top, var(--c-bg), transparent);"></div>
    </section>

    {{-- Places Grid --}}
    <section class="py-5" style="padding-top: 6rem !important; padding-bottom: 6rem !important;">
        <div class="container">
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
                    <div class="col-lg-3 col-md-6 reveal stagger-{{ min($loop->iteration, 4) }}">
                        <a href="{{ route('places.show', $place->slug ?? $place->id) }}" class="text-decoration-none">
                            <div class="card-premium h-100">
                                <div class="card-img-wrap" style="aspect-ratio:4/3;">
                                    @if(isset($placeImages[$slug]))
                                        <img src="{{ asset('images/' . $placeImages[$slug]) }}" alt="{{ $place->name }}" style="width:100%; height:100%; object-fit:cover; display:block;">
                                    @else
                                        <div class="gradient-placeholder" style="height:100%;"><i class="bi bi-geo-alt" style="font-size:3rem;"></i></div>
                                    @endif
                                    @if($place->price ?? false)
                                        <span class="position-absolute top-0 end-0 m-3 badge" style="background:var(--c-accent); color:var(--c-dark); font-weight:700; border-radius:var(--radius-full); padding:0.45rem 0.9rem;">
                                            {{ number_format($place->price, 0, ',', '.') }} FCFA
                                        </span>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h4 style="font-family:var(--font-heading); font-weight:700; font-size:1.2rem; color:var(--c-text); margin-bottom:0.5rem;">{{ $place->name }}</h4>
                                    <p style="color:var(--c-text-light); font-size:0.9rem; line-height:1.6; margin-bottom:0.75rem;">{{ Str::limit($place->short_description ?? $place->description ?? '', 100) }}</p>
                                    @if(isset($locations[$slug]))
                                        <span style="color:var(--c-primary); font-size:0.82rem; display:inline-flex; align-items:center; gap:0.35rem; margin-bottom:0.75rem;">
                                            <i class="bi bi-geo-alt-fill"></i> {{ $locations[$slug] }}
                                        </span>
                                    @endif
                                    <div>
                                        <span style="color:var(--c-primary); font-weight:600; font-size:0.9rem; display:inline-flex; align-items:center; gap:0.4rem; margin-top:0.5rem;">
                                            @if(App::getLocale() == 'en') Discover @elseif(App::getLocale() == 'pt') Descobrir @else Découvrir @endif
                                            <i class="bi bi-arrow-right"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-geo-alt" style="font-size:4rem; color:var(--c-text-muted); opacity:0.3;"></i>
                        <h3 class="mt-3" style="color:var(--c-text-muted);">
                            @if(App::getLocale() == 'en') No destinations available yet.
                            @elseif(App::getLocale() == 'pt') Nenhum destino disponível ainda.
                            @else Aucune destination disponible pour le moment.
                            @endif
                        </h3>
                    </div>
                @endforelse
            </div>

            @if(method_exists($places, 'links') && $places->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $places->links() }}
                </div>
            @endif
        </div>
    </section>

@endsection
