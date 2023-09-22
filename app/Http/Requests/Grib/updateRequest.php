<?php

namespace App\Http\Requests\Grib;

use Illuminate\Foundation\Http\FormRequest;

class updateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        
        // dd($_REQUEST );  //отобрать все
        dd($_POST);  //отобрать все


        // Можно передавать и многомерные массивы, например для редактирования сразу нескольких записей в базе данных:

        // <form>
        //     <input type="text" name="images[10][title]">
        //     <input type="text" name="images[10][url]">
        //     <input type="text" name="images[11][title]">
        //     <input type="text" name="images[11][url]">
        //     <input type="submit">
        // </form>

        
        return [
            // 'NameUkr' => ['required', 'string', 'min:5', 'max:255'], //'required'-обязательное поле
            // 'NameRus' => ['required', 'string', 'min:5', 'max:255'],
            // 'NameLat' => ['required', 'string', 'min:5', 'max:255'],
            // 'Description' => ['string', 'max:2000'],
            'preview' => ['image']  //'preview' => ['required', 'image', 'mimes:png, svg', 'max:1200']
        ];
    }
}
