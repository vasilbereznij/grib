<?php
//  php artisan make:request Grib/createRequest
namespace App\Http\Requests\Grib;

use Illuminate\Foundation\Http\FormRequest;

class createRequest extends FormRequest
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
        // dd($_REQUEST );  //отобрать все
        // dd($_POST);  //отобрать все
        return [
            'NameUkr' => ['required', 'string', 'min:5', 'max:255'], //'required'-обязательное поле
            'NameRus' => ['required', 'string', 'min:5', 'max:255'],
            'NameLat' => ['required', 'string', 'min:5', 'max:255'],
            'Description' => ['string', 'max:2000'],
            'preview' => ['image']  //'preview' => ['required', 'image', 'mimes:png, svg', 'max:1200']
        ];
    }
}
