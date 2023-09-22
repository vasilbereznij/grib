<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['gribs_id', 'username', 'body'];

    public function grib()
    {
        return $this->belongsTo(grib::class); //см. БРОМ: Eloquent - отношения 31:29
        // $this->belongsToMany()
        // return $this->hasOne(Article::class, 'id', 'article_id');
    }
}
