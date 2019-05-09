<?php


namespace App\Services;


use App\Models\User;
use RuntimeException;

class UserService
{
    /**
     * Инициализирует пользователя
     *
     * @param int $userId
     * @param string $name
     */
    public function initUser(int $userId, string $name)
    {
        if (!User::isExist($userId)) {
            $isInit = User::initUser($userId, $name);

            if (!$isInit) {
                throw new RuntimeException('User can`t be inited', 500);
            }
        }
    }
}