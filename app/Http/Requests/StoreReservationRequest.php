<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'place_id' => 'required|exists:places,id',
            'excursion_id' => 'nullable|exists:excursions,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'country' => 'nullable|string|max:100',
            'language_id' => 'required|exists:languages,id',
            'nb_persons' => 'required|integer|min:1|max:50',
            'visit_date' => 'required|date|after:today',
            'notes' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'place_id.required' => 'Veuillez sélectionner un lieu.',
            'place_id.exists' => 'Le lieu sélectionné n\'existe pas.',
            'full_name.required' => 'Veuillez entrer votre nom complet.',
            'email.required' => 'Veuillez entrer votre adresse e-mail.',
            'email.email' => 'L\'adresse e-mail n\'est pas valide.',
            'phone.required' => 'Veuillez entrer votre numéro de téléphone.',
            'nb_persons.required' => 'Veuillez indiquer le nombre de personnes.',
            'nb_persons.min' => 'Il doit y avoir au moins 1 personne.',
            'visit_date.required' => 'Veuillez choisir une date de visite.',
            'visit_date.after' => 'La date de visite doit être dans le futur.',
        ];
    }
}
