<?php

namespace App\Http\Controllers;

use App\Helpers\Keyboards\WelcomeKeyboard;
use App\Helpers\Util;
use App\Models\User;
use App\Services\UserService;
use BotMan\BotMan\BotMan;
use Exception;
use Illuminate\Http\Request;

class InitController extends Controller
{
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
}
