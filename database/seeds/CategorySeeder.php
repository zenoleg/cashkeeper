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
        $category->setAttribute('name', 'Подработка');
        $category->save();

        $category->setAttribute('name', 'Подарок');
        $category->save();

        $category->setAttribute('name', 'Долги');
        $category->save();
    }
}
