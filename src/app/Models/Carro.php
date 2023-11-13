<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;
    protected $fillable = ['cantidad','article_id','user_id'];
    //Relación 1:N con User
    public function user(){
        return $this->belongsTo(User::class);
    }
    //Relación 1:N con Artículo
    public function article(){
        return $this->belongsTo(Article::class);
    }
}
