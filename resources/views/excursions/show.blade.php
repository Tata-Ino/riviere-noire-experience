@extends('layouts.app')

@section('title', ($excursion->name ?? 'Excursion') . ' - Rivière Noire Experience')
@section('navbar_class', 'force-scrolled')

@section('content')

    {{-- Breadcrumb --}}
    <section class="pt-5 pb-3" style="margin-top: 70px;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" style="color: var(--color-primary);">
                            @if(App::getLocale() == 'en') Home
                            @elseif(App::getLocale() == 'pt') Início
                            @else Accueil
                            @endif
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('excursions.index') }}" style="color: var(--color-primary);">
                            @if(App::getLocale() == 'en') Excursions
                            @elseif(App::getLocale() == 'pt') Excursões
                            @else Excursions
                            @endif
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $excursion->name ?? '' }}</li>
                </ol>
            </nav>
        </div>
    </section>

    {{-- Cover Image --}}
    <section class="pb-5">
        <div class="container">
            @if($excursion->cover_image)
                <img src="{{ Storage::url($excursion->cover_image) }}" alt="{{ $excursion->name }}" style="width:100%; max-height:400px; object-fit:cover; border-radius:20px; display:block;">
            @else
                <div class="gradient-placeholder" style="min-height: 400px; border-radius: 20px;">
                    <i class="bi bi-compass" style="font-size: 5rem;"></i>
                </div>
            @endif
        </div>
    </section>

    {{-- Excursion Details --}}
    <section class="pb-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center gap-3 mb-3 flex-wrap">
                        <h1 class="fw-bold mb-0" style="color: var(--color-primary); font-family: var(--font-heading);">{{ $excursion->name ?? '' }}</h1>
                        <span class="badge px-3 py-2 fs-6" style="background-color: var(--color-secondary); color: #fff;">
                            @if(App::getLocale() == 'en') Included
                            @elseif(App::getLocale() == 'pt') Incluído
                            @else Inclus @endif
                        </span>
                    </div>

                    <div class="d-flex flex-wrap gap-4 mb-4">
                        <span class="d-flex align-items-center" style="color: var(--color-secondary);">
                            <i class="bi bi-clock me-2 fs-5"></i>
                            <span class="fw-semibold">{{ $excursion->duration_formatted ?? $excursion->duration }}</span>
                        </span>
                        @if($excursion->max_participants ?? false)
                            <span class="d-flex align-items-center text-muted">
                                <i class="bi bi-people me-2 fs-5"></i>
                                <span class="fw-semibold">
                                    @if(App::getLocale() == 'en') Max {{ $excursion->max_participants }} people
                                    @elseif(App::getLocale() == 'pt') Máx. {{ $excursion->max_participants }} pessoas
                                    @else Max {{ $excursion->max_participants }} personnes
                                    @endif
                                </span>
                            </span>
                        @endif
                    </div>

                    <div class="mb-5" style="line-height: 1.9;">
                        {!! $excursion->description ?? '' !!}
                    </div>

                    {{-- Parent Place --}}
                    @if(isset($excursion->place))
                        <div class="card border-0 shadow-sm p-4 mb-5" style="border-radius: 16px; border-left: 4px solid var(--color-secondary) !important;">
                            <div class="d-flex align-items-start gap-3">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-geo-alt-fill" style="font-size: 2rem; color: var(--color-secondary);"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-1">
                                        @if(App::getLocale() == 'en') Location
                                        @elseif(App::getLocale() == 'pt') Localização
                                        @else Lieu
                                        @endif
                                    </h5>
                                    <p class="mb-2">
                                        {{ $excursion->place->short_description ?? $excursion->place->name }}
                                    </p>
                                    <a href="{{ route('places.show', $excursion->place->slug ?? $excursion->place->id) }}" style="color: var(--color-secondary); font-weight: 600;">
                                        @if(App::getLocale() == 'en') View the place
                                        @elseif(App::getLocale() == 'pt') Ver o local
                                        @else Voir le lieu
                                        @endif <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Gallery --}}
                    @if(isset($excursion->media) && $excursion->media->count())
                        <div class="mb-5">
                            <h3 class="fw-bold mb-4" style="color: var(--color-secondary);">
                                <i class="bi bi-images me-2"></i>
                                @if(App::getLocale() == 'en') Gallery
                                @elseif(App::getLocale() == 'pt') Galeria
                                @else Galerie
                                @endif
                            </h3>
                            <div class="row g-3">
                                @foreach($excursion->media as $media)
                                    <div class="col-md-4 col-6">
                                        <div class="card card-custom overflow-hidden" style="border-radius: 12px;">
                                            <div class="gradient-placeholder gradient-placeholder-sm" style="min-height: 160px; border-radius: 0;">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm p-4" style="border-radius: 16px; position: sticky; top: 100px;">
                        <h5 class="fw-bold mb-4" style="color: var(--color-primary);">
                            <i class="bi bi-calendar-check me-2"></i>
                            @if(App::getLocale() == 'en') Book this excursion
                            @elseif(App::getLocale() == 'pt') Reservar esta excursão
                            @else Réserver cette excursion
                            @endif
                        </h5>

                        <div class="mb-3 pb-3" style="border-bottom: 1px solid #eee;">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">
                                    @if(App::getLocale() == 'en') Price
                                    @elseif(App::getLocale() == 'pt') Preço
                                    @else Prix
                                    @endif
                                </span>
                                <span class="fw-bold fs-5" style="color: var(--color-secondary);">
                                    @if(App::getLocale() == 'en') Included
                                    @elseif(App::getLocale() == 'pt') Incluído
                                    @else Inclus
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="mb-3 pb-3" style="border-bottom: 1px solid #eee;">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">
                                    @if(App::getLocale() == 'en') Duration
                                    @elseif(App::getLocale() == 'pt') Duração
                                    @else Durée
                                    @endif
                                </span>
                                <span class="fw-semibold">{{ $excursion->duration_formatted ?? $excursion->duration }}</span>
                            </div>
                        </div>

                        @if(isset($excursion->place))
                            <div class="mb-4 pb-3" style="border-bottom: 1px solid #eee;">
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">
                                        @if(App::getLocale() == 'en') Location
                                        @elseif(App::getLocale() == 'pt') Local
                                        @else Lieu
                                        @endif
                                    </span>
                                    <span class="fw-semibold">{{ $excursion->place->name }}</span>
                                </div>
                            </div>
                        @endif

                        <a href="{{ route('reservations.create') }}" class="btn btn-accent btn-lg w-100 py-3">
                            <i class="bi bi-calendar-check me-2"></i>
                            @if(App::getLocale() == 'en') Book Now
                            @elseif(App::getLocale() == 'pt') Reservar Agora
                            @else Réserver
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
