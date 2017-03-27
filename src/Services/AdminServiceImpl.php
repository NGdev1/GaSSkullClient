<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 27.03.17
 * Time: 6:53
 */

namespace Services;

use Factory\Factory;

class AdminServiceImpl implements AdminService
{
    private static $instance;
    private $adminDao;

    private function __construct()
    {
        $this->adminDao = Factory::getAdminDao();
    }

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new AdminServiceImpl();
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
     * returns 1 if password is incorrect
     * returns 2 if all right
     */
    function tryToLogin($login, $password)
    {
        if ($login == null || $password == null) return 0;
        if ($login == '') return 0;

        if($admin = $this->adminDao->findByName($login)){
            if($admin->getPassword() == $password){
                return 2;
            } else {
                return 1;
            }
        } else return 0;
    }
}