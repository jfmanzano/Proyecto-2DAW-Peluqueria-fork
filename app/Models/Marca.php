<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Marca extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','descripcion','imagen'];

    //Relación 1:N con Article
    public function articles(){
        return $this->hasMany(Article::class);
    }
    // public function image(): MorphOne
    // {
    //     return $this->morphOne(Image::class, 'imageable');
    // }
}
