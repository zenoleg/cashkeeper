<?php


namespace App\Helpers\Keyboards;


use BotMan\Drivers\Telegram\Extensions\Keyboard;
use BotMan\Drivers\Telegram\Extensions\KeyboardButton;

class TransactionCategoryKeyboard extends AbstractKeyboard
{
    protected function create()
    {
        $this->keyboard = Keyboard::create()
            ->type(Keyboard::TYPE_KEYBOARD)
            ->oneTimeKeyboard(false)
            ->resizeKeyboard(true)
            ->addRow(KeyboardButton::create('Супермаркеты'), KeyboardButton::create('Еда вне дома'))
            ->addRow(KeyboardButton::create('Переводы'), KeyboardButton::create('Медицина'))
            ->addRow(KeyboardButton::create('Одежда'), KeyboardButton::create('Автомобиль'))
            ->addRow(KeyboardButton::create('Красота'), KeyboardButton::create('Квартира'))
            ->addRow(KeyboardButton::create('Связь'), KeyboardButton::create('Сервисы'))
            ->addRow(KeyboardButton::create('<< Назад'), KeyboardButton::create('Выход'));
    }
}