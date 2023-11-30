<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagemProdutos extends Model
{
    use HasFactory;

    protected $table = 'imagens_produtos';

    protected $fillable = [
        'produto_id',
        'nome',
        'principal'
    ];

    public function produto()
    {
        return $this->belongsTo(Produtos::class, 'produto_id', 'id');
    }
}
