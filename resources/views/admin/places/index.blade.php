@extends('admin.layout')

@section('title', 'Gestion des Lieux')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h4 class="mb-1 fw-bold" style="letter-spacing:-0.03em;"><i class="bi bi-geo-alt me-2" style="color:var(--bleu-profond);"></i>Gestion des Lieux</h4>
        <p class="text-muted mb-0" style="font-size:0.85rem;">{{ $places->total() ?? 0 }} lieu(x) au total</p>
    </div>
    <a href="{{ route('admin.places.create') }}" class="btn btn-primary px-4">
        <i class="bi bi-plus-circle me-1"></i> Ajouter un lieu
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-5">
                <label class="form-label">Recherche</label>
                <div class="position-relative">
                    <input type="text" name="search" class="form-control" style="padding-left:2.5rem;" placeholder="Nom du lieu..." value="{{ request('search') }}">
                    <i class="bi bi-search" style="position:absolute; left:0.9rem; top:50%; transform:translateY(-50%); color:var(--admin-muted); font-size:0.85rem;"></i>
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">Statut</label>
                <select name="status" class="form-select">
                    <option value="">Tous</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Actif</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactif</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-primary w-100">
                    <i class="bi bi-funnel me-1"></i> Filtrer
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Slug</th>
                        <th>Nom (FR)</th>
                        <th>Prix</th>
                        <th>À la une</th>
                        <th>Statut</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($places as $place)
                        @php
                            $frTranslation = $place->translations->where('locale', 'fr')->first();
                        @endphp
                        <tr>
                            <td><code style="background:rgba(46,125,50,0.06); color:var(--vert-foret); padding:3px 8px; border-radius:6px; font-size:0.78rem;">{{ $place->slug }}</code></td>
                            <td class="fw-bold">{{ $frTranslation->name ?? '-' }}</td>
                            <td><span class="fw-semibold">{{ number_format($place->price ?? 0, 0, ',', ' ') }} F</span></td>
                            <td>
                                @if($place->featured)
                                    <span class="badge" style="background:linear-gradient(135deg, rgba(249,168,37,0.15), rgba(253,216,53,0.1)); color:#B8860B; border-radius:8px;"><i class="bi bi-star-fill me-1"></i>Oui</span>
                                @else
                                    <span style="color:var(--admin-muted); font-size:0.82rem;">—</span>
                                @endif
                            </td>
                            <td>
                                @if($place->status === 'active' || $place->is_active)
                                    <span class="badge" style="background:rgba(46,125,50,0.1); color:var(--vert-foret); border-radius:8px;">Actif</span>
                                @else
                                    <span class="badge" style="background:rgba(239,68,68,0.1); color:#dc2626; border-radius:8px;">Inactif</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex gap-1 justify-content-end">
                                    <a href="{{ route('admin.places.edit', $place) }}" class="btn btn-sm" style="background:rgba(21,101,192,0.08); color:var(--bleu-profond); border-radius:8px;" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.places.destroy', $place) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce lieu ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm" style="background:rgba(239,68,68,0.08); color:#dc2626; border-radius:8px;" title="Supprimer">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-geo-alt" style="font-size:2.5rem; color:#ddd;"></i>
                                <div class="mt-2 text-muted">Aucun lieu trouvé</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if(method_exists($places, 'links'))
        <div class="card-footer" style="background:transparent; border-top:1px solid var(--admin-border);">
            {{ $places->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection
