<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{

    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['string', 'max:1000'],
            'preview' => ['image']
        ];
    }
}
