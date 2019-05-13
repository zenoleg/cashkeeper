<?php


namespace App\Helpers\Keyboards;


use BotMan\Drivers\Telegram\Extensions\Keyboard;
use BotMan\Drivers\Telegram\Extensions\KeyboardButton;

class BackKeyboard extends AbstractKeyboard
{
    protected function create()
    {
        $this->keyboard = Keyboard::create()
            ->type(Keyboard::TYPE_KEYBOARD)
            ->oneTimeKeyboard(true)
            ->resizeKeyboard(true)
            ->addRow(KeyboardButton::create('<< Назад'), KeyboardButton::create('Выйти'));
    }
}