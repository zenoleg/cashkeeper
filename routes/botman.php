<?php

use App\Http\Controllers\BotManController;
use App\Http\Controllers\InitController;
use BotMan\BotMan\BotMan;

$botman = resolve('botman');

$botman->hears('/start', 'App\Http\Controllers\InitController@start');
$botman->hears('.*Баланс.*', InitController::class . '@balance');

$botman->hears('Hi', function (BotMan $bot) {
    $bot->reply('Hello!');
});

$botman->hears('Start conversation', BotManController::class . '@startConversation');
