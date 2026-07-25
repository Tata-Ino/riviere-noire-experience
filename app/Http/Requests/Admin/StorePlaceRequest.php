<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePlaceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasAdminRole();
    }

    public function rules(): array
    {
        return [
            'slug' => 'required|string|max:255|unique:places,slug',
            'price' => 'nullable|numeric|min:0',
            'is_featured' => 'boolean',
            'status' => 'required|in:active,inactive',
            'translations' => 'required|array|min:1',
            'translations.*.name' => 'required|string|max:255',
            'translations.*.short_description' => 'nullable|string|max:500',
            'translations.*.description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'video_url' => 'nullable|url',
        ];
    }

    public function messages(): array
    {
        return [
            'slug.required' => 'Le slug est obligatoire.',
            'slug.unique' => 'Ce slug existe déjà.',
            'translations.required' => 'Au moins une traduction est requise.',
            'translations.*.name.required' => 'Le nom est obligatoire pour cette langue.',
            'cover_image.image' => 'Le fichier doit être une image.',
            'cover_image.max' => 'L\'image ne doit pas dépasser 5 Mo.',
        ];
    }
}
