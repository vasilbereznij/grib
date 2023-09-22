<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class description extends Model
{
    use HasFactory;
    protected $fillable = ['grib_id', 'Language', 'Description'];

    public function grib()
    {
        return $this->belongsTo(grib::class); //см. БРОМ: Eloquent - отношения 31:29
    }
}
