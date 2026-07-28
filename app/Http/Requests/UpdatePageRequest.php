<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:pages,slug,'.$this->route('page')->getKey(),
            'body' => 'nullable',
            'is_published' => 'boolean',
        ];
    }
}
