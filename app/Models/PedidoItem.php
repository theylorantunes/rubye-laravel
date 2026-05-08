<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    protected $table = 'pedido_itens';

    protected $fillable = ['pedido_id', 'produto_id', 'quantidade', 'preco_unitario'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    // Liga o item ao Produto real (essa é a relação que estava faltando!)
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}