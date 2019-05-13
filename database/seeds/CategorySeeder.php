<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category([
            'name' => 'Зарплата'
        ]);

        $category->save();

        $category = new Category([
            'name' => 'Подработка'
        ]);

        $category->save();

        $category = new Category([
            'name' => 'Подарок'
        ]);

        $category->save();

        $category = new Category([
            'name' => 'Долги'
        ]);

        $category->save();
    }
}
