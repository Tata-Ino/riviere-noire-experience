@extends('admin.layout')

@section('title', 'Paramètres du Site')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold" style="letter-spacing:-0.03em;"><i class="bi bi-gear me-2" style="color:var(--bleu-profond);"></i>Paramètres du Site</h4>
        <p class="text-muted mb-0" style="font-size:0.85rem;">Gérez les informations de contact et les réseaux sociaux</p>
    </div>
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

<form action="{{ route('admin.settings.contact.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header">
                    <h6 class="fw-bold mb-0" style="font-size:0.9rem;"><i class="bi bi-telephone me-2" style="color:var(--vert-foret);"></i>Contact</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Téléphone</label>
                        <input type="tel" name="phone" class="form-control" value="{{ old('phone', $settings->phone ?? '') }}" placeholder="+225 XX XX XX XX XX">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">WhatsApp</label>
                        <input type="tel" name="whatsapp" class="form-control" value="{{ old('whatsapp', $settings->whatsapp ?? '') }}" placeholder="+225 XX XX XX XX XX">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $settings->email ?? '') }}" placeholder="contact@rivierenoire.com">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header">
                    <h6 class="fw-bold mb-0" style="font-size:0.9rem;"><i class="bi bi-map me-2" style="color:var(--dore);"></i>Localisation</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">URL Google Maps (iframe embed)</label>
                        <textarea name="maps_link" class="form-control" rows="3" placeholder="Collez ici le code iframe Google Maps">{{ old('maps_link', $settings->maps_link ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header">
                    <h6 class="fw-bold mb-0" style="font-size:0.9rem;"><i class="bi bi-share me-2" style="color:var(--bleu-profond);"></i>Réseaux sociaux</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-facebook me-1" style="color:#1877F2;"></i> Facebook URL
                        </label>
                        <input type="url" name="facebook_url" class="form-control" value="{{ old('facebook_url', $settings->facebook_url ?? '') }}" placeholder="https://facebook.com/...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-instagram me-1" style="color:#E4405F;"></i> Instagram URL
                        </label>
                        <input type="url" name="instagram_url" class="form-control" value="{{ old('instagram_url', $settings->instagram_url ?? '') }}" placeholder="https://instagram.com/...">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary px-5 py-3" style="font-size:0.95rem;">
            <i class="bi bi-check-circle me-1"></i> Enregistrer les paramètres
        </button>
    </div>
</form>
@endsection
