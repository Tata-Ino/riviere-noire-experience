@extends('admin.layout')

@section('title', 'Modifier un Lieu')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold" style="letter-spacing:-0.03em;"><i class="bi bi-geo-alt me-2" style="color:var(--bleu-profond);"></i>Modifier : {{ $place->translations->where('locale','fr')->first()->name ?? $place->slug }}</h4>
        <p class="text-muted mb-0" style="font-size:0.85rem;">Mettez à jour les informations de ce lieu</p>
    </div>
    <a href="{{ route('admin.places.index') }}" class="btn btn-outline-secondary">
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

<form action="{{ route('admin.places.update', $place) }}" method="POST" enctype="multipart/form-data">
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
                                $translation = $place->translations->where('locale', $locale)->first();
                            @endphp
                            <div class="tab-pane fade {{ $locale === 'fr' ? 'show active' : '' }}" id="tab-{{ $locale }}" role="tabpanel">
                                <div class="mb-3">
                                    <label class="form-label">Nom ({{ strtoupper($locale) }}) *</label>
                                    <input type="text" name="translations[{{ $locale }}][name]" class="form-control"
                                        value="{{ old("translations.{$locale}.name", $translation->name ?? '') }}"
                                        oninput="if('{{ $locale }}' === 'fr') generateSlug(this.value)">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description courte</label>
                                    <textarea name="translations[{{ $locale }}][short_description]" class="form-control" rows="2">{{ old("translations.{$locale}.short_description", $translation->short_description ?? '') }}</textarea>
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
                        <label class="form-label">Slug *</label>
                        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $place->slug) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prix (F CFA)</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price', $place->price) }}" min="0" step="100">
                    </div>
                    <div class="mb-3 form-check form-switch">
                        <input type="checkbox" name="is_featured" class="form-check-input" id="featured" {{ old('is_featured', $place->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="featured">À la une</label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Statut</label>
                        <select name="status" class="form-select">
                            <option value="active" {{ old('status', $place->status) === 'active' ? 'selected' : '' }}>Actif</option>
                            <option value="inactive" {{ old('status', $place->status) === 'inactive' ? 'selected' : '' }}>Inactif</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="fw-bold mb-0" style="font-size:0.9rem;"><i class="bi bi-image me-2" style="color:var(--bleu-profond);"></i>Image de couverture</h6>
                </div>
                <div class="card-body">
                    @if($place->cover_image)
                        <img src="{{ asset('storage/' . $place->cover_image) }}" class="mb-3" style="max-width:100%; border-radius:12px;" id="coverPreview">
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
                    <input type="url" name="video_url" class="form-control" value="{{ old('video_url', $place->video_url) }}" placeholder="URL YouTube ou Vimeo">
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
