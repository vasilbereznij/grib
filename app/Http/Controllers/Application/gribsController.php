<?php


namespace App\Http\Controllers\Application;
// namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
        use Illuminate\Http\Request;
        use Illuminate\Support\Facades\Validator; //для валидации переменных |не GET|
use App\Http\Requests\Grib\createRequest;
use App\Http\Requests\Grib\UpdateRequest;
use App\Models\grib;
use App\Models\name;
use App\Models\image;
use App\Models\description;
        use Illuminate\Http\RedirectResponse;



class gribsController extends Controller
{
    public function create(createRequest $request)
    {
        // dd($request->all());  //отобрать все
        if ($request->hasFile('preview')) {  //получить путь к рисунку
            $previewImagePats = "/storage/{$request->file("preview")->store('grib/previews', ['disk' => 'public'])}";
        }
        // dd($$request->input('id'));  
        $grib = grib::create([
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
        
        $grib_id = $grib->id;

        $grib = image::create([
            'grib_id' => $grib_id,
            'GribImage' => $previewImagePats ?? null,
            'GribImage_preview' => $previewImagePats ?? null,
            'priority' => 1,
        ]);

        $grib = name::create([
            'grib_id' => $grib_id,
            'GribName' => $request->input('NameUkr'),
            'Language' => 'ua',
            'priority' => 1,
        ]);

        $grib = name::create([
            'grib_id' => $grib_id,
            'GribName' => $request->input('NameRus'),
            'Language' => 'ru',
            'priority' => 1,
        ]);
        $grib = name::create([
            'grib_id' => $grib_id,
            'GribName' => $request->input('NameLat'),
            'Language' => 'en',
            'priority' => 1,
        ]);

        $grib = description ::updateOrCreate([
            'grib_id' => $grib_id,
            'Language' => 'ru',
            // 'Language' => $request->input('Language'),
            // 'name' => $translation['name'],
            // Fields that should be used to find an existing record. (Поля для поиска существующей записи.)
        ], [
            'grib_id' => $grib_id,
            'Description' => $request->input('Description'),
            'Language' => 'ru',
            // 'Language' => $request->input('Language'),
            // 'description' => "New description",
            // Fields that should be updated.(запись)
        ]);


        // dd($request->all());
        return redirect()->route('grib.page.create', [
            'grib' => $grib->id
        ]);

    }

    public function update(updateRequest $request, grib $grib)
    {
        $gribId = $grib->id;
        // dd($grib->id);  //!!!!! id!!!
        // dd($request->ip());  //!!!!! ip!!!
        // dd($request->title);
                     // dd($request->hasFile('preview'));
        // dd($request->all());  //отобрать все
        // dd($request->input('NameRus'));  //отобрать все
        // dd($request->allFiles());  //отобрать все
        //  dd($request->hasFile('preview'));  //!!!!! id!!!    
         
         
        if ($request->hasFile('preview')) { //проверяем, есть ли картинка
            //создаем файл хранения и сохраняем путь 
            $previewImagePats = "/storage/{$request->file("preview")->store('grib/previews', ['disk' => 'public'])}";
        }
        //способ 1
        // $article->title = $request->input('title'); //заполняем 
        // $article->body = $request->input('body');
        // $article->is_public = $request->has('is_public');
        // $article->preview_image = $previewImagePats ?? $article->preview_image;
        // $article->save(); //записываем в базу 

        //способ 2





        $grib->update([
            // 'title' => $request->input('title'),
            // 'body' => $request->input('body'),
            // 'GribName' => $request->input('NameRus'),
            // 'NameRus' => $request->input('NameRus'),
            'Type1' => $request->input('Type1'),
            'Type2' => $request->input('Type2'),
            'is_public' => !empty($request->input('is_public')),
            'preview_image' => $previewImagePats ?? $grib->preview_image
        ]);
        

        // $grib = name::create([
        //     'grib_id' => $grib->id,
        //     'GribName' => $request->input('NameRus'),
        //     'Language' => 'ru',
        //     'priority' => 1,
        // ]);
        // dd($request);  //!!!!! id!!!
        

        // foreach ( $request->input('Name') as $Name_){
        //     // dd($Name_['Name']);  //!!!!! id!!!
        // $grib = name::updateOrCreate([
        //     'GribName' => $Name_['Name'],
        //     // 'GribName' => $request->input('Name_'),
        //     // 'name' => $translation['name'],
        //     // Fields that should be used to find an existing record.(Поля, которые следует использовать для поиска существующей записи.)
        // ], [
        //     'grib_id' => $gribId,
        //     'GribName' => $Name_,
        //     // 'GribName' => $request->input('Name_'),
        //     'Language' => 'ru',
        //     'priority' => 1,
        //     // 'description' => "New description",
        //     // Fields that should be updated.
        // ]);
        // }
        // dd($request); 
    
                
    // dd($grib->id);  //!!!!! id!!!

        // $grib = description ::updateOrCreate([
        //     'grib_id' => $gribId,
        //     'Language' => $request->input('Language'),
        //     // 'name' => $translation['name'],
        //     // Fields that should be used to find an existing record. (Поля для поиска существующей записи.)
        // ], [
        //     'grib_id' => $gribId,
        //     'Description' => $request->input('Description'),
        //     'Language' => $request->input('Language'),
        //     // 'description' => "New description",
        //     // Fields that should be updated.(запись)
        // ]);

        // dd($request->all());  //отобрать все


        return redirect()->back();  //возврат на страничку, откуда пришли
    }
    
    public function delete(grib $grib): RedirectResponse
    {
        //Удаление бывает полным и мягким(только метка в поле deleted_at  БД )        //для создания поля: "$table->softDeletes();" в миграциях
        $grib -> delete(); //если есть поле и 'use ..., SoftDeletes' в модели - только метка, если нет - полное
        //$grib->forceDelete(); //всегда удаляет полностью 
        return redirect()->route('gribs');
    }

}
