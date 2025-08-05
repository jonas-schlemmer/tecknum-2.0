<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    protected $fillable = [
        'titulo',
        'descricao',
        'diretor',
        'genero',
        'ano',
        'duracao',
        'nota',
    ];
}
