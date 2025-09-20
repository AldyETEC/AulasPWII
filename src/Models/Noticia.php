<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $table = 'noticias';
    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'conteudo',
        'imagem_capa',
        'status',
        'autor_id',
        'categoria_id',
    ];

    protected $casts = [
        'data_publicacao' => 'datetime',
    ];

    public function autor()
    {
        return $this->belongsTo(Autor::class, 'autor_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}