@extends('admin.layout')

@section('title', 'Détail du témoignage')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.testimonials.index') }}" class="text-decoration-none" style="color:var(--admin-muted); font-weight:500; font-size:0.9rem;">
        <i class="bi bi-arrow-left me-1"></i> Retour aux témoignages
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-4 p-md-5">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:60px;height:60px;background:linear-gradient(135deg,var(--vert-foret),var(--bleu-profond));color:#fff;font-weight:700;font-size:1.4rem; flex-shrink:0; box-shadow:0 4px 16px rgba(46,125,50,0.25);">
                            {{ strtoupper(substr($testimonial->name,0,1)) }}
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0" style="letter-spacing:-0.02em;">{{ $testimonial->name }}</h5>
                            <div style="color:var(--admin-muted); font-size:0.85rem;">
                                {{ $testimonial->email ?? '' }} {{ $testimonial->email && $testimonial->country ? '·' : '' }} {{ $testimonial->country ?? '' }}
                            </div>
                        </div>
                    </div>
                    @if($testimonial->is_published)
                        <span class="badge rounded-pill px-3 py-2" style="background:rgba(46,125,50,0.1); color:var(--vert-foret); font-size:0.82rem;">
                            <i class="bi bi-check-circle me-1"></i> Publié
                        </span>
                    @else
                        <span class="badge rounded-pill px-3 py-2" style="background:rgba(249,168,37,0.1); color:#B8860B; font-size:0.82rem;">
                            <i class="bi bi-clock me-1"></i> En attente
                        </span>
                    @endif
                </div>

                <div class="mb-4">
                    @for($i=1; $i<=5; $i++)
                        <i class="bi bi-star{{ $i <= $testimonial->rating ? '-fill' : '' }}" style="color:var(--dore);font-size:1.3rem;"></i>
                    @endfor
                    <span class="ms-2" style="color:var(--admin-muted); font-size:0.88rem;">{{ $testimonial->rating }}/5</span>
                </div>

                <div style="background:linear-gradient(135deg, rgba(249,168,37,0.04), rgba(253,216,53,0.02)); border:1px solid rgba(249,168,37,0.1); border-radius:16px; padding:1.5rem; line-height:1.9; font-size:1rem; color:var(--admin-text);">
                    <i class="bi bi-quote" style="font-size:1.8rem; color:var(--dore); opacity:0.4;"></i>
                    {{ $testimonial->message }}
                </div>

                <div class="mt-3" style="color:var(--admin-muted); font-size:0.82rem;">
                    <i class="bi bi-calendar me-1"></i> Soumis le {{ $testimonial->created_at->format('d/m/Y à H:i') }}
                    @if($testimonial->updated_at != $testimonial->created_at)
                        · Modifié le {{ $testimonial->updated_at->format('d/m/Y à H:i') }}
                    @endif
                </div>

                <hr class="my-4" style="border-color:var(--admin-border);">

                <div class="d-flex gap-2 flex-wrap">
                    <form action="{{ route('admin.testimonials.toggle', $testimonial) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn rounded-pill px-4 py-2" style="background:{{ $testimonial->is_published ? 'rgba(249,168,37,0.1)' : 'rgba(46,125,50,0.1)' }}; color:{{ $testimonial->is_published ? '#B8860B' : 'var(--vert-foret)' }};">
                            <i class="bi bi-{{ $testimonial->is_published ? 'pause-circle' : 'check-circle' }} me-1"></i>
                            {{ $testimonial->is_published ? 'Retirer de la publication' : 'Publier' }}
                        </button>
                    </form>
                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce témoignage définitivement ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn rounded-pill px-4 py-2" style="background:rgba(239,68,68,0.08); color:#dc2626;">
                            <i class="bi bi-trash me-1"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
