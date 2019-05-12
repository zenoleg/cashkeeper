<?php

namespace App\Conversations;

use App\Helpers\Keyboards\BackKeyboard;
use App\Helpers\Keyboards\CategoryKeyboard;
use App\Helpers\Keyboards\EmptyKeyboard;
use App\Helpers\Keyboards\WelcomeKeyboard;
use App\Helpers\Util;
use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class IncomeConversation extends Conversation
{
    protected $category;
    protected $value;

    /**
     * First question
     */
    public function askReason()
    {
        $categoryKeyboard = new CategoryKeyboard();

        return $this->ask('Выберите категорию', function (Answer $answer) {
            $this->category = $answer->getText();
            $this->askReason2();
        }, $categoryKeyboard->toArray());
    }

    /**
     * Second question
     */
    public function askReason2()
    {
        $backKeyboard = new BackKeyboard();
        $welcomeKeyboard = new WelcomeKeyboard();

        return $this->ask('Введите сумму', function (Answer $answer) use ($welcomeKeyboard) {
            $this->value = $answer->getText();

            switch ($answer->getText()) {
                case '<< Назад':
                    {
                        $this->askReason();
                        return true;
                    }
                case 'Выйти':
                    {
                        $this->say('Выход', $welcomeKeyboard->toArray());
                        return true;
                    }
            }

            $this->say($this->category . ' | ' . $this->value, $welcomeKeyboard->toArray());
        }, $backKeyboard->toArray());
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->askReason();
    }
}
