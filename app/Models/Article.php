<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','descripcion','disponible','precio','imagen',
    'stock','category_id','marca_id'];
    
    //Relación 1:N con Marca
    public function marca(){
        return $this->belongsTo(Marca::class);
    }

    //Relación 1:N con Category
    public function category(){
        return $this->belongsTo(Category::class);
    }
    //Relación N:M con User (al ser N a M se utiliza belongsToMany)
    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    // public function image(): MorphOne
    // {
    //     return $this->morphOne(Image::class, 'imageable');
    // }
}
