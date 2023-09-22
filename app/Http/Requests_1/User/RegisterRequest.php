<?php
// php artisan make:request User/RegisterRequest
namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed']
        ];
        //см.Валидация https://laravel.com/docs/9.x/validation
        // 'required'-обязательное поле
        // confirmed проверка пароля  https://laravel.com/docs/9.x/validation#rule-confirmed? 
        // название password_confirmation обязательно
    }
}
