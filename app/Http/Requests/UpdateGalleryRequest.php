<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'description' => 'nullable|max:1000',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'cover_image.image' => 'Cover harus berupa gambar.',
            'cover_image.mimes' => 'Cover harus berformat: jpeg, png, jpg, atau webp.',
            'cover_image.max' => 'Ukuran cover tidak boleh lebih dari 2 MB.',
            'images.*.image' => 'Setiap foto harus berupa gambar.',
            'images.*.mimes' => 'Setiap foto harus berformat: jpeg, png, jpg, atau webp.',
            'images.*.max' => 'Setiap foto tidak boleh lebih dari 2 MB.',
        ];
    }
}
