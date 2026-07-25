@extends('layouts.app')

@section('title', 'Réservation - Rivière Noire Experience')
@section('navbar_class', 'force-scrolled')

@section('content')

    {{-- Hero Section --}}
    <section class="position-relative d-flex align-items-center" style="min-height: 35vh; background: linear-gradient(135deg, var(--c-dark) 0%, var(--c-primary-dark) 100%);">
        <div class="container text-white text-center py-5" style="padding-top: 8rem !important;">
            <div class="row justify-content-center">
                <div class="col-lg-8 reveal">
                    <span class="section-badge" style="background:rgba(249,168,37,0.15); color:var(--c-accent); border:1px solid rgba(249,168,37,0.25);"><i class="bi bi-calendar-check"></i> @if(App::getLocale() == 'en') Booking @elseif(App::getLocale() == 'pt') Reserva @else Réservation @endif</span>
                    <h1 class="section-title mt-3 mb-3" style="color:#fff; font-size:clamp(2rem,4vw,3.5rem);">
                        @if(App::getLocale() == 'en') Reservation
                        @elseif(App::getLocale() == 'pt') Reserva
                        @else Réservation
                        @endif
                    </h1>
                    <div class="section-divider mx-auto" style="background:linear-gradient(90deg, var(--c-accent), var(--c-accent-light));"></div>
                    <p class="mt-3" style="opacity:0.8; font-size:1.1rem;">
                        @if(App::getLocale() == 'en') Book your unforgettable experience on the Black River.
                        @elseif(App::getLocale() == 'pt') Reserve sua experiência inesquecível no Rio Negro.
                        @else Réservez votre expérience inoubliable sur la Rivière Noire.
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="position-absolute bottom-0 start-0 w-100" style="height:80px; background:linear-gradient(to top, var(--c-bg), transparent);"></div>
    </section>

    {{-- Reservation Form --}}
    <section class="py-5">
        <div class="container py-4">
            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 12px; background-color: #fff5f5; border-left: 4px solid #dc3545 !important;">
                    <div class="d-flex align-items-start gap-2">
                        <i class="bi bi-exclamation-triangle-fill text-danger mt-1"></i>
                        <div>
                            <strong class="text-danger">
                                @if(App::getLocale() == 'en') Please correct the following errors:
                                @elseif(App::getLocale() == 'pt') Por favor, corrija os seguintes erros:
                                @else Veuillez corriger les erreurs suivantes :
                                @endif
                            </strong>
                            <ul class="mb-0 mt-1">
                                @foreach($errors->all() as $error)
                                    <li class="text-danger small">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('reservations.store') }}" method="POST" id="reservationForm">
                @csrf
                <div class="row g-5">
                    {{-- Form --}}
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm p-4 p-md-5" style="border-radius: 16px;">
                            <h4 class="fw-bold mb-4" style="color: var(--color-primary);">
                                <i class="bi bi-person-lines-fill me-2"></i>
                                @if(App::getLocale() == 'en') Your Information
                                @elseif(App::getLocale() == 'pt') Suas Informações
                                @else Vos Informations
                                @endif
                            </h4>

                            {{-- Select Lieu --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold" for="place_id">
                                    @if(App::getLocale() == 'en') Destination *
                                    @elseif(App::getLocale() == 'pt') Destino *
                                    @else Lieu *
                                    @endif
                                </label>
                                <select name="place_id" id="place_id" class="form-select form-select-lg" style="border-radius: 10px; border-color: #ddd;" required>
                                    <option value="">
                                        -- @if(App::getLocale() == 'en') Select a destination
                                        @elseif(App::getLocale() == 'pt') Selecione um destino
                                        @else Sélectionnez un lieu
                                        @endif --
                                    </option>
                                    @foreach($places as $place)
                                        <option value="{{ $place->id }}" data-price="{{ $place->price ?? 0 }}" {{ old('place_id') == $place->id ? 'selected' : '' }}>
                                            {{ $place->name }}{{ ($place->price ?? 0) > 0 ? ' - ' . number_format($place->price ?? 0, 0, ',', '.') . ' FCFA' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('place_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- Select Excursion --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold" for="excursion_id">
                                    @if(App::getLocale() == 'en') Excursion (optional)
                                    @elseif(App::getLocale() == 'pt') Excursão (opcional)
                                    @else Excursion (optionnel)
                                    @endif
                                </label>
                                <select name="excursion_id" id="excursion_id" class="form-select form-select-lg" style="border-radius: 10px; border-color: #ddd;">
                                    <option value="">
                                        -- @if(App::getLocale() == 'en') No excursion
                                        @elseif(App::getLocale() == 'pt') Sem excursão
                                        @else Pas d'excursion
                                        @endif --
                                    </option>
                                    @foreach($excursions as $excursion)
                                        <option value="{{ $excursion->id }}" data-place="{{ $excursion->place_id }}" data-price="0" {{ old('excursion_id') == $excursion->id ? 'selected' : '' }}>
                                            {{ $excursion->name }} - {{ $excursion->duration_formatted ?? $excursion->duration }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('excursion_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <hr class="my-4">

                            {{-- Nom complet --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold" for="full_name">
                                    @if(App::getLocale() == 'en') Full Name *
                                    @elseif(App::getLocale() == 'pt') Nome Completo *
                                    @else Nom complet *
                                    @endif
                                </label>
                                <input type="text" name="full_name" id="full_name" class="form-control form-control-lg" style="border-radius: 10px; border-color: #ddd;" value="{{ old('full_name') }}" required placeholder="Jean Dupont">
                                @error('full_name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="row g-3">
                                {{-- Email --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" for="email">
                                            @if(App::getLocale() == 'en') Email *
                                            @elseif(App::getLocale() == 'pt') Email *
                                            @else Email *
                                            @endif
                                        </label>
                                        <input type="email" name="email" id="email" class="form-control form-control-lg" style="border-radius: 10px; border-color: #ddd;" value="{{ old('email') }}" required placeholder="jean@exemple.com">
                                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Téléphone --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" for="phone">
                                            @if(App::getLocale() == 'en') Phone *
                                            @elseif(App::getLocale() == 'pt') Telefone *
                                            @else Téléphone *
                                            @endif
                                        </label>
                                        <input type="tel" name="phone" id="phone" class="form-control form-control-lg" style="border-radius: 10px; border-color: #ddd;" value="{{ old('phone') }}" required placeholder="+229 97 00 00 00">
                                        @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3">
                                {{-- Pays --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" for="country">
                                            @if(App::getLocale() == 'en') Country *
                                            @elseif(App::getLocale() == 'pt') País *
                                            @else Pays *
                                            @endif
                                        </label>
                                        <select name="country" id="country" class="form-select form-select-lg" style="border-radius: 10px; border-color: #ddd;" required>
                                            <option value="">-- Sélectionnez --</option>
                                            <option value="BJ" {{ old('country') == 'BJ' ? 'selected' : '' }}>Bénin</option>
                                            <option value="TG" {{ old('country') == 'TG' ? 'selected' : '' }}>Togo</option>
                                            <option value="NG" {{ old('country') == 'NG' ? 'selected' : '' }}>Nigeria</option>
                                            <option value="BF" {{ old('country') == 'BF' ? 'selected' : '' }}>Burkina Faso</option>
                                            <option value="NE" {{ old('country') == 'NE' ? 'selected' : '' }}>Niger</option>
                                            <option value="ML" {{ old('country') == 'ML' ? 'selected' : '' }}>Mali</option>
                                            <option value="CI" {{ old('country') == 'CI' ? 'selected' : '' }}>Côte d'Ivoire</option>
                                            <option value="GH" {{ old('country') == 'GH' ? 'selected' : '' }}>Ghana</option>
                                            <option value="SN" {{ old('country') == 'SN' ? 'selected' : '' }}>Sénégal</option>
                                            <option value="CM" {{ old('country') == 'CM' ? 'selected' : '' }}>Cameroun</option>
                                            <option value="GA" {{ old('country') == 'GA' ? 'selected' : '' }}>Gabon</option>
                                            <option value="CD" {{ old('country') == 'CD' ? 'selected' : '' }}>Congo (RDC)</option>
                                            <option value="CG" {{ old('country') == 'CG' ? 'selected' : '' }}>Congo (Brazzaville)</option>
                                            <option value="CF" {{ old('country') == 'CF' ? 'selected' : '' }}>Centrafrique</option>
                                            <option value="TD" {{ old('country') == 'TD' ? 'selected' : '' }}>Tchad</option>
                                            <option value="GN" {{ old('country') == 'GN' ? 'selected' : '' }}>Guinée</option>
                                            <option value="FR" {{ old('country') == 'FR' ? 'selected' : '' }}>France</option>
                                            <option value="BE" {{ old('country') == 'BE' ? 'selected' : '' }}>Belgique</option>
                                            <option value="CH" {{ old('country') == 'CH' ? 'selected' : '' }}>Suisse</option>
                                            <option value="CA" {{ old('country') == 'CA' ? 'selected' : '' }}>Canada</option>
                                            <option value="US" {{ old('country') == 'US' ? 'selected' : '' }}>États-Unis</option>
                                            <option value="BR" {{ old('country') == 'BR' ? 'selected' : '' }}>Brésil</option>
                                            <option value="PT" {{ old('country') == 'PT' ? 'selected' : '' }}>Portugal</option>
                                            <option value="OTHER" {{ old('country') == 'OTHER' ? 'selected' : '' }}>Autre</option>
                                        </select>
                                        @error('country') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Langue --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" for="language">
                                            @if(App::getLocale() == 'en') Preferred Language *
                                            @elseif(App::getLocale() == 'pt') Idioma Preferido *
                                            @else Langue préférée *
                                            @endif
                                        </label>
                                        <select name="language_id" id="language_id" class="form-select form-select-lg" style="border-radius: 10px; border-color: #ddd;" required>
                                            <option value="">-- Sélectionnez --</option>
                                            @foreach($languages as $lang)
                                                <option value="{{ $lang->id }}" {{ old('language_id') == $lang->id ? 'selected' : '' }}>{{ $lang->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('language_id') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3">
                                {{-- Nombre de personnes --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" for="nb_persons">
                                            @if(App::getLocale() == 'en') Number of People *
                                            @elseif(App::getLocale() == 'pt') Número de Pessoas *
                                            @else Nombre de personnes *
                                            @endif
                                        </label>
                                        <input type="number" name="nb_persons" id="nb_persons" class="form-control form-control-lg" style="border-radius: 10px; border-color: #ddd;" value="{{ old('nb_persons', 1) }}" min="1" max="50" required>
                                        @error('nb_persons') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                {{-- Date de visite --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" for="visit_date">
                                            @if(App::getLocale() == 'en') Visit Date *
                                            @elseif(App::getLocale() == 'pt') Data da Visita *
                                            @else Date de visite *
                                            @endif
                                        </label>
                                        <input type="date" name="visit_date" id="visit_date" class="form-control form-control-lg" style="border-radius: 10px; border-color: #ddd;" value="{{ old('visit_date') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                                        @error('visit_date') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Notes --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold" for="notes">
                                    @if(App::getLocale() == 'en') Additional Notes
                                    @elseif(App::getLocale() == 'pt') Notas Adicionais
                                    @else Notes additionnelles
                                    @endif
                                </label>
                                <textarea name="notes" id="notes" class="form-control" style="border-radius: 10px; border-color: #ddd;" rows="4" placeholder="@if(App::getLocale() == 'en') Special requests, dietary restrictions, accessibility needs... @elseif(App::getLocale() == 'pt') Pedidos especiais, restrições alimentares... @else Demandes spéciales, restrictions alimentaires... @endif">{{ old('notes') }}</textarea>
                                @error('notes') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- Submit --}}
                            <button type="submit" class="btn btn-accent btn-lg w-100 py-3">
                                <i class="bi bi-credit-card me-2"></i>
                                @if(App::getLocale() == 'en') Proceed to Payment
                                @elseif(App::getLocale() == 'pt') Prosseguir para o Pagamento
                                @else Procéder au paiement
                                @endif
                            </button>
                        </div>
                    </div>

                    {{-- Sidebar Summary --}}
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm p-4" style="border-radius: 16px; position: sticky; top: 100px;">
                            <h5 class="fw-bold mb-4" style="color: var(--color-primary);">
                                <i class="bi bi-receipt me-2"></i>
                                @if(App::getLocale() == 'en') Reservation Summary
                                @elseif(App::getLocale() == 'pt') Resumo da Reserva
                                @else Résumé de la réservation
                                @endif
                            </h5>

                            <div class="mb-3 pb-3" style="border-bottom: 1px solid #eee;">
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted" id="summaryPlaceLabel">
                                        @if(App::getLocale() == 'en') Destination
                                        @elseif(App::getLocale() == 'pt') Destino
                                        @else Lieu
                                        @endif
                                    </span>
                                    <span class="fw-semibold" id="summaryPlaceName">--</span>
                                </div>
                                <div class="d-flex justify-content-between mt-1">
                                    <span class="text-muted small">
                                        @if(App::getLocale() == 'en') Entry fee
                                        @elseif(App::getLocale() == 'pt') Entrada
                                        @else Entrée
                                        @endif
                                    </span>
                                    <span id="summaryPlacePrice">0 FCFA</span>
                                </div>
                            </div>

                            <div class="mb-3 pb-3" style="border-bottom: 1px solid #eee;">
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted" id="summaryExcursionLabel">
                                        @if(App::getLocale() == 'en') Excursion
                                        @elseif(App::getLocale() == 'pt') Excursão
                                        @else Excursion
                                        @endif
                                    </span>
                                    <span class="fw-semibold" id="summaryExcursionName">--</span>
                                </div>
                                <div class="d-flex justify-content-between mt-1">
                                    <span class="text-muted small">
                                        @if(App::getLocale() == 'en') Included
                                        @elseif(App::getLocale() == 'pt') Incluído
                                        @else Inclus
                                        @endif
                                    </span>
                                    <span id="summaryExcursionPrice" style="color: var(--color-secondary); font-weight: 600;">
                                        @if(App::getLocale() == 'en') 0 FCFA
                                        @elseif(App::getLocale() == 'pt') 0 FCFA
                                        @else 0 FCFA
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <div class="mb-3 pb-3" style="border-bottom: 1px solid #eee;">
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">
                                        @if(App::getLocale() == 'en') Number of People
                                        @elseif(App::getLocale() == 'pt') Pessoas
                                        @else Personnes
                                        @endif
                                    </span>
                                    <span class="fw-semibold" id="summaryPersons">1</span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center pt-2">
                                <h5 class="fw-bold mb-0" style="color: var(--color-primary);">
                                    @if(App::getLocale() == 'en') Total
                                    @elseif(App::getLocale() == 'pt') Total
                                    @else Total
                                    @endif
                                </h5>
                                <h4 class="fw-bold mb-0" style="color: var(--color-accent);" id="summaryTotal">0 FCFA</h4>
                            </div>

                            <div class="mt-4 p-3" style="background-color: #f8f9fa; border-radius: 10px;">
                                <small class="text-muted d-flex align-items-start gap-2">
                                    <i class="bi bi-info-circle mt-1" style="color: var(--color-secondary);"></i>
                                    @if(App::getLocale() == 'en') Final price will be confirmed after validation.
                                    @elseif(App::getLocale() == 'pt') O preço final será confirmado após validação.
                                    @else Le prix final sera confirmé après validation.
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const placeSelect = document.getElementById('place_id');
        const excursionSelect = document.getElementById('excursion_id');
        const personsInput = document.getElementById('nb_persons');

        const summaryPlaceName = document.getElementById('summaryPlaceName');
        const summaryPlacePrice = document.getElementById('summaryPlacePrice');
        const summaryExcursionName = document.getElementById('summaryExcursionName');
        const summaryExcursionPrice = document.getElementById('summaryExcursionPrice');
        const summaryPersons = document.getElementById('summaryPersons');
        const summaryTotal = document.getElementById('summaryTotal');

        function formatPrice(price) {
            return parseInt(price).toLocaleString('fr-FR') + ' FCFA';
        }

        function filterExcursions() {
            const selectedPlaceId = placeSelect.value;
            const options = excursionSelect.options;

            excursionSelect.value = '';

            for (let i = 0; i < options.length; i++) {
                if (options[i].value === '') continue;
                const placeId = options[i].getAttribute('data-place');
                if (!selectedPlaceId || placeId == selectedPlaceId) {
                    options[i].style.display = '';
                } else {
                    options[i].style.display = 'none';
                }
            }

            updateSummary();
        }

        function updateSummary() {
            const selectedPlace = placeSelect.options[placeSelect.selectedIndex];
            const placePrice = parseInt(selectedPlace.getAttribute('data-price')) || 0;
            const placeName = placeSelect.value ? selectedPlace.text.split(' - ')[0] : '--';

            const selectedExcursion = excursionSelect.options[excursionSelect.selectedIndex];
            const excursionName = excursionSelect.value ? selectedExcursion.text.split(' - ')[0] : '--';

            const persons = parseInt(personsInput.value) || 1;

            summaryPlaceName.textContent = placeName;
            summaryPlacePrice.textContent = formatPrice(placePrice);
            summaryExcursionName.textContent = excursionName;
            summaryExcursionPrice.textContent = '0 FCFA';
            summaryPersons.textContent = persons;

            const total = placePrice * persons;
            summaryTotal.textContent = formatPrice(total);
        }

        placeSelect.addEventListener('change', filterExcursions);
        excursionSelect.addEventListener('change', updateSummary);
        personsInput.addEventListener('input', updateSummary);

        updateSummary();
    });
</script>
@endpush
