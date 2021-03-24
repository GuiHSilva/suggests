<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Suggest;
use App\Models\SuggestCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Suggest::factory(10)->create();

        Category::factory(10)->create();

        SuggestCategory::factory(10)->create();

    }
}
