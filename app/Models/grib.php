<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

// use App\Models\Comment as ModelsComment;
// // use Egulias\EmailValidator\Parser\Comment;
// use Egulias\EmailValidator\Result\Reason\CommentsInIDRight;
// use Illuminate\Database\Eloquent\SoftDeletes;

class grib extends Model
{
    use HasFactory;
    protected $fillable = ['categories_Type0', 'Type1', 'Type2', 'is_public'];

    public function GribNames()
    {
        // dd($this->belongsTo(grib::class));
        return $this->hasMany(name::class);
    }
    public function GribImage()
    {
        return $this->hasMany(image::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function description()
    {
        return $this->hasMany(description::class);
    }

    //преобразовывать тип: 'is_public' в true/false:
    protected $casts = [
        'is_public' => 'boolean'
    ];
    
    public function IsPubic(): bool
    {
        return $this->is_public;
    }
}
