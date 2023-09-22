<?php

namespace App\Models;

use App\Models\Comment as ModelsComment;
// use Egulias\EmailValidator\Parser\Comment;
use Egulias\EmailValidator\Result\Reason\CommentsInIDRight;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['title', 'body', 'is_public', 'preview_image'];

    public function comments()
    {
        // dd($this->belongsTo(Article::class));
        // return Comment::where('article_id', $this->id)->get(); // старий способ
        return $this->hasMany(Comment::class);  //cм. "БРОМ: Eloquent - отношения" 17:30 и до конца
        // return $this->hasOne(Comment::class);  //там же 32:50 отобрать одну статью (так применять в главной таблице)
        // return $this->belongsToMany(Article::class);  //отобрать одну статью(так применять в подчиненной таблице)
        // return $this->belongsTo(Article::class);  //(так применять в подчиненной таблице)/працює через раз - перепровірити
    }
    // Eloquent - Аксессоры и мутаторы
    // устанавливаем первую большую букву
    // 1)традиционный способ(имена обязательно в "кемел"):
    // public function getTitleAttribute($value): string
    // {
    //     return ucfirst($value);
    // }

    // public function getBodiAttribute($value): string
    // {
    //     return ucfirst($value);
    // }
    // public function setTitleAttribute($value): void
    // {
    //     $this->attributes['title'] = ucfirst($value);
    // }

    // 2)    способ новее:
    // public function title(): Attribute
    // {
    //     return Attribute::make(
    //         get: function ($value) {
    //             return ucfirst($value);
    //         },
    //         set: function ($value) {
    //             return ucfirst($value);
    //         }
    //     );

    // 3)    способ еще новее(начиная с 9й версии):
    // https://laravel.com/docs/9.x/eloquent-mutators#main-content     Defining A Mutator
    public function title(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value),
            set: fn ($value) => ucfirst($value),
        );
    }
    // 1й способ преобразовывать тип (напр. возвращать 'is_public' в true/false):
    // public function isPublic(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => (bool) $value //возвращает 'is_public' true/false
    //     );
    // }
    // 2й способ преобразовывать тип (напр. возвращать 'is_public' в true/false):
    protected $casts = [
        'is_public' => 'boolean'
    ];
    // см там же: https://laravel.com/docs/9.x/eloquent-mutators#main-content     Attribute Casting
    public function IsPubic(): bool
    {
        return $this->is_public;
    }
}
