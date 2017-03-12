<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 22.02.17
 * Time: 7:50
 */

namespace Utils;


class FormDataCheck
{
    private function __construct()
    {
    }

    static $carTypeRegExp = "/[1-7]{1}/";
    static $phoneNumberRegExp = "/\\+[0-9]{11}/";
    static $carNumberRegExp = "/[а-я0-9]+/i";

    public static function checkAllFields($carType,
                                          $userName,
                                          $carNumber,
                                          $phoneNumber,
                                          $deviceId,
                                          $devicePlatform,
                                          $deviceName){
        $errors = array();

        //--------Проверка $carType--------
        if(empty($carType)){
            $errors[] = "Тип авто не указан";
        } elseif (!preg_match(self::$carTypeRegExp, $carType)) {
            $errors[] = "Неверный тип авто";
        }

        //--------Проверка $userName--------
        if (empty($userName)) {
            $errors[] = 'Имя не указано';
        } elseif ($userName == '') {
            $errors[] = 'Пустое имя';
        }

        //--------Проверка $carNumber--------
        if (empty($carNumber)) {
            $errors[] = 'Номер авто не указан';
        } elseif (!preg_match(self::$carNumberRegExp, $carNumber)) {
            $errors[] = "Неверный номер авто";
        }

        //--------Проверка $phoneNumber--------
        if (empty($phoneNumber)) {
            $errors[] = 'Телефон не указан';
        } elseif (!preg_match(self::$phoneNumberRegExp, $phoneNumber)) {
            $errors[] = "Неверный номер телефона";
        }

        //--------Проверка $deviceId--------
        if (empty($deviceId)) {
            $errors[] = 'device_id не указано';
        } elseif ($deviceId == '') {
            $errors[] = 'Пустой device_id';
        }

        //--------Проверка $devicePlatform--------
        if (empty($devicePlatform)) {
            $errors[] = 'device_platform не указано';
            
        } elseif ($devicePlatform == '') {
            $errors[] = 'Пустой device_platform';
        }

        //--------Проверка $deviceName--------
        if (empty($deviceName)) {
            $errors[] = 'device_name не указано';
        } elseif ($deviceName == '') {
            $errors[] = 'Пустой device_name';
        }
        
        return $errors;
    }
}