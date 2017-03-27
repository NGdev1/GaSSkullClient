<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 27.03.17
 * Time: 6:57
 */

namespace DAO;

use Models\Admin;
use Utils\DbWrapper;

class AdminDaoImpl implements AdminDao
{
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new AdminDaoImpl();
        }

        return self::$instance;
    }

    /**
     * @param $resultSet
     * @return Admin[]
     */
    private function getItemsFromResultSet($resultSet){
        $items = array();

        foreach ($resultSet as $item) {
            $items[] = $this->getItemFromResultSet($item);
        }

        return $items;
    }

    /**
     * @param $resultSet
     * @return Admin
     */
    private function getItemFromResultSet($resultSet)
    {
        $item = new Admin(
            $resultSet['id'],
            $resultSet['login'],
            $resultSet['password']
        );

        return $item;
    }

    function save(Admin $user)
    {
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare("INSERT INTO auto_service.admin (login, password) VALUES (?, ?);");

        $parameters = array(
            $user->getLogin(),
            $user->getPassword()
        );

        $stmt->execute($parameters);
    }

    /**
     * @param $id
     * @return Admin
     */
    function findById($id)
    {
        $sql = "SELECT * FROM admin WHERE id=?;";
        $parameters = array($id);

        $conn = DbWrapper::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute($parameters);
        $resultSet = $statement->fetch();

        return $this->getItemFromResultSet($resultSet);
    }

    /**
     * @param $name
     * @return Admin
     */
    function findByName($name)
    {
        $sql = "SELECT * FROM admin WHERE login=? LIMIT 1";
        $conn = DbWrapper::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute(array($name));
        $result = $statement->fetch();

        return $this->getItemFromResultSet($result);
    }

    function update(Admin $user)
    {
        $sql = "UPDATE admin SET login=?, password=? WHERE id=?;";
        $parameters = array(
            $user->getLogin(),
            $user->getPassword(),
            $user->getId()
        );

        $conn = DbWrapper::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute($parameters);
    }

    function deleteWithId($id)
    {
        $sql = "DELETE FROM admin WHERE id=?;";
        $parameters = array($id);

        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($parameters);
    }

    /**
     * @return Admin[]
     */
    function getAllAdmins()
    {
        $sql = "SELECT * FROM admin;";
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $resultSet = $stmt->fetchAll();

        return $this->getItemsFromResultSet($resultSet);
    }

    /**
     * @param $q
     * @return Admin[]
     */
    function getArrayBySearch($q)
    {
        $sql = "SELECT * FROM admin WHERE login LIKE '%" . $q . "%';";
        $conn = DbWrapper::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();
        return $this->getItemsFromResultSet($result);
    }
}