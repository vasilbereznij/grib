<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;

class PagesController extends Controller
{

    public function hello()
    {
        // dd(\App\Models\Article::find(1));
        return view('pages.hello');
    }
    public function articles()
    {
        $articles = Article::where('is_public', true)
            ->orderBy('id', 'desc')
            ->get(); //отбор и запрос в БД 
        //get() выводит все записи/ first() - только первую найденную
        //"продвитнутый" вариант той же записи: вместо  "where('is_public', true)"   ->   "whereIsPublic(true)" 

        // $articles = Article::where('id', 1); //SQL-запрос без запроса в БД
        // dd($articles->toSql()); //показать SQL-запрос

        // $articles = Article::all(); // берем все записи
        // dd($articles);
        // dd($articles->toArray()); // преобразовать в массив
        return view('pages.articles', [
            // 'articles' => $this->articles //берем из массива выше
            'articles' => $articles //берем из первой строчки функции
            // 'articles' => Article::all() // берем напрямую все записи
        ]);
    }

    public function ShowArticle(Article $article) //тип ...(Article $... лучше указывать явно |БРОМ: Посредники 22:26|
    {
        // dd($article);
        // $articlItem = Article::whereIsPublic(true)
        //     ->get();

        return view('pages.article', [
            'article' => $article,
            // 'article' => $article['id']
            'comments' => Comment::where('article_id', $article->id)->get()
            // 'comments' => Comment::where('article_id', $article->id)->get()
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
    public function CreateArticleForm()
    {
        return view('pages.article_create');
    }
    public function СhangeArticle()
    {
        return view('pages.article_change');
    }
    public function ArticleForm(Article $article)
    {
        return view('pages.article_edit', [
            'article' => $article
        ]);
    }
}
