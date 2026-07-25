@extends('layouts.app')

@section('title', 'Galerie - Rivière Noire Experience')
@section('navbar_class', 'force-scrolled')

@section('content')

    {{-- Hero Section --}}
    <section class="position-relative d-flex align-items-center" style="min-height: 45vh; background: linear-gradient(135deg, var(--c-dark) 0%, var(--c-primary-dark) 100%);">
        <div class="container text-white text-center py-5" style="padding-top: 8rem !important;">
            <div class="row justify-content-center">
                <div class="col-lg-8 reveal">
                    <span class="section-badge" style="background:rgba(249,168,37,0.15); color:var(--c-accent); border:1px solid rgba(249,168,37,0.25);"><i class="bi bi-images"></i> @if(App::getLocale() == 'en') Media @elseif(App::getLocale() == 'pt') Mídia @else Galerie @endif</span>
                    <h1 class="section-title mt-3 mb-3" style="color:#fff; font-size:clamp(2rem,4vw,3.5rem);">
                        @if(App::getLocale() == 'en') Gallery
                        @elseif(App::getLocale() == 'pt') Galeria
                        @else Galerie
                        @endif
                    </h1>
                    <div class="section-divider mx-auto" style="background:linear-gradient(90deg, var(--c-accent), var(--c-accent-light));"></div>
                    <p class="mt-3" style="opacity:0.8; font-size:1.1rem;">
                        @if(App::getLocale() == 'en') Discover the beauty of the Black River through our photos and videos.
                        @elseif(App::getLocale() == 'pt') Descubra a beleza do Rio Negro através das nossas fotos e vídeos.
                        @else Découvrez la beauté de la Rivière Noire à travers nos photos et vidéos.
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="position-absolute bottom-0 start-0 w-100" style="height:80px; background:linear-gradient(to top, var(--c-bg), transparent);"></div>
    </section>

    {{-- Filter Buttons --}}
    <section class="py-5">
        <div class="container py-4">
            <div class="text-center mb-5">
                <div class="d-inline-flex gap-2 p-1 rounded-pill" style="background-color: #f0f0f0;">
                    <button class="btn rounded-pill px-4 py-2 filter-btn active" data-filter="all" style="background-color: var(--color-primary); color: #fff; font-weight: 500;">
                        @if(App::getLocale() == 'en') All
                        @elseif(App::getLocale() == 'pt') Todos
                        @else Toutes
                        @endif
                    </button>
                    <button class="btn rounded-pill px-4 py-2 filter-btn" data-filter="photo" style="color: var(--color-text); font-weight: 500;">
                        <i class="bi bi-camera me-1"></i>
                        @if(App::getLocale() == 'en') Photos
                        @elseif(App::getLocale() == 'pt') Fotos
                        @else Photos
                        @endif
                    </button>
                    <button class="btn rounded-pill px-4 py-2 filter-btn" data-filter="video" style="color: var(--color-text); font-weight: 500;">
                        <i class="bi bi-play-circle me-1"></i>
                        @if(App::getLocale() == 'en') Videos
                        @elseif(App::getLocale() == 'pt') Vídeos
                        @else Vidéos
                        @endif
                    </button>
                </div>
            </div>

            {{-- Gallery Grid (Masonry style) --}}
            <div class="row g-3" id="galleryGrid">
                @forelse($media as $item)
                    <div class="gallery-item col-lg-4 col-md-6 col-12" data-type="{{ $item->type ?? 'photo' }}">
                        <div class="card card-custom overflow-hidden h-100 position-relative" style="border-radius: 16px; cursor: pointer;">
                            <div class="gradient-placeholder" style="min-height: 250px; border-radius: 0; {{ $loop->iteration % 3 == 0 ? 'min-height: 320px;' : '' }}">
                                @if(($item->type ?? 'photo') == 'video')
                                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.3);">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; background: rgba(249, 168, 37, 0.9);">
                                            <i class="bi bi-play-fill fs-1 text-dark"></i>
                                        </div>
                                    </div>
                                @else
                                    <i class="bi bi-image" style="font-size: 3rem;"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Demo items when no media --}}
                    @foreach([1, 2, 3, 4, 5, 6] as $i)
                        <div class="gallery-item col-lg-4 col-md-6 col-12 {{ $i == 3 || $i == 5 ? 'd-none d-md-block d-lg-block' : '' }}" data-type="{{ $i == 4 ? 'video' : 'photo' }}">
                            <div class="card card-custom overflow-hidden h-100 position-relative" style="border-radius: 16px; cursor: pointer;">
                                <div class="gradient-placeholder" style="min-height: 250px; border-radius: 0; {{ $i == 3 || $i == 6 ? 'min-height: 320px;' : '' }}">
                                    @if($i == 4)
                                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.3);">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; background: rgba(249, 168, 37, 0.9);">
                                                <i class="bi bi-play-fill fs-1 text-dark"></i>
                                            </div>
                                        </div>
                                    @else
                                        <i class="bi bi-image" style="font-size: 3rem;"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

@endsection

@push('styles')
<style>
    .gallery-item {
        transition: all 0.4s ease;
    }
    .gallery-item.hidden {
        display: none !important;
    }
    .filter-btn {
        transition: all 0.3s ease;
    }
    .filter-btn:not(.active):hover {
        background-color: rgba(46, 125, 50, 0.1);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const galleryItems = document.querySelectorAll('.gallery-item');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Update active state
                filterBtns.forEach(b => {
                    b.classList.remove('active');
                    b.style.backgroundColor = 'transparent';
                    b.style.color = 'var(--color-text)';
                });
                this.classList.add('active');
                this.style.backgroundColor = 'var(--color-primary)';
                this.style.color = '#fff';

                const filter = this.dataset.filter;

                galleryItems.forEach(item => {
                    if (filter === 'all' || item.dataset.type === filter) {
                        item.classList.remove('hidden');
                    } else {
                        item.classList.add('hidden');
                    }
                });
            });
        });
    });
</script>
@endpush
