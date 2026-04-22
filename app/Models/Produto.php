<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['nome', 'descricao', 'preco', 'estoque', 'categoria_id', 'imagem'];

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    public function imagens() {
        return $this->hasMany(ProdutoImagem::class);
    }

    public function colecoes() {
        return $this->belongsToMany(Colecao::class, 'produto_colecao');
    }
}