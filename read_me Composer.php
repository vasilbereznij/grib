 в CMD выполнить:
 проверить версию: composer --version (если нет- скачать и установить)
 проверить версию PHP: php -v (если нет- установить Open Server и прописать в PATH путь к каталогу с PHP)
 перейти в каталог проектов: cd project (cd /d/project)

 инсталл Laravel( ):
 composer create-project laravel/laravel grib

запустить Open Server (каталог проекта должен быыть в папке Domains или прописан в доменах)
 перейти в каталог проекта: cd grib
 запустить сервер (можно прямо из VS Code с помощью встроенной консоли): php artisan serve

 сервер запущен по адресу http://127.0.0.1:8000 (доступна стартовая страница)
 ( INFO Server running on [http://127.0.0.1:8000]. )
 останов: Ctrl+C (Press Ctrl+C to stop the server )

 обновление Laravel:
 composer update

 старт в браузере:
 http://127.0.0.1:8000/grib

 1.Создаем заготовки и шаблоны осн. страниц и меню (Шаблонизатор Blade)
 2.Создаем маршруты (Занятие 47 Роутинг: файл routes\web.php)
 // просмотреть все маршруты можно командой: php artisan route:list
 //если только созданные нами: php artisan route:list --except-vendor
 // помощь: php artisan help route:list
 //DOCUMENTATION: https://laravel.com/docs/9.x/routing
 проверяем открытие страниц

 3. Создаем БД:
 3а) настроить БД в файле .env:
 DB_CONNECTION=mysql
 DB_HOST=127.0.0.1
 DB_PORT=3306
 DB_DATABASE=grib
 DB_USERNAME=root
 DB_PASSWORD=root

 3б) Создаем модели и миграции:
 https://laravel.com/docs/9.x/migrations#foreign-key-constraints
 создать модель(в единственном числе): php artisan make:model grib
 создать миграцию: php artisan make:migration create_gribs_table
 но лучше одновременно модель и миграцию: php artisan make:model grib -m
 (модель создается в единственном числе, таблица - множественном)
 если название модели не соответствует имени таблицы- добавить в нее свойство: protected $table= 'grib';

 3в) заполняем миграции:
 пример миграции:
 $table->id(); //стандарт
 $table->string('NameUkr')->nullable(); // nullable()- Разрешает NULL
 $table->boolean('is_public')->default(false);
 $table->timestamps(); //стандарт: время создания-изменения (поля created_at и updated_at)

 создание связи:
 $table->unsignedBigInteger('article_id')->nullable(); //для создания связи тип обязательно такой
 $table->foreign('article_id')->references('id')->on('articles');

 создание связи другим способом:таблицу для связи и поле понимает по названию поля,
 если название другое-указать в параметрах constrained(...):
 $table->foreignId('gribs_id')->nullable()
 ->constrained()
 ->cascadeOnDelete() //поведение при удалении
 ->cascadeOnUpdate();
 (см.документация Migrations/Foreign Key Constraints: https://laravel.com/docs/9.x/migrations#foreign-key-constraints)

 3г) выполнить все еще не выполненные миграции: php artisan migrate
 (по умолчанию создаются таблицы users, password_resets, failed_jobs, personal_access_tokens)

 3д) проверяем БД. корректируем миграции.
 если нужно обновить БД(очищает!!!): php artisan migrate:refresh

 4.заполняем модели. Например:
 <?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Casts\Attribute;
    use Illuminate\Database\Eloquent\Model;

    class grib extends Model
    {
        use HasFactory;
        protected $fillable = ['categories_Type0', 'Type1', 'Type2', 'is_public']; // список полей

        public function comments() // связь с подчиненной таблицей
        {
            return $this->hasMany(Comment::class);  //cм. "БРОМ: Eloquent - отношения" 17:30 и до конца
            // return $this->hasOne(Comment::class);  // отобрать одну статью (так применять в главной таблице)
            // return $this->belongsToMany(Article::class);  //отобрать одну статью(так применять в подчиненной таблице)
            // return $this->belongsTo(Article::class);  //(так применять в подчиненной таблице)
        }

        // если нужно-изменить значение поля(Eloquent - Аксессоры и мутаторы):
        // https://laravel.com/docs/9.x/eloquent-mutators#main-content     Defining A Mutator
        public function title(): Attribute
        {
            return Attribute::make(
                get: fn ($value) => ucfirst($value), // например устанавливаем первую большую букву:
                set: fn ($value) => ucfirst($value),
            );
        }
        //напр.преобразовывать тип: возвращать 'is_public' в true/false):
        protected $casts = [
            'is_public' => 'boolean'
        ];
        public function IsPubic(): bool
        {
            return $this->is_public;
        }
    }
    ?>

 4.Создаем осн. контроллеры. Например:
 PagesController - для вывода на экран страниц в соответствии с маршрутами:
 php artisan make:controller Application/PagesController
 gribsController -для создания/изменения/удаления записей:
 php artisan make:controller Application/gribsController

 4.проверяем/отлаживаем элементарную работу одной формы: чтение/запись в БД (51 Отправка форм)
 4а.если нужно получить файл из формы:
 вставить в нее обяз атрибут для отправки файлов enctype='multipart/form-data' (ЗАГРУЗКА ФАЙЛОВ 2:10)
 и получить путь, например, в контроллере:
 if ($request->hasFile('preview')) {
 $previewImagePats = "/storage/{$request->file("preview")->store('grib/previews', ['disk' => 'public'])}";
 }
 4b.Для чтения файлов изменяем публичный маршрут: php artisan storage:link
 ответ: INFO The [D:\project\grib\public\storage] link has been connected to [D:\project\grib\storage\app/public].
 (ЗАГРУЗКА ФАЙЛОВ 16:01)/ без цього не буде видно рисунків

 5.Создаем Кастомные Request (проверяет введенные пользователем значения) //см.Валидация https://laravel.com/docs/9.x/validation
 php artisan make:request Grib/createRequest
 проверяем
 аналогично остальные
 php artisan make:request User/RegisterRequest


