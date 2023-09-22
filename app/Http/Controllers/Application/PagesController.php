<?php
//отвечает за отображение страниц
namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\grib;
use App\Models\Comment;
use App\Models\category;
use App\Models\image;
use App\Models\name;
use App\Models\description;


class PagesController extends Controller
{
    public function hello()
    {
        return view('pages.hello');
    }

    public function selection()
    {
        $selection = category::get(); //отбор и запрос в БД /выводит все записи/ first() -первую найденную
        // @dd($selection);
        $image = image::get();
        // @dd($image);
        // $gribs = grib::where('is_public', true)
        // ->orderBy('id', 'desc')
        // ->get(); //отбор и запрос в БД /выводит все записи/ first() -первую найденную

        return view('selection', [
            'selection' => $selection,
            'image' => $image
        ]);
    }

    public function gribs()
    {
        // $image = image::get();
        $gribs = grib::where('is_public', true)
            ->orderBy('id', 'desc')
            ->get(); //отбор и запрос в БД /выводит все записи/ first() -первую найденную
        //  dd($gribs);
        // dd($gribs[1]->id);
        // dd(name::where('gribs_id', $gribs[1]->id)->get());
        // dd(name::where('gribs_id', $gribs[1]->id)->get());

        return view('pages.gribs', [
            'gribs' => $gribs
            // ,'GribName' => name::where('gribs_id', $gribs->id)->get(),
            // 'GribImage' => image::where('gribs_id', $gribs->id)->get()
        ]);
    }

    public function CreateGribForm()
    {
        return view('pages/gribCreate');
    }
    public function about()
    {
        return view('pages/about');
    }

    public function security()
    {
        return view('pages/security');
    }


    public function ShowGrib(grib $grib) //тип ...(Article $... лучше указывать явно |БРОМ: Посредники 22:26|
    {
  
        return view('pages.grib', [
            'grib' => $grib,
            'comments' => Comment::where('grib_id', $grib->id)->get(),
            'GribNames' => name::where('grib_id', $grib->id)->get(),
            'GribImage' => image::where('grib_id', $grib->id)->get(),
            'GribDescription' => description::where('grib_id', $grib->id)->get()
        ]);

        // $article = array_filter($this->articles, function ($item) use ($article) {
        //     // dd($article['id']);
        //     return $item['id'] === $article['id'];
        // });


        // $article = array_shift($article);
        // if (is_null($article)) {
        //     return abort(404);
        // }
        // return view('pages.article', [
        //     'title' => $article['title'],
        //     'body' => $article['body']
        // ]);
    }



    //     public function СhangeArticle()
    //     {
    //         return view('pages.article_change');
    //     }
    public function EditGribForm(grib $grib)
    {
        return view('pages.grib_edit', [
            'grib' => $grib
        ]);
    }
}
