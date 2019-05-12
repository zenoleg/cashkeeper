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

        if (!User::isExist($userId)) {
            $isInit = User::initUser($userId, $userName);

            if (!$isInit) {
                throw new Exception('User can`t be inited', 500);
            }
        }
    }
}