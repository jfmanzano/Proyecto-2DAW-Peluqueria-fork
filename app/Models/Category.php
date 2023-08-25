<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use HasFactory;
    protected $fillable = ['nombre','color'];

    //Relación 1:N con Article
    public function articles(){
        return $this->hasMany(Article::class);
    }
}
