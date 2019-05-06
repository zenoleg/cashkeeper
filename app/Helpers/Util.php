<?php


namespace App\Helpers;


class Util
{
    /**
     * Пишет данные в лог
     *
     * @param string $message Данные для вывода
     * @param string $file Имя файла относительно DOCUMENT_ROOT (по-умолчанию log.txt)
     * @param boolean $backtrace Выводить ли информацию о том, откуда был вызван лог
     * @return void
     */
    public static function log($message, $file = '', $backtrace = false)
    {
        if (!$file) {
            $file = 'log.txt';
        }
        $file = $_SERVER['DOCUMENT_ROOT'] . "/" . $file;
        $text = date('Y-m-d H:i:s') . ' ';

        if (is_array($message)) {
            $text .= print_r($message, true);
        } else {
            $text .= $message;
        }

        $text .= "\n";
        if ($backtrace) {
            $backtrace = reset(debug_backtrace());
            $text = "Called in file: " . $backtrace["file"] . " in line: " . $backtrace["line"] . " \n" . $text;
        }
        if ($fh = fopen($file, 'a')) {
            fwrite($fh, $text);
            fclose($fh);
        }
    }
}