<?php


namespace App\Services;


use App\Helpers\Util;
use App\Models\User;
use BotMan\BotMan\BotMan;
use Exception;

class UserService
{
    /**
     * Инициализирует пользователя
     *
     * @param BotMan $bot
     * @throws Exception
     */
    public function initUser(BotMan $bot)
    {
        $userInfo = Util::getUserInfo($bot);
        $userId = $userInfo['id'];
        $userName = $userInfo['name'];

        if (!User::initUser($userId, $userName)) {
            throw new Exception('User cant be registered', 500);
        }
    }

    /**
     * Возвращает баланс пользователя
     *
     * @param BotMan $bot
     * @return string
     * @throws Exception
     */
    public function getUserBalance(BotMan $bot): string
    {
        $userInfo = Util::getUserInfo($bot);
        $balance = User::getBalance($userInfo['id']);

        return Util::formatValue($balance);
    }
}