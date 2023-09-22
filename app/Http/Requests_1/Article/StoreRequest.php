<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['string', 'max:1000'],
            'preview' => ['image']
            // 'articleTitle' => ['required', 'string']
        ];
    }

    // //примеры
    // public function all($keys = null)
    // {
    //     return [
    //         //   отбирает только нужные поля
    //         'title' => $this->input('title'),
    //         'body' => $this->input('body'),
    //         'preview' => $this->input('preview')
    //     ];
    // }
}
