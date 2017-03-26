<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 17.02.17
 * Time: 6:59
 */
namespace Services;

use Factory\Factory;

require_once "../../bootstrap.php";


class UserServicesImpl implements UserService
{
    private static $instance;
    private $userDao;

    private function __construct()
    {
        $this->userDao = Factory::getUserDao();
    }

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new UserServicesImpl();
        }

        return self::$instance;
    }

    /**
     * @param $login
     * user's id
     * @param $password
     * user's pin
     * @return int
     * returns 0 if login is incorrect
     * returns 1 if password is incorrest
     * returns 2 if all right
     */
    function tryToLogin($login, $password)
    {
        if ($login == null || $password == null) return 0;
        if ($login == '') return 0;

        if($user = $this->userDao->findByName($login)){
            if($user->getPin() == $password){
                return 2;
            } else {
                return 1;
            }
        } else return 0;
    }

    function deleteUserWithDeviceId($deviceId)
    {
        $this->userDao->deleteWithDeviceId($deviceId);
    }
}