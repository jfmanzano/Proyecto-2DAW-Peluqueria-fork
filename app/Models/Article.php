<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','descripcion','disponible','precio','imagen','category_id','marca_id'];
    
    public function marca(){
        return $this->belongsTo(Marca::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
    //Relación N:M con Users
    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    // public function image(): MorphOne
    // {
    //     return $this->morphOne(Image::class, 'imageable');
    // }
}
