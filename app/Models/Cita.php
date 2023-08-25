<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;
    protected $fillable = ['fecha','tipo','user_id'];

    //Relación 1:N con User
    public function user(){
        return $this->belongsTo(User::class);
    }
}
