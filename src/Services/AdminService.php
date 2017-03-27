<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 27.03.17
 * Time: 6:48
 */

namespace Services;

interface AdminService
{
    function tryToLogin($login, $password);
}