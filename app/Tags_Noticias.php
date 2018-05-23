<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags_Noticias extends Model
{
    protected $table = 'tags__noticias';

    protected $fillable = ['tag_id', 'noticia_id'];

    public function noticia()
    {
        return $this->belongsTo('App\Noticias', 'noticia_id');
    }

    public function tag()
    {
        return $this->belongsTo('App\Tags', 'tag_id');
    }
}
