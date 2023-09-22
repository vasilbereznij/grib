<?php
//создаем:
// php artisan make:controller Application/RegisterController
namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Auth\Events\Registered;
// use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.register');
    }

    // public function register()
    public function register(RegisterRequest $request)
    {
        // dd($request->validated());
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);  // зашифровать пароль
        User::create($data);
        // User::create($request->validated());
        // User::create([
        //     'email' => $request->input('email'),
        //     'password' => $request->input('password'),
        // ]);
        return redirect()->back()->with('success', 'Register success'); //возврат обратно и сообщение "регистрация успешна"
        // return redirect()->route('login.form'); //если нужен переход на страницу login
    }
}
