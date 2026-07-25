@extends('admin.layout')

@section('title', 'Témoignages')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h4 class="mb-1 fw-bold" style="letter-spacing:-0.03em;"><i class="bi bi-chat-quote me-2" style="color:var(--dore);"></i>Témoignages</h4>
        <p class="text-muted mb-0" style="font-size:0.85rem;">Gérez les avis de vos visiteurs</p>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('admin.testimonials.index', ['filter' => 'all']) }}" class="btn btn-sm {{ $filter === 'all' ? 'btn-dark' : '' }} rounded-pill px-3" @if($filter !== 'all') style="background:rgba(0,0,0,0.05); color:var(--admin-text);" @endif>
            <i class="bi bi-grid me-1"></i> Tous <span class="badge bg-light text-dark ms-1" style="font-size:0.7rem;">{{ $stats['total'] }}</span>
        </a>
        <a href="{{ route('admin.testimonials.index', ['filter' => 'published']) }}" class="btn btn-sm {{ $filter === 'published' ? 'btn-success' : '' }} rounded-pill px-3" @if($filter !== 'published') style="background:rgba(46,125,50,0.08); color:var(--vert-foret);" @endif>
            <i class="bi bi-check-circle me-1"></i> Publiés <span class="badge bg-light text-success ms-1" style="font-size:0.7rem;">{{ $stats['published'] }}</span>
        </a>
        <a href="{{ route('admin.testimonials.index', ['filter' => 'pending']) }}" class="btn btn-sm {{ $filter === 'pending' ? 'btn-warning' : '' }} rounded-pill px-3" @if($filter !== 'pending') style="background:rgba(249,168,37,0.08); color:#B8860B;" @endif>
            <i class="bi bi-clock me-1"></i> En attente <span class="badge bg-light text-warning ms-1" style="font-size:0.7rem;">{{ $stats['pending'] }}</span>
        </a>
    </div>
</div>

@if($testimonials->isEmpty())
    <div class="text-center py-5">
        <div style="width:80px; height:80px; border-radius:20px; background:rgba(0,0,0,0.04); display:inline-flex; align-items:center; justify-content:center; margin-bottom:1rem;">
            <i class="bi bi-chat-quote" style="font-size:2rem; color:#ccc;"></i>
        </div>
        <h5 class="mt-2 fw-bold" style="color:var(--admin-text);">Aucun témoignage</h5>
        <p class="text-muted" style="font-size:0.9rem;">Les témoignages apparaîtront ici une fois soumis.</p>
    </div>
@else
    {{-- Desktop table --}}
    <div class="card d-none d-md-block">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead>
                    <tr>
                        <th>Auteur</th>
                        <th>Pays</th>
                        <th>Note</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testimonials as $t)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:38px;height:38px;background:linear-gradient(135deg,var(--vert-foret),var(--bleu-profond));color:#fff;font-weight:700;font-size:0.85rem; flex-shrink:0;">
                                        {{ strtoupper(substr($t->name,0,1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-semibold" style="font-size:0.88rem;">{{ $t->name }}</div>
                                        @if($t->email)<div style="color:var(--admin-muted); font-size:0.78rem;">{{ $t->email }}</div>@endif
                                    </div>
                                </div>
                            </td>
                            <td><span style="font-size:0.88rem;">{{ $t->country ?? '—' }}</span></td>
                            <td>
                                @for($i=1; $i<=5; $i++)
                                    <i class="bi bi-star{{ $i <= $t->rating ? '-fill' : '' }}" style="color:var(--dore);font-size:0.85rem;"></i>
                                @endfor
                            </td>
                            <td><span style="font-size:0.85rem; max-width:250px; display:inline-block; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; color:var(--admin-text);">{{ $t->message }}</span></td>
                            <td><span style="color:var(--admin-muted); font-size:0.82rem;">{{ $t->created_at->format('d/m/Y') }}</span></td>
                            <td>
                                @if($t->is_published)
                                    <span class="badge" style="background:rgba(46,125,50,0.1); color:var(--vert-foret); border-radius:8px;">Publié</span>
                                @else
                                    <span class="badge" style="background:rgba(249,168,37,0.1); color:#B8860B; border-radius:8px;">En attente</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex gap-1 justify-content-end">
                                    <a href="{{ route('admin.testimonials.show', $t) }}" class="btn btn-sm" style="background:rgba(21,101,192,0.08); color:var(--bleu-profond); border-radius:8px;" title="Voir">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.testimonials.toggle', $t) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm {{ $t->is_published ? '' : '' }}" style="background:{{ $t->is_published ? 'rgba(249,168,37,0.1)' : 'rgba(46,125,50,0.1)' }}; color:{{ $t->is_published ? '#B8860B' : 'var(--vert-foret)' }}; border-radius:8px;" title="{{ $t->is_published ? 'Dépublier' : 'Publier' }}">
                                            <i class="bi bi-{{ $t->is_published ? 'pause-circle' : 'check-circle' }}"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.testimonials.destroy', $t) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce témoignage ?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm" style="background:rgba(239,68,68,0.08); color:#dc2626; border-radius:8px;" title="Supprimer">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Mobile cards --}}
    <div class="d-md-none">
        @foreach($testimonials as $t)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:42px;height:42px;background:linear-gradient(135deg,var(--vert-foret),var(--bleu-profond));color:#fff;font-weight:700; flex-shrink:0;">
                                {{ strtoupper(substr($t->name,0,1)) }}
                            </div>
                            <div>
                                <div class="fw-semibold" style="font-size:0.9rem;">{{ $t->name }}</div>
                                <div style="color:var(--admin-muted); font-size:0.78rem;">{{ $t->country ?? '' }} · {{ $t->created_at->format('d/m/Y') }}</div>
                            </div>
                        </div>
                        @if($t->is_published)
                            <span class="badge" style="background:rgba(46,125,50,0.1); color:var(--vert-foret); border-radius:8px; font-size:0.72rem;">Publié</span>
                        @else
                            <span class="badge" style="background:rgba(249,168,37,0.1); color:#B8860B; border-radius:8px; font-size:0.72rem;">En attente</span>
                        @endif
                    </div>
                    <div class="mb-2">
                        @for($i=1; $i<=5; $i++)
                            <i class="bi bi-star{{ $i <= $t->rating ? '-fill' : '' }}" style="color:var(--dore);font-size:0.85rem;"></i>
                        @endfor
                    </div>
                    <p style="font-size:0.88rem; color:var(--admin-text); line-height:1.6; margin-bottom:1rem;">{{ Str::limit($t->message, 150) }}</p>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.testimonials.show', $t) }}" class="btn btn-sm rounded-pill flex-fill" style="background:rgba(21,101,192,0.08); color:var(--bleu-profond);">
                            <i class="bi bi-eye me-1"></i> Voir
                        </a>
                        <form action="{{ route('admin.testimonials.toggle', $t) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm rounded-pill" style="background:{{ $t->is_published ? 'rgba(249,168,37,0.1)' : 'rgba(46,125,50,0.1)' }}; color:{{ $t->is_published ? '#B8860B' : 'var(--vert-foret)' }};">
                                <i class="bi bi-{{ $t->is_published ? 'pause-circle' : 'check-circle' }}"></i>
                            </button>
                        </form>
                        <form action="{{ route('admin.testimonials.destroy', $t) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm rounded-pill" style="background:rgba(239,68,68,0.08); color:#dc2626;">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $testimonials->links() }}
    </div>
@endif
@endsection
