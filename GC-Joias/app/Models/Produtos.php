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

    public function imagens()
    {
        return $this->hasMany(ImagemProdutos::class, 'produto_id', 'id');
    }

    public function imagemPrincipal()
    {
        return $this->hasOne(ImagemProdutos::class, 'produto_id', 'id')->where('principal', true);
    }
}
