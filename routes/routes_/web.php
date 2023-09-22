<?php

use App\Http\Controllers\Application\PagesController as ApplicationPagesController;
// use App\Http\Controllers\PagesController as ControllersPagesController;
use Illuminate\Support\Facades\Route;
// use Symfony\Component\Routing\Route as RoutingRoute;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;
use App\Http\Controllers\Application\ArticlesController;
use App\Http\Controllers\Application\RegisterController;
use App\Http\Controllers\Application\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// // адрес http://127.0.0.1:8000 стартовая страница по умолчанию
// // Открыть views welcome.blade.php
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/laravel', function () {
    return  view(
        'laravel',
        [
            "Laravel Jetstream", "Models Directory", "Model Factory Classes"
        ]
    );
});


// Занятие 47 Роутинг
// адрес http://127.0.0.1:8000/test
Route::get('/test', function () {
    return "Hello";
});
// адрес можно без /
Route::get('About', function () {
    return "<H1>About</H1>";
});
// адрес с подкаталогом через функцию 
Route::get('About/company', function () {
    return "<H1>About company</H1>";
});
// в адресе через функцию передать значение
// // http://127.0.0.1:8000/articles3/123
Route::get("articles3/{id}", function ($id) {
    return "<H1>articles $id</H1>";
});
// в адресе через функцию передать несколько значений
// http://127.0.0.1:8000/articles1/123/comments/comment123
Route::get("articles1/{article}/comments/{comment}", function ($article, $comment) {
    return "<H1>article $article</H1><br><H2>comment $comment</H2>";
});
// передать информацию через класс Request
// http://127.0.0.1:8000/articles2/123?color=red
Route::get("articles2/{id}", function ($id, Request $request) {
    // dd($request);
    return "<H1 style='color:{$request->get('color')}' >article $id</H1>";
});

//// просмотреть все маршруты можно командой: php artisan route:list
////если только созданные нами: php artisan route:list --except-vendor
//// помощь:  php artisan help route:list

////DOCUMENTATION:   https://laravel.com/docs/9.x/routing


//ДЗ:
// http://127.0.0.1:8000/welcome
Route::get('/welcome', function () {
    return "<H3>Welcome to Laravel!</H3>";
});

// http://127.0.0.1:8000/users/2,
Route::get("/users/{user}", function ($user) {
    require __DIR__ . '/users.php';
    foreach ($users as $user_) {
        // foreach ($users as $key => $user_) {
        if ($user_["id"] == $user) {
            return "<H1>Hello, {$user_["name"]}!</H1>";
        }
    }
    return "<H3 style='color:red'>User is not found!</H3>";
});

// Занятие 48 Шаблонизатор Blade
// $articles = [
//     [
//         'id' => 1,
//         'title' => 'Some post 1',
//         'body' => 'lorem ipsum 1 Some quick example text to build on the card title and make up the bulk of the card.',
//     ],
//     [
//         'id' => 2,
//         'title' => 'Some post 2',
//         'body' => 'lorem ipsum 2Some quick example text to build on the card title and make up the bulk of the card.',
//     ],
//     [
//         'id' => 3,
//         'title' => 'Some post 3',
//         'body' => 'lorem ipsum 3 Some quick example text to build on the card title and make up the bulk of the card.'
//     ]
// ];

// Открыть views articles в папке pages +передать туда информацию
// http://127.0.0.1:8000/articles
// Route::get("/articles", function () use ($articles) {

//     // варианты передачи данных:
//     // 1)
//     // return view('pages.articles')->with('articles', $articles)
//     //     ->with('test', 'TEST');
//     // 2)
//     return view('pages.articles', [
//         'articles' => $articles
//     ]);
//     // function view($view = null, $data = [], $mergeData = []) { }
// })->name('articles');  //псевдоним

// Занятие 49 Создаем свой шаблон и формируем страницы
// // адрес http://127.0.0.1:8000/hello
// Route::get('/hello', function () {
//     return view('pages.hello');
// });

// // адрес http://127.0.0.1:8000 новая стартовая страница по умолчанию
// Route::get('/', function () {
//     return view('pages.hello');
// })->name('hello');  //псевдоним


// http://127.0.0.1:8000/articles/1
// Route::get("articles/{article}", function ($article) use ($articles) {
//     $article = array_filter($articles, function ($item) use ($article) {
//         return $item['id'] === (int) $article;
//     });
//     $article = array_shift($article);
//     if (is_null($article)) {
//         return abort(404);
//     }

//     return view('pages.article', [
//         'title' => $article['title'],
//         'body' => $article['body']
//     ]);
// })->name('article');  //псевдоним для одного;
// подробнее:
// https://laravel.com/docs/9.x/blade
// https://laravel.com/docs/9.x/views

// Занятие 50 Контроллеры
//  в команд. стр. создаем Контроллер(+каталог) для pages.hello:
//  php artisan make:controller Application/PagesController
// адрес http://127.0.0.1:8000 новая стартовая страница по умолчанию

// Route::get('/', [ApplicationPagesController::class, 'hello'])->name('hello');
// Route::get("/articles", [ApplicationPagesController::class, 'articles'])->name('articles');
// Route::get("articles/{article}", [ApplicationPagesController::class, 'ShowArticle'])->name('article');

//// группируем (упрощаем) запись:
Route::controller(ApplicationPagesController::class)->group(function () {
    Route::get('/', 'hello')->name('hello');
    Route::get("/articles", 'articles')->name('articles');
    Route::get("articles/create", 'CreateArticleForm')->name('article.page.add')->middleware('auth');
    // посредник App\Http\Middleware\Authenticate.php дает ошибку: нужно изменить имя страницы в нем return route('login') на return route('login.form')  
    Route::get("articles/{article}", 'ShowArticle')->middleware('article.is_public')->name('article');
    // посредник 'article.is_public' нужно создать и зарегистрировать (app\Http\Middleware\Articles\IsPubicMiddlevare.php)
    Route::get("articles/{article}/edit", 'updateArticleForm')->name('article.page.egit');
});
// 51 Отправка форм
//  php artisan make:controller Application/ArticlesController
Route::controller(ArticlesController::class)->middleware('auth')->group(function () {
    // Route::get('/', 'hello')->name('hello');
    // Route::get("/articles", 'articles')->name('articles');
    Route::post("articles/create", 'create')->name('articles.create');
    Route::post("articles/{article}/update", 'update')->name('articles.update');
    Route::post("articles/{article}/delete", 'delete')->name('articles.delete');
    // Route::get("articles/{article}", 'ShowArticle')->name('article');
});

// посредник middleware('guest') не пускает на страницу авторизированных пользователей(переадресует на /home) / файл ...app\Http\Kernel.php 
//при необходимости нескольких категорий, их можно перечислить списком: middleware('guest', 'xxxx','yyyy'...)
Route::controller(RegisterController::class)->middleware('guest')->group(function () {
    Route::get("/register", 'index')->name('register.form');
    Route::post("/register", 'register')->name('register.action');
});

Route::controller(LoginController::class)->middleware('guest')->group(function () {  // посредник на всю группу
    // Route::controller(LoginController::class)->group(function () {
    Route::get("/login", 'index')->name('login.form');
    // Route::get("/login", 'index')->name('login.form')->middleware('guest'); // если посредник нужен на один роутер
    Route::post("/login", 'login')->name('login.action');
    Route::post("/logout", 'logout')->name('logout')->withoutMiddleware('guest'); //отключает посредника
});
