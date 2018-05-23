<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagens extends Model
{
    protected $table = 'imagens';

    protected $fillable = ['noticia_id', 'url'];
}
