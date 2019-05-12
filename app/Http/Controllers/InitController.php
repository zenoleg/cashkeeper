<?php

namespace App\Http\Controllers;

use App\Helpers\Keyboards\WelcomeKeyboard;
use App\Helpers\Util;
use App\Models\User;
use App\Services\UserService;
use BotMan\BotMan\BotMan;
use Exception;

class InitController extends Controller
{
    /**
     * Инициализация пользователя
     *
     * @param BotMan $bot
     */
    public function start(BotMan $bot)
    {
        $welcomeKeyboard = new WelcomeKeyboard();
        $userInfo = Util::getUserInfo($bot);

        $userService = new UserService();

        if (!User::isExist($userInfo['id'])) {
            try {
                $userService->initUser($bot);
            } catch (Exception $e) {
                $bot->reply($e->getMessage());
            }

            $bot->reply(sprintf("Добро пожаловать,\n%s", $userInfo['name']), $welcomeKeyboard->toArray());
        }

        $bot->reply('', $welcomeKeyboard->toArray());
    }

    /**
     * Запрос баланса
     *
     * @param BotMan $bot
     */
    public function balance(BotMan $bot)
    {
        $userService = new UserService();

        try {
            $userBalance = $userService->getUserBalance($bot);
            $bot->reply(sprintf("Ваш баланс: %s", $userBalance));
        } catch (Exception $e) {
            $bot->reply($e->getMessage());
        }
    }
}
