<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 27.03.17
 * Time: 6:49
 */

namespace Models;


class Admin
{
    private $id;
    private $login;
    private $password;

    /**
     * UserPlain constructor.
     * @param $id
     * @param $login
     * @param $password
     */
    public function __construct($id, $login, $password)
    {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}