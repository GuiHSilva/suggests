<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->string('name', 15)
                ->comment('NOME PRINCIPAL DA CATEGORIA');

            $table->text('description')
                ->nullable()
                ->comment('DESCRICAO DA CATEGORIA');

            $table->boolean('active')
                ->default(true)
                ->comment('ATIVO QUER DIZER QUE PODE SER USADO');

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
        Schema::dropIfExists('categories');
    }
}
