<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {

        DB::statement("ALTER TABLE pedidos MODIFY COLUMN status ENUM(
            'Aguardando', 
            'Confirmado', 
            'Preparando', 
            'Enviado', 
            'Entregue', 
            'Cancelado', 
            'Pedido Recebido', 
            'Pagamento em Análise', 
            'Pagamento Confirmado', 
            'Em Separação', 
            'Em rota de entrega', 
            'Pedido Cancelado'
        ) NOT NULL DEFAULT 'Aguardando'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE pedidos MODIFY COLUMN status ENUM(
            'Pedido Recebido', 
            'Pagamento em Análise', 
            'Pagamento Confirmado', 
            'Em Separação', 
            'Enviado', 
            'Em rota de entrega', 
            'Entregue', 
            'Pedido Cancelado'
        ) NOT NULL DEFAULT 'Pedido Recebido'");
    }
};