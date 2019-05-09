<?php

use App\Helpers\Keyboards\WelcomeKeyboard;
use App\Helpers\Util;
use App\Http\Controllers\BotManController;
use App\Services\UserService;
use BotMan\BotMan\BotMan;

$botman = resolve('botman');

$botman->hears('/start', function (BotMan $bot) {
    $welcomeKeyboard = new WelcomeKeyboard();
    $userInfo = Util::getUserInfo($bot);

    $userService = new UserService();
    try {
        $userService->initUser($userInfo['id'], $userInfo['name']);
    } catch (Exception $e) {
        $bot->reply($e->getMessage());
    }

    $bot->reply($bot->getUser()->getFirstName() . ' ' . $bot->getUser()->getLastName(), $welcomeKeyboard->toArray());
});

$botman->hears('Hi', function (BotMan $bot) {
    $bot->reply('Hello!');
});

$botman->hears('Start conversation', BotManController::class . '@startConversation');
