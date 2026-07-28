<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:documents,slug,'.$this->route('document')->getKey(),
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|max:1000',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ];
    }
}
