<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    use HasFactory;

    protected $fillable = [
        'genero_id',
        'categoria_id',
        'nome',
        'quantidade',
        'custo',
        'preco'
    ];
}
