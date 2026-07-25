<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlaceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasAdminRole();
    }

    public function rules(): array
    {
        $placeId = $this->route('place')?->id ?? $this->route('place');

        return [
            'slug' => 'required|string|max:255|unique:places,slug,' . $placeId,
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
}
