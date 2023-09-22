<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; //для валидации переменных |не GET|
use App\Http\Requests\Article\StoreRequest;
use App\Http\Requests\Article\UpdateRequest;
use App\Models\Article;
// use App\Models\Articles;
use Illuminate\Http\RedirectResponse;

class ArticlesController extends Controller
{
    // функция create начиная с занятия "58 Eloquent - добавление записей"
    public function create(StoreRequest $request)
    //обработка переданной в форме информации:
    {
        // dd($request->all());  //отобрать все
        // dd($request->has('is_public')); //отобрать 'is_public'
        // // $pats = $request->file("preview")->store('aticle/previews');
        // // $url = config('app.url') . "/storage/$pats";
        if ($request->hasFile('preview')) {
            $previewImagePats = "/storage/{$request->file("preview")->store('article/previews', ['disk' => 'public'])}";
        }
        // // $title = $request->input('title');


        //способ 1 (10:41)
        // $article = new Article(); //создаем объект модели
        // $article->title = $request->input('title'); //заполняем его
        // $article->body = $request->input('body');
        // $article->is_public = $request->has('is_public');
        // $article->preview_image = $previewImagePats;
        // $article->save(); //записываем в базу 

        //способ 2 (18:00) //если просто добавить запись, в модели дожен быть список полей: protected $fillable ...
        $article = Article::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            // 'is_public' => $request->has('is_public'),
            'is_public' => !empty($request->input('is_public')),
            'preview_image' => $previewImagePats ?? null,
        ]);



        //переходим на страничку записи
        // dd($request->all());
        // dd('$article');

        // hhhhhhhhhhhhhhhhh
        return redirect()->route('article', [
            'article' => $article->id
        ]);
    }

    public function update(UpdateRequest $request, Article $article)
    {
        if ($request->hasFile('preview')) { //проверяем, есть ли картинка
            //создаем файл хранения и сохраняем путь 
            $previewImagePats = "/storage/{$request->file("preview")->store('article/previews', ['disk' => 'public'])}";
        }
        //способ 1
        // $article->title = $request->input('title'); //заполняем 
        // $article->body = $request->input('body');
        // $article->is_public = $request->has('is_public');
        // $article->preview_image = $previewImagePats ?? $article->preview_image;
        // $article->save(); //записываем в базу 

        //способ 2
        $article->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'is_public' => !empty($request->input('is_public')),
            'preview_image' => $previewImagePats ?? $article->preview_image
        ]);
        return redirect()->back();  //возврат на страничку, откуда пришли
    }

    public function delete(Article $article): RedirectResponse
    {
        //Удаление бывает полным и мягким(только метка в поле deleted_at  БД )
        //для создания поля: "$table->softDeletes();" в миграциях
        $article->delete(); //если есть поле и 'use ..., SoftDeletes' в модели - только метка, если нет - полное
        //$article->forceDelete(); //всегда удаляет полностью 
        return redirect()->route('articles');
    }

    // ниже- та же функция create в предыдущих занятиях (до 58 Eloquent - добавление записей)
    public function create1(StoreRequest $request)
    // public function create(Request $request)
    //обработка переданной в форме информации:
    { {
            // dd($request ->all());
            // //53Валидация полей
            // $data = [
            //     'number1' => 331.5,
            //     'user1' => [
            //         'languages' => ['ru', 'en3'],
            //         'age' => 33
            //     ],
            //     'art' => [
            //         [
            //             'id' => 1,
            //             'title' => "1"
            //         ],
            //         [
            //             'id' => "2",
            //             'title' => "2"
            //         ]
            //     ]
            // ];
            // $validator = Validator::make(
            //     $data,
            //     [
            //         'number1' => ['required', 'int', 'min:5', 'max:50'],
            //         'user.age' => ['required', 'integer', 'min:3'],
            //         'user.languages.*' => ['string', 'max:2'],
            //         'art' => ['required', 'array'],
            //         'art.*.id' => ['required', 'integer'],
            //         'user1.languages' => ['string', 'max:2']
            //     ]
            // );

            // // dd($validator);
            // dd($validator->getMessageBag()->getMessages());
            $request->validate([
                'title' => 'required|string|min:1|max:10', //должна быть строка не 1<символов<10
                'body' => ['required', 'string', 'min:5', 'max:500'], //другой вариант записи
                'preview' => ['required', 'image', 'mimes:png, svg', 'max:1200']
            ]);
            // подробнее валидация  - https://laravel.com/docs/9.x/validation
            // функции(правила) для валидация  - https://laravel.com/docs/9.x/validation#available-validation-rules
            //     // $request->files->all() //передаваемая инф- файлы весь список 
            //     // $request->headers->all() //передаваемая инф- заголовки весь список 
            //     // $request->file("preview") //передаваемая инф- один файл: все атрибуты  
            //     // $request->file("preview")->get() // -"- один файл: сам  файл
            //     // $request->file("preview")->getClientOriginalExtension() // -"-расширение  файла
            //     $request->file("preview")->getSize() // -"-размер  файла
            // );

            // сохранить переданный файл в каталог 'learning\storage\app\aticle\previews'
            //(каталог 'STORAGE'  - место для хранения разных файлов
            //(настройка путей в файле config/filesystems.php и переменной FILESYSTEM_DISK=... файл '.env' )
            $request->file("preview")->store('aticle/previews');
            //если нужен внешний доступ, подкаталог должен быть : learning\storage\app\public, тогда:
            $request->file("preview")->store('aticle/previews', [
                'disk' => 'public'
            ]);
            // (или FILESYSTEM_DISK=public в файле '.env')
            // для просмотра файлов в браузере выполнить
            // php artisan storage:link
            // тогда они будут доступны по пути, например
            // D:\project\learning\public\storage\aticle\previews\ZOmPDZ1WlEjBPqsy8BXW4gkT8sOFgT2QpWfxHJC8.jpg
            //(52 ЗАГРУЗКА ФАЙЛОВ)
            $pats = $request->file("preview")->store('aticle/previews');
            $url = config('app.url') . "/storage/$pats";
            // dd($url);
            // D:\project\learning\public\storage\aticle\previews\wqzCGITe5xiM9epQRXnPG3iPlTZ9tb2a5trxQeqm.jpg
            // $url -    http://localhost/storage/aticle/previews/wqzCGITe5xiM9epQRXnPG3iPlTZ9tb2a5trxQeqm.jpg
            // http://127.0.0.1:8000/storage/aticle/previews/wqzCGITe5xiM9epQRXnPG3iPlTZ9tb2a5trxQeqm.jpg
            // создаем переменные(пример)  
            $title = $request->input('title');
            $body = $request->input('body');
            //записываем в БД
        }
        return 'записано в БД';
    }
}
