<?php


namespace App\Helpers\Keyboards;


use BotMan\Drivers\Telegram\Extensions\Keyboard;

abstract class AbstractKeyboard
{
    /** @var Keyboard */
    protected $keyboard;

    public function __construct()
    {
        $this->create();
    }

    abstract protected function create();

    public function toArray()
    {
        return $this->keyboard->toArray();
    }
}