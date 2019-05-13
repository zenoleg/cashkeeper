<?php


namespace App\Helpers\Keyboards;


use BotMan\Drivers\Telegram\Extensions\Keyboard;
use BotMan\Drivers\Telegram\Extensions\KeyboardButton;

class IncomeCategoryKeyboard extends AbstractKeyboard
{
    protected function create()
    {
        $this->keyboard = Keyboard::create()
            ->type(Keyboard::TYPE_KEYBOARD)
            ->oneTimeKeyboard(false)
            ->resizeKeyboard(true)
            ->addRow(KeyboardButton::create('Зарплата'), KeyboardButton::create('Подработка'))
            ->addRow(KeyboardButton::create('Подарок'), KeyboardButton::create('Долги'))
            ->addRow(KeyboardButton::create('<< Назад'), KeyboardButton::create('Выйти'));
    }
}