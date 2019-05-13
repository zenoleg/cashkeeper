<?php

namespace App\Conversations;

use App\Helpers\Keyboards\BackKeyboard;
use App\Helpers\Keyboards\TransactionCategoryKeyboard;
use App\Helpers\Keyboards\WelcomeKeyboard;
use App\Helpers\Util;
use App\Models\Transaction;
use App\Services\UserService;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Conversations\Conversation;

class TransactionConversation extends Conversation
{
    /** @var BotMan */
    protected $bot;
    protected $userInfo;

    protected $category;
    protected $value;
    protected $name;

    protected $backKeyboard;
    protected $welcomeKeyboard;
    protected $categoryKeyboard;

    public function __construct(BotMan $bot)
    {
        $this->bot = $bot;
        $this->userInfo = Util::getUserInfo($bot);
        $this->backKeyboard = new BackKeyboard();
        $this->welcomeKeyboard = new WelcomeKeyboard();
        $this->categoryKeyboard = new TransactionCategoryKeyboard();
    }

    /**
     * Запрос категории
     */
    public function askCategory()
    {
        return $this->ask('Выберите категорию', function (Answer $answer) {
            $this->category = $answer->getText();

            switch ($answer->getText()) {
                case '<< Назад':
                    {
                        $this->say('Выход', $this->welcomeKeyboard->toArray());
                        return true;
                    }
                case 'Выйти':
                    {
                        $this->say('Выход', $this->welcomeKeyboard->toArray());
                        return true;
                    }
                default:
                    $this->askValue();
            }
        }, $this->categoryKeyboard->toArray());
    }

    /**
     * Запрос суммы
     */
    public function askValue()
    {
        return $this->ask('Введите сумму', function (Answer $answer) {
            $this->value = $answer->getText();

            switch ($answer->getText()) {
                case '<< Назад':
                    {
                        $this->askCategory();
                        return true;
                    }
                case 'Выйти':
                    {
                        $this->say('Выход', $this->welcomeKeyboard->toArray());
                        return true;
                    }
                default:
                    $this->askName();
            }
        }, $this->backKeyboard->toArray());
    }

    /**
     * Запрос описания
     */
    public function askName()
    {
        return $this->ask('Заполните описание', function (Answer $answer) {
            $this->name = $answer->getText();

            switch ($answer->getText()) {
                case '<< Назад':
                    {
                        $this->askValue();
                        return true;
                    }
                case 'Выйти':
                    {
                        $this->say('Выход', $this->welcomeKeyboard->toArray());
                        return true;
                    }
            }

            if (Transaction::add($this->userInfo['id'], $this->name, $this->category, $this->value)) {
                $this->say('Затраты учтены 😉', $this->welcomeKeyboard->toArray());

                $userService = new UserService();
                $balance = $userService->getUserBalance($this->bot);
                $this->say(sprintf("Текущий баланс: %s", $balance), $this->welcomeKeyboard->toArray());
            } else {
                $this->say('При добавлении транзакции произошла ошибка 😱', $this->welcomeKeyboard->toArray());
            }

        }, $this->backKeyboard->toArray());
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->askCategory();
    }
}
