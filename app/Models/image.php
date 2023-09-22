<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    use HasFactory;
    protected $fillable = ['grib_id', 'priority', 'GribImage', 'GribImage_preview'];

    public function grib()
    {
        return $this->belongsTo(grib::class); //см. БРОМ: Eloquent - отношения 31:29
        // $this->belongsToMany()
        // return $this->hasOne(Article::class, 'id', 'article_id');
    }
}
