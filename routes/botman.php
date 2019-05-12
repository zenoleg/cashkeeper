<?php

use App\Http\Controllers\BotManController;
use BotMan\BotMan\BotMan;

$botman = resolve('botman');

$botman->hears('/start', 'App\Http\Controllers\InitController@start');

$botman->hears('Hi', function (BotMan $bot) {
    $bot->reply('Hello!');
});

$botman->hears('.*Баланс.*', 'App\Http\Controllers\InitController@balance');

$botman->hears('Start conversation', BotManController::class . '@startConversation');
