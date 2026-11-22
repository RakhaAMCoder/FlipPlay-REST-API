<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:media,title',
            'type' => 'required|in:Anime,Drama,Manga',
            'genre' => 'required|string|max:255',
            'release_year' => 'required|integer|min:1900|max:2100',
            'description' => 'required|string',
        ];
    }
}