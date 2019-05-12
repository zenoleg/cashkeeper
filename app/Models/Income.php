<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $table = 'zen_incomes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'category_id',
        'value',
    ];

    /**
     * Добавляет пополнение
     *
     * @param int $userId
     * @param string $name
     * @param string $desc
     * @param string $category
     * @param float $value
     * @return bool
     */
    public static function add(int $userId, string $name, string $desc, string $category, float $value): bool
    {
        $income = new Income([
            'user_id' => $userId,
            'name' => $name,
            'description' => $desc,
            'category_id' => 1, //todo ID категории
            'value' => $value
        ]);

        return $income->save();
    }

}
