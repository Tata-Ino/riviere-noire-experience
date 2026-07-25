<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExcursionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasAdminRole();
    }

    public function rules(): array
    {
        $excursionId = $this->route('excursion')?->id ?? $this->route('excursion');

        return [
            'place_id' => 'required|exists:places,id',
            'slug' => 'required|string|max:255|unique:excursions,slug,' . $excursionId,
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
            'position' => 'integer|min:0',
            'translations' => 'required|array|min:1',
            'translations.*.name' => 'required|string|max:255',
            'translations.*.description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'video_url' => 'nullable|url',
        ];
    }
}
