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
Route::controller(PagesController::class)->group(function () {
    Route::get('/', 'hello')->name('hello');
    Route::get('/grib', 'selection')->name('selection');
    Route::get('/gribs', 'gribs')->name('gribs');
    Route::get('grib/create', 'CreateGribForm')->name('grib.page.create');
    // Route::get("articles/create", 'CreateArticleForm')->name('article.page.add')->middleware('auth');
    Route::get('grib/{grib}', 'ShowGrib')->name('grib');
    // Route::get("articles/{article}", 'ShowArticle')->middleware('article.is_public')->name('article');
    Route::get('grib/{grib}/edit', 'EditGribForm')->name('grib.page.egit');
    Route::get('/about', 'about')->name('about');
    Route::get('/security', 'security')->name('security');
});

Route::controller(gribsController::class)->group(function () {
    Route::post('grib/create', 'create')->name('grib.create');
    Route::post("grib/{grib}/update", 'update')->name('grib.update');
    Route::post("grib/{grib}/delete", 'delete')->name('grib.delete');    
});

// посредник middleware('guest', '...', ...) не пускает авторизированных пользователей(переадресует на /home) / файл ...app\Http\Kernel.php 
Route::controller(RegisterController::class)->middleware('guest')->group(function () {
    Route::get("/register", 'index')->name('register.form');
    Route::post("/register", 'register')->name('register.action');
});

Route::controller(LoginController::class)->middleware('guest')->group(function () {  // посредник на всю группу/ пускает только гостей
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

// //// группируем (упрощаем) запись:
// Route::controller(ApplicationPagesController::class)->group(function () {
//     Route::get('/', 'hello')->name('hello');
//     Route::get("/articles", 'articles')->name('articles');
//     Route::get("articles/create", 'CreateArticleForm')->name('article.page.add')->middleware('auth');
//     // посредник App\Http\Middleware\Authenticate.php дает ошибку: нужно изменить имя страницы в нем return route('login') на return route('login.form')  
//     Route::get("articles/{article}", 'ShowArticle')->middleware('article.is_public')->name('article');
//     // посредник 'article.is_public' нужно создать и зарегистрировать (app\Http\Middleware\Articles\IsPubicMiddlevare.php)
//     Route::get("articles/{article}/edit", 'updateArticleForm')->name('article.page.egit');
// });
// // 51 Отправка форм
// //  php artisan make:controller Application/ArticlesController
// Route::controller(ArticlesController::class)->middleware('auth')->group(function () {
//     // Route::get('/', 'hello')->name('hello');
//     // Route::get("/articles", 'articles')->name('articles');
//     Route::post("articles/create", 'create')->name('articles.create');
//     Route::post("articles/{article}/update", 'update')->name('articles.update');
//     Route::post("articles/{article}/delete", 'delete')->name('articles.delete');
//     // Route::get("articles/{article}", 'ShowArticle')->name('article');
// });
