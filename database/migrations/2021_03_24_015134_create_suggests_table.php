<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuggestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suggests', function (Blueprint $table) {
            $table->id();

            $table->string('title')
                ->comment('TITULO DA SUGESTAO');

            $table->text('content')
                ->comment('CONTEUDO DA SUGESTAO');

            $table->integer('author')
                ->comment('ID DO AUTOR CASO ESTEJA AUTENTICADO');

            $table->integer('deleted_by')
                ->nullable()
                ->comment('ID DO USUÁRIO QUE APAGOU, CASO ESTEJA DELETADO');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suggests');
    }
}
