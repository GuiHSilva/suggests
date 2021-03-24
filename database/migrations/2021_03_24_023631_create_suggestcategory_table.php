<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuggestcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suggestcategory', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('suggest_id');

            $table->unsignedInteger('category_id');

            $table->timestamps();

            // RELACIONAMENTOS

            $table->foreign('suggest_id')
                ->references('id')
                ->on('suggests');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sugest_categories');
    }
}
