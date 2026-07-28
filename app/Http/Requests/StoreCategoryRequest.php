<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'slug' => 'required|max:255|unique:categories,slug',
            'type' => 'required|in:post,pengumuman,dokumen',
            'order' => 'nullable|integer|min:0',
        ];
    }
}
