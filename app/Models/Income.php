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
     * @param string $category
     * @param float $value
     * @return bool
     */
    public static function add(int $userId, string $name, string $category, float $value): bool
    {
        $income = new Income([
            'user_id' => $userId,
            'name' => $name,
            'category_id' => 1, //todo ID категории
            'value' => $value
        ]);

        $isUserBalanceUpd = User::addBalance($userId, $value);

        return $income->save() && $isUserBalanceUpd;
    }
}
