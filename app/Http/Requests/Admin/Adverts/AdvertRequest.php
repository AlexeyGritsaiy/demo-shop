<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin\Adverts;

use Illuminate\Foundation\Http\FormRequest;

class AdvertRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:1|max:255',
            'content' => 'required|string|min:3',
            'price' => 'required|int|min:0',
            'categories' => 'required',
            'categories.*' => 'required|int|exists:advert_categories,id',
            'files.*' => 'image|mimes:jpg,jpeg,png',
        ];
    }
}
