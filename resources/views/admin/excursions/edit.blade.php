@extends('admin.layout')

@section('title', 'Modifier une Excursion')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold" style="letter-spacing:-0.03em;"><i class="bi bi-compass me-2" style="color:var(--vert-foret);"></i>Modifier : {{ $excursion->translations->where('locale','fr')->first()->name ?? $excursion->slug }}</h4>
        <p class="text-muted mb-0" style="font-size:0.85rem;">Mettez à jour les informations de cette excursion</p>
    </div>
    <a href="{{ route('admin.excursions.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Retour
    </a>
</div>

@if($errors->any())
    <div class="alert alert-danger" style="border-radius:14px; border:none; background:rgba(239,68,68,0.08); color:#dc2626;">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.excursions.update', $excursion) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="fw-bold mb-0" style="font-size:0.9rem;"><i class="bi bi-translate me-2" style="color:var(--vert-foret);"></i>Traductions</h6>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="translationTabs" role="tablist">
                        @foreach(['fr', 'en', 'pt'] as $locale)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $locale === 'fr' ? 'active' : '' }}" data-bs-toggle="tab"
                                    data-bs-target="#tab-{{ $locale }}" type="button" role="tab">
                                    {{ strtoupper($locale) }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content pt-3" id="translationContent">
                        @foreach(['fr', 'en', 'pt'] as $locale)
                            @php
                                $translation = $excursion->translations->where('locale', $locale)->first();
                            @endphp
                            <div class="tab-pane fade {{ $locale === 'fr' ? 'show active' : '' }}" id="tab-{{ $locale }}" role="tabpanel">
                                <div class="mb-3">
                                    <label class="form-label">Nom ({{ strtoupper($locale) }}) *</label>
                                    <input type="text" name="translations[{{ $locale }}][name]" class="form-control"
                                        value="{{ old("translations.{$locale}.name", $translation->name ?? '') }}" required
                                        oninput="if('{{ $locale }}' === 'fr') generateSlug(this.value)">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="translations[{{ $locale }}][description]" class="form-control" rows="6">{{ old("translations.{$locale}.description", $translation->description ?? '') }}</textarea>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="fw-bold mb-0" style="font-size:0.9rem;"><i class="bi bi-info-circle me-2" style="color:var(--dore);"></i>Informations</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Lieu *</label>
                        <select name="place_id" class="form-select" required>
                            <option value="">-- Sélectionner un lieu --</option>
                            @foreach($places ?? [] as $placeOption)
                                <option value="{{ $placeOption->id }}" {{ old('place_id', $excursion->place_id) == $placeOption->id ? 'selected' : '' }}>
                                    {{ $placeOption->translations->where('locale','fr')->first()->name ?? $placeOption->slug }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug *</label>
                        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $excursion->slug) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prix (F CFA)</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price', $excursion->price) }}" min="0" step="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Durée (minutes)</label>
                        <input type="number" name="duration_minutes" class="form-control" value="{{ old('duration_minutes', $excursion->duration_minutes) }}" min="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Position (ordre)</label>
                        <input type="number" name="position" class="form-control" value="{{ old('position', $excursion->position ?? 0) }}" min="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Statut</label>
                        <select name="status" class="form-select">
                            <option value="active" {{ old('status', $excursion->status) === 'active' ? 'selected' : '' }}>Actif</option>
                            <option value="inactive" {{ old('status', $excursion->status) === 'inactive' ? 'selected' : '' }}>Inactif</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="fw-bold mb-0" style="font-size:0.9rem;"><i class="bi bi-image me-2" style="color:var(--bleu-profond);"></i>Image de couverture</h6>
                </div>
                <div class="card-body">
                    @if($excursion->cover_image)
                        <img src="{{ asset('storage/' . $excursion->cover_image) }}" class="mb-3" style="max-width:100%; border-radius:12px;" id="coverPreview">
                    @else
                        <img id="coverPreview" class="mb-3 d-none" style="max-width:100%; border-radius:12px;">
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(this, 'coverPreview')">
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="fw-bold mb-0" style="font-size:0.9rem;"><i class="bi bi-play-circle me-2" style="color:var(--vert-foret);"></i>Vidéo</h6>
                </div>
                <div class="card-body">
                    <input type="url" name="video_url" class="form-control" value="{{ old('video_url', $excursion->video_url) }}" placeholder="URL YouTube ou Vimeo">
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-3" style="font-size:0.95rem;">
                <i class="bi bi-check-circle me-1"></i> Enregistrer les modifications
            </button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    function generateSlug(text) {
        const slug = text.toLowerCase()
            .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/(^-|-$)/g, '');
        document.getElementById('slug').value = slug;
    }
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => { preview.src = e.target.result; preview.classList.remove('d-none'); };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
