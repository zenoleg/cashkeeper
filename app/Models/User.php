<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'zen_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'balance',
    ];

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * Возвращает значение баланса пользователя
     *
     * @param int $userId
     * @return float
     * @throws Exception
     */
    public static function getBalance(int $userId): float
    {
        $userBalance = User::where('user_id', $userId)->value('balance');

        if ($userBalance === null) {
            throw new Exception('cant get balance', 500);
        }

        return $userBalance;
    }

    /**
     * Сохраняет нового пользователя
     *
     * @param int $userId
     * @param string $name
     * @return bool
     */
    public static function initUser(int $userId, string $name): bool
    {
        $user = new User([
            'user_id' => $userId,
            'name' => $name,
            'balance' => 0
        ]);

        return $user->save();
    }

    /**
     * Возвращает признак существования пользователя
     *
     * @param int $userId
     * @return bool
     */
    public static function isExist(int $userId): bool
    {
        $count = User::where('user_id', $userId)->count();

        return $count !== 0;
    }

    /**
     * Добавляет значение к текущему балансу
     *
     * @param int $userId
     * @param float $value
     * @return mixed
     */
    public static function addBalance(int $userId, float $value)
    {
        $currentBalance = User::where('user_id', $userId)->value('balance');
        $isUserBalanceUpd = User::where('user_id', $userId)->update(['balance' => $currentBalance + $value]);
        return $isUserBalanceUpd;
    }

}
