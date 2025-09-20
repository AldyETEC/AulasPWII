<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'autores';
    public $timestamps = false;

    protected $fillable = [
        'usuario_id',
        'bio',
        'imagem_perfil',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function noticias()
    {
        return $this->hasMany(Noticia::class, 'autor_id');
    }
}