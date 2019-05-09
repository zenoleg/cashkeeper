<?php

namespace App\Models;

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
     */
    public function getBalanceValue(int $userId): float
    {
        $data = User::where('user_id', $userId)->get();
        print_r($data);
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

}
