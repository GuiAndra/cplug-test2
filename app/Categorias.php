<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table = 'categorias';

    protected $fillable = ['titulo'];

    public function noticias()
    {
        return $this->hasMany('App\Noticias', 'categoria_id');
    }
}