Если не находит класс - команду 
 composer dump-auto   -  обновляет систему автозагрузки классов.
 composer dump-autoload --optimize       -оптимизация, чтобы автозагрузчик был наиболее быстрым. настоятельно рекомендуется для production (вы можете получить 20% прирост), проходит дольше
 (ошибка Class ... does not exist  - може бути неправильно namespace або великі/малі букви в іменах файлу-класу)

 6. доступ  - список див. файл app\Http\Kernel.php (БРОМ: Посредники 1:87)
 якщо треба - можна створити, напр:   php artisan make:middleware Application/IsPublicMiddleware  и по аналогии дописать в Kernel.php(18:22)

 'NameUkr' => ['required', 'string', 'min:5', 'max:255'], //'required'-обязательное поле
            'NameRus' => ['required', 'string', 'min:5', 'max:255'],
            'NameLat' => ['required', 'string', 'min:5', 'max:255'],
            'Description' => ['string', 'max:1000'],
            'Type1' => ['int'],
            'Type2' => ['int'],
            'preview' => ['image'],  //'preview' => ['required', 'image', 'mimes:png, svg', 'max:1200'],
            'is_public' => ['int']  



            //способ 2
        $grib->update([
            // 'title' => $request->input('title'),
            // 'body' => $request->input('body'),
            // 'is_public' => !empty($request->input('is_public')),
            // 'preview_image' => $previewImagePats ?? $grib->preview_image

            'id' => $request->input('id'),
            'NameRus' => $request->input('NameRus'),
            'NameLat' => $request->input('NameLat'),
            'Description' => $request->input('Description'),
            'Type1' => $request->input('Type1'),
            'Type2' => $request->input('Type2'),
            'is_public' => $request->has('is_public'),
            'is_public' => !empty($request->input('is_public')),
            'preview_image' => $previewImagePats ?? null,
        ]);