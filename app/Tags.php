<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $table = 'tags';

    protected $fillable = ['titulo'];

    public function noticias()
    {
        return $this->hasMany('App\Tags_Noticias', 'tag_id');
    }
}
