<?php

namespace App\Conversations;

use App\Helpers\Keyboards\BackKeyboard;
use App\Helpers\Keyboards\IncomeCategoryKeyboard;
use App\Helpers\Keyboards\WelcomeKeyboard;
use App\Helpers\Util;
use App\Models\Income;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Conversations\Conversation;

class IncomeConversation extends Conversation
{
    /** @var BotMan */
    protected $bot;

    protected $category;
    protected $value;
    protected $name;

    public function __construct(BotMan $bot)
    {
        $this->bot = $bot;
    }

    /**
     * Запрос категории
     */
    public function askCategory()
    {
        $categoryKeyboard = new IncomeCategoryKeyboard();

        return $this->ask('Выберите категорию', function (Answer $answer) {
            $this->category = $answer->getText();
            $this->askValue();
        }, $categoryKeyboard->toArray());
    }

    /**
     * Запрос суммы
     */
    public function askValue()
    {
        $backKeyboard = new BackKeyboard();
        $welcomeKeyboard = new WelcomeKeyboard();

        return $this->ask('Введите сумму', function (Answer $answer) use ($welcomeKeyboard) {
            $this->value = $answer->getText();

            switch ($answer->getText()) {
                case '<< Назад':
                    {
                        $this->askCategory();
                        return true;
                    }
                case 'Выйти':
                    {
                        $this->say('Выход', $welcomeKeyboard->toArray());
                        return true;
                    }
                default:
                    $this->askDescription();
            }
        }, $backKeyboard->toArray());
    }

    /**
     * Запрос описания
     */
    public function askDescription()
    {
        $backKeyboard = new BackKeyboard();

        return $this->ask('Заполните описание', function (Answer $answer) {
            $this->name = $answer->getText();
            $welcomeKeyboard = new WelcomeKeyboard();

            switch ($answer->getText()) {
                case '<< Назад':
                    {
                        $this->askValue();
                        return true;
                    }
                case 'Выйти':
                    {
                        $this->say('Выход', $welcomeKeyboard->toArray());
                        return true;
                    }
            }

            $userInfo = Util::getUserInfo($this->bot);

            if (Income::add($userInfo['id'], $this->name, $this->category, $this->value)) {
                $this->say('Пополнение учтено 😉', $welcomeKeyboard->toArray());
            } else {
                $this->say('При добавлении транзакции произошла ошибка 😱', $welcomeKeyboard->toArray());
            }

        }, $backKeyboard->toArray());
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->askCategory();
    }
}
