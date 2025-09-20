<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    public $timestamps = false;

    protected $fillable = [
        'nome',
        'email',
        'senha',
        'nivel_acesso',
    ];

    protected $hidden = [
        'senha',
    ];

    public function autor()
    {
        return $this->hasOne(Autor::class, 'usuario_id');
    }
}