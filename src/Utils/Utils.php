<?php

namespace Utils;

class Utils{
    static function enableLogging(){
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }

    static function generatePassword($length)
    {
        $arr = array(
            '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'
        );
        // Генерируем пароль
        $pass = "";
        for ($i = 0; $i < $length; $i++) {
            // Вычисляем случайный индекс массива
            $index = rand(0, count($arr) - 1);
            $pass .= $arr[$index];
        }
        return $pass;
    }
}
