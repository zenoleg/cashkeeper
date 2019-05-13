<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'zen_transactions';

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
     * Добавляет затраты
     *
     * @param int $userId
     * @param string $name
     * @param string $category
     * @param float $value
     * @return bool
     * @throws \Exception
     */
    public static function add(int $userId, string $name, string $category, float $value): bool
    {
        $transaction = new Transaction([
            'user_id' => $userId,
            'name' => $name,
            'category_id' => Category::getIdByName($category),
            'value' => $value
        ]);

        $isUserBalanceUpd = User::subBalance($userId, $value);

        return $transaction->save() && $isUserBalanceUpd;
    }

}
