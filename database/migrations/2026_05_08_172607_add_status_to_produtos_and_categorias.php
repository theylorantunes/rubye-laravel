<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasColumn('produtos', 'ativo')) {
            Schema::table('produtos', function (Blueprint $table) {
                $table->boolean('ativo')->default(true)->after('imagem');
            });
        }

        if (!Schema::hasColumn('categorias', 'ativo')) {
            Schema::table('categorias', function (Blueprint $table) {
                $table->boolean('ativo')->default(true)->after('nome');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produtos_and_categorias', function (Blueprint $table) {
            //
        });
    }
};
