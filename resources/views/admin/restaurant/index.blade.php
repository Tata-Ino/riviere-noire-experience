@extends('admin.layout')

@section('title', 'Gestion du Restaurant')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <h4 class="mb-1 fw-bold" style="letter-spacing:-0.03em;"><i class="bi bi-cup-hot me-2" style="color:var(--dore);"></i>Gestion du Restaurant</h4>
        <p class="text-muted mb-0" style="font-size:0.85rem;">{{ $restaurants->total() ?? 0 }} restaurant(s)</p>
    </div>
    <a href="{{ route('admin.restaurant.create') }}" class="btn btn-primary px-4">
        <i class="bi bi-plus-circle me-1"></i> Ajouter un restaurant
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Nom (FR)</th>
                        <th>Lieu</th>
                        <th>Horaires</th>
                        <th>Statut</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($restaurants as $restaurant)
                        @php
                            $frTranslation = $restaurant->translations->where('locale', 'fr')->first();
                        @endphp
                        <tr>
                            <td class="fw-bold">{{ $frTranslation->name ?? '-' }}</td>
                            <td>{{ $restaurant->place->translations->where('locale','fr')->first()->name ?? $restaurant->place->slug ?? '-' }}</td>
                            <td><span class="small" style="color:var(--admin-muted);">{{ $restaurant->opening_hours ?? '-' }}</span></td>
                            <td>
                                @if($restaurant->status === 'active' || $restaurant->is_active)
                                    <span class="badge" style="background:rgba(46,125,50,0.1); color:var(--vert-foret); border-radius:8px;">Actif</span>
                                @else
                                    <span class="badge" style="background:rgba(239,68,68,0.1); color:#dc2626; border-radius:8px;">Inactif</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex gap-1 justify-content-end">
                                    <a href="{{ route('admin.restaurant.edit', $restaurant) }}" class="btn btn-sm" style="background:rgba(21,101,192,0.08); color:var(--bleu-profond); border-radius:8px;" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.restaurant.destroy', $restaurant) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce restaurant ?')">
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
                            <td colspan="5" class="text-center py-5">
                                <i class="bi bi-cup-hot" style="font-size:2.5rem; color:#ddd;"></i>
                                <div class="mt-2 text-muted">Aucun restaurant trouvé</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if(method_exists($restaurants, 'links'))
        <div class="card-footer" style="background:transparent; border-top:1px solid var(--admin-border);">
            {{ $restaurants->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection
