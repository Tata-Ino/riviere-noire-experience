<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasAdminRole();
    }

    public function rules(): array
    {
        $restaurantId = $this->route('restaurant')?->id ?? $this->route('restaurant');

        return [
            'place_id' => 'nullable|exists:places,id',
            'opening_hours' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
            'translations' => 'required|array|min:1',
            'translations.*.name' => 'required|string|max:255',
            'translations.*.description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'video_url' => 'nullable|url',
        ];
    }
}
