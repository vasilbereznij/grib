<?php

use App\Http\Controllers\Application\PagesController;
use App\Http\Controllers\Application\gribsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Application\RegisterController;
use App\Http\Controllers\Application\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

// Занятие 47 Роутинг
// синтаксис: Route::get('/адрес', маршрут); 
// адрес http://127.0.0.1:8000/адрес
// http://127.0.0.1:8000/grib
// Route::get('/', [PagesController::class, 'grib'])->name('grib'); - для одного контр.
Route::controller(PagesController::class)->group(function () {  //відкриває сторінку
    Route::get('/', 'hello')->name('hello'); //Заходьте, будь ласка!    http://grib
    //Route::get('gribs/create', 'CreateGribForm')->name('grib.page.create')->middleware('auth'); // створити /лише авторизовані  http://grib/grib/create
    //Route::get('gribs/create', 'CreateGribForm')->name('grib.page.add'); // створити /лише авторизовані  http://grib/grib/create
    Route::get('gribs/create', 'CreateGribForm')->name('grib.page.add')->middleware('auth'); // створити /лише авторизовані  http://grib/grib/create
    // посредник App\Http\Middleware\Authenticate.php дает ошибку: нужно изменить имя страницы в нем return route('login') на return route('login.form')  
    /////Route::get("gribs/create", 'CreateGribForm')->name('grib.page.add')->middleware('auth');
   
   
    Route::get('/gribs/{category}', 'selection')->name('selection'); //головна ?? ДОРОБИТИ вибір??    http://grib/grib
    Route::get('/gribs', 'gribs')->name('gribs');  // Перегляд всіх http://grib/gribs
    // Route::get('/categories', 'categories')->name('categories');
    Route::get('grib/{grib}', 'ShowGrib')->name('grib');  // перегляд одного з кнопками редагування   http://grib/grib/1
    // Route::get("articles/{article}", 'ShowArticle')->middleware('article.is_public')->name('article');
    // посредник 'article.is_public' нужно создать и зарегистрировать (app\Http\Middleware\Articles\IsPubicMiddlevare.php)
    Route::get('gribs/{grib}/edit', 'EditGribForm')->name('grib.page.egit')->middleware('auth'); // редагувати /лише авторизовані
    Route::get('/about', 'about')->name('about');  //Про сайт  http://grib/about
    Route::get('/security', 'security')->name('security');  //Безпека  http://grib/security
});

Route::controller(gribsController::class)->middleware('auth')->group(function () {          //записує в БД
    Route::post('grib/create', 'create')->name('grib.create');
    Route::post("gribs/{grib}/update", 'update')->name('gribs.update');
    Route::post("gribs/{grib}/delete", 'delete')->name('gribs.delete');
    //Route::post("articles/{article}/comment", 'comment')->name('articles.comment');
    // 51 Отправка форм
    // php artisan make:controller Application/ArticlesController
});

// посредник middleware('guest', '...', ...) не пускає не авторизированных пользователей(переадресует на /home) / файл ...app\Http\Kernel.php 
Route::controller(RegisterController::class)->middleware('guest')->group(function () {
    Route::get("/register", 'index')->name('register.form');
    Route::post("/register", 'register')->name('register.action');
});

Route::controller(LoginController::class)->middleware('guest')->group(function () {  // посредник на всю группу/ пускає тільки гостей
    // Route::controller(LoginController::class)->group(function () {
    Route::get("/login", 'index')->name('login.form');
    // Route::get("/login", 'index')->name('login.form')->middleware('guest'); // если посредник нужен на один роутер
    Route::post("/login", 'login')->name('login.action');
    Route::post("/logout", 'logout')->name('logout')->withoutMiddleware('guest'); //отключает посредника
});

// // http://127.0.0.1:8000/users/2,
// Route::get("/users/{user}", function ($user) {
//     require __DIR__ . '/users.php';
//     foreach ($users as $user_) {
//         // foreach ($users as $key => $user_) {
//         if ($user_["id"] == $user) {
//             return "<H1>Hello, {$user_["name"]}!</H1>";
//         }
//     }
//     return "<H3 style='color:red'>User is not found!</H3>";
// });

