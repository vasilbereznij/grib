<?php
//создаем:
// php artisan make:controller Application/LoginController
namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.login');
    }

    public function login(LoginRequest $request)
    {
        // dd($request->input('password'));
        if (Auth::attempt($request->validated())) {
            return redirect()->route('hello');
        }
        return redirect()->back()->withErrors(['auth_error' => 'Incorrect credentials']);
        // // второй вариант:
        // Auth::attempt([
        //     'email' => $request->input('email'),
        //     'password' => $request->input('password')
        // ]);
        // при желании можно аналогично  войти через 'name' (см. 54:23) 
        //return redirect()->route('hello');

        //  подробнее авторизация в файле  ...\config\auth.php (см БРОМ: Аутентификация 29:45)
        // // первый вариант:
        // $user = User::whereEmail($request->input('email'))->first();
        // if ($user) {
        //     //сверяем пароль БРОМ: Аутентификация 36:30
        //     // dd($user->password, $request->input('password'), Hash::check($request->input('password'), $user->password));
        //     if (Hash::check($request->input('password'), $user->password)) {
        //         // Auth::check(); // auth()->check(); -полный аналог, часто лучше использовать его: не нужно загружать "use Illuminate\Support\Facades\Auth;"
        //         Auth::login($user, true); // login($user, $remember = false)- где $remember - флаг 'remember_token' в БД(изучить самостоятельно)
        //         // dd("auth OK");
        //         return redirect()->route('hello');
        //     };
        // } else {
        //     echo ('error');
        // }
        // return redirect()->route('login.form');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.form');
    }
}
