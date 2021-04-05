<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuggestCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suggest_categories', function (Blueprint $table) {
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
        Schema::table('suggest_categories', function (Blueprint $table) {
            $table->dropForeign('suggest_categories_suggest_id_foreign');
            $table->dropForeign('suggest_categories_category_id_foreign');
        });

        Schema::dropIfExists('suggest_categories');
    }
}
