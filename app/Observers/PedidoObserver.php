<?php

namespace App\Observers;

use App\Models\Pedido;
use App\Models\User;

class PedidoObserver
{
    private function atualizarLTV(Pedido $pedido)
    {
        $ltv = Pedido::where('user_id', $pedido->user_id)
            ->whereNotIn('status', ['Cancelado', 'Pedido Cancelado'])
            ->sum('total');

        User::where('id', $pedido->user_id)->update(['ltv_total' => $ltv]);
    }

    public function saved(Pedido $pedido)
    {
        $this->atualizarLTV($pedido);
    }

    public function deleted(Pedido $pedido)
    {
        $this->atualizarLTV($pedido);
    }

    public function restored(Pedido $pedido)
    {
        $this->atualizarLTV($pedido);
    }
}