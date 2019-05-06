<?php

use App\Helpers\Keyboards\WelcomeKeyboard;
use App\Http\Controllers\BotManController;
use BotMan\BotMan\BotMan;

$botman = resolve('botman');

$botman->hears('/start', function (BotMan $bot) {
    $welcomeKeyboard = new WelcomeKeyboard();
    $bot->reply('Success init', $welcomeKeyboard->toArray());
});

$botman->hears('Hi', function (BotMan $bot) {
    $bot->reply('Hello!');
});

$botman->hears('Start conversation', BotManController::class . '@startConversation');
