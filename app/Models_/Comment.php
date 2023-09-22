<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['article_id', 'username', 'body', 'preview_image'];

    public function article()
    {
        return $this->belongsTo(Article::class); //см. БРОМ: Eloquent - отношения 31:29
        // $this->belongsToMany()
        // return $this->hasOne(Article::class, 'id', 'article_id');
    }
}
