<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE produtos MODIFY imagem LONGTEXT');
        DB::statement('ALTER TABLE colecoes MODIFY imagem LONGTEXT');
    }

    public function down()
    {
        DB::statement('ALTER TABLE produtos MODIFY imagem VARCHAR(255)');
        DB::statement('ALTER TABLE colecoes MODIFY imagem VARCHAR(255)'); 
    }
};