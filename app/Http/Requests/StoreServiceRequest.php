<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:services,slug',
            'icon' => 'nullable|max:100',
            'description' => 'required',
            'procedure' => 'nullable',
            'requirements' => 'nullable',
            'contact_info' => 'nullable|max:500',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ];
    }
}
