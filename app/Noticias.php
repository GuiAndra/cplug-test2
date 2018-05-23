<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticias extends Model
{
    protected $table = 'noticias';

    protected $fillable = ['titulo', 'descricao', 'categoria_id'];

    public function categoria()
    {
        return $this->belongsTo('App\Categorias', 'categoria_id');
    }

    public function tags()
    {
        return $this->hasMany('App\Tags_Noticias', 'noticia_id');
    }

    public function imagens()
    {
        return $this->hasMany('App\Imagens', 'noticia_id');
    }
}
