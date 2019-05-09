<?php


namespace App\Services;


use App\Models\User;

class UserService
{
    /**
     * Инициализирует пользователя
     *
     * @param int $userId
     * @param string $name
     * @throws \Exception
     */
    public function initUser(int $userId, string $name)
    {
        if (!User::isExist($userId)) {
            $isInit = User::initUser($userId, $name);

            if (!$isInit) {
                throw new \Exception('User can`t be inited', 500);
            }
        }
    }
}