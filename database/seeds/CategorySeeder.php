<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    protected $categories = [
        'Зарплата',
        'Подработка',
        'Подарок',
        'Долги',
        'Супермаркеты',
        'Еда вне дома',
        'Переводы',
        'Медицина',
        'Одежда',
        'Автомобиль',
        'Красота',
        'Квартира',
        'Связь',
        'Сервисы',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        foreach ($this->categories as $category) {
            $category = new Category([
                'name' => $category
            ]);

            $category->save();
        }

    }
}
