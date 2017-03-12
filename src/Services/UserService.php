<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 17.02.17
 * Time: 6:57
 */
namespace Services;

interface UserService{
    function tryToLogin($login, $password);
    function deleteUserWithDeviceId($deviceId);
}