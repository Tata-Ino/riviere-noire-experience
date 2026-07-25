@extends('admin.layout')

@section('title', 'Gestion des Excursions')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h4 class="mb-1 fw-bold" style="letter-spacing:-0.03em;"><i class="bi bi-compass me-2" style="color:var(--vert-foret);"></i>Gestion des Excursions</h4>
        <p class="text-muted mb-0" style="font-size:0.85rem;">{{ $excursions->total() ?? 0 }} excursion(s) au total</p>
    </div>
    <a href="{{ route('admin.excursions.create') }}" class="btn btn-primary px-4">
        <i class="bi bi-plus-circle me-1"></i> Ajouter une excursion
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Recherche</label>
                <div class="position-relative">
                    <input type="text" name="search" class="form-control" style="padding-left:2.5rem;" placeholder="Nom de l'excursion..." value="{{ request('search') }}">
                    <i class="bi bi-search" style="position:absolute; left:0.9rem; top:50%; transform:translateY(-50%); color:var(--admin-muted); font-size:0.85rem;"></i>
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">Lieu</label>
                <select name="place_id" class="form-select">
                    <option value="">Tous les lieux</option>
                    @foreach($places ?? [] as $placeOption)
                        <option value="{{ $placeOption->id }}" {{ request('place_id') == $placeOption->id ? 'selected' : '' }}>
                            {{ $placeOption->translations->where('locale','fr')->first()->name ?? $placeOption->slug }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
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
                        <th>Lieu</th>
                        <th>Prix</th>
                        <th>Durée</th>
                        <th>Statut</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($excursions as $excursion)
                        @php
                            $frTranslation = $excursion->translations->where('locale', 'fr')->first();
                        @endphp
                        <tr>
                            <td><code style="background:rgba(249,168,37,0.08); color:#B8860B; padding:3px 8px; border-radius:6px; font-size:0.78rem;">{{ $excursion->slug }}</code></td>
                            <td class="fw-bold">{{ $frTranslation->name ?? '-' }}</td>
                            <td>{{ $excursion->place->translations->where('locale','fr')->first()->name ?? $excursion->place->slug ?? '-' }}</td>
                            <td><span class="fw-semibold">{{ number_format($excursion->price ?? 0, 0, ',', ' ') }} F</span></td>
                            <td>{{ $excursion->duration ?? '-' }} min</td>
                            <td>
                                @if($excursion->status === 'active' || $excursion->is_active)
                                    <span class="badge" style="background:rgba(46,125,50,0.1); color:var(--vert-foret); border-radius:8px;">Actif</span>
                                @else
                                    <span class="badge" style="background:rgba(239,68,68,0.1); color:#dc2626; border-radius:8px;">Inactif</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex gap-1 justify-content-end">
                                    <a href="{{ route('admin.excursions.edit', $excursion) }}" class="btn btn-sm" style="background:rgba(21,101,192,0.08); color:var(--bleu-profond); border-radius:8px;" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.excursions.destroy', $excursion) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette excursion ?')">
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
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-compass" style="font-size:2.5rem; color:#ddd;"></i>
                                <div class="mt-2 text-muted">Aucune excursion trouvée</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if(method_exists($excursions, 'links'))
        <div class="card-footer" style="background:transparent; border-top:1px solid var(--admin-border);">
            {{ $excursions->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection
