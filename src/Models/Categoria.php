<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    public $timestamps = false;

    protected $fillable = [
        'nome_categoria',
    ];

    public function noticias()
    {
        return $this->hasMany(Noticia::class, 'categoria_id');
    }
}