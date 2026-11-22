<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('medium');

        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('media', 'title')->ignore($id),
            ],
            'type' => 'required|in:Anime,Drama,Manga',
            'genre' => 'required|string|max:255',
            'release_year' => 'required|integer|min:1900|max:2100',
            'description' => 'required|string',
        ];
    }
}