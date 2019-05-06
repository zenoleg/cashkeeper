<?php


namespace App\Helpers\Keyboards;


use BotMan\Drivers\Telegram\Extensions\Keyboard;
use BotMan\Drivers\Telegram\Extensions\KeyboardButton;

class WelcomeKeyboard extends AbstractKeyboard
{
    protected function create()
    {
        $this->keyboard = Keyboard::create()
            ->type(Keyboard::TYPE_KEYBOARD)
            ->resizeKeyboard(true)
            ->addRow(KeyboardButton::create('💼 Баланс'))
            ->addRow(KeyboardButton::create('📉 Затраты'), KeyboardButton::create('📈 Пополнение'))
            ->addRow(KeyboardButton::create('🗓️ Статистика'))
            ->addRow(KeyboardButton::create('🛠️ Настройки'));
    }
}