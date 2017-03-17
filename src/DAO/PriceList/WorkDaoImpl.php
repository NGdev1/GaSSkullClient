<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 03.03.17
 * Time: 7:08
 */

namespace DAO\PriceList;

use Models\PriceList\Work;
use Utils\DbWrapper;

class WorkDaoImpl implements WorkDao
{
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new WorkDaoImpl();
        }

        return self::$instance;
    }

    private function getItemsFromResultSet($resultSet)
    {
        $works = array();

        foreach ($resultSet as $value) {
            $works[] = $this->getItemFromResultSet($value);
        }

        return $works;
    }

    private function getItemFromResultSet($resultSet)
    {
        $work = new Work(
            $resultSet['id'],
            $resultSet['name']
        );

        return $work;
    }

    function save(Work $work)
    {
        $sql = 'INSERT INTO price_list_works (name) VALUE (?);';
        $parameters = array(
            $work->getName()
        );
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($parameters);
    }


    function getById($id)
    {
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare("SELECT * FROM price_list_works WHERE id=? LIMIT 1;");

        $parameters = array(
            $id
        );
        $stmt->execute($parameters);
        $resultSet = $stmt->fetch();
        return $this->getItemFromResultSet($resultSet);
    }

    function getAll()
    {
        $sql = 'SELECT * FROM price_list_works;';
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $resultSet = $stmt->fetchAll();
        return $this->getItemsFromResultSet($resultSet);
    }

    function deleteWithId($id)
    {
        $sql = 'DELETE FROM price_list_works WHERE id=?;';
        $parameters = array(
            $id
        );
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($parameters);
    }

    function update(Work $work)
    {
        $sql = 'UPDATE price_list_works SET name=? WHERE id=?;';
        $parameters = array(
            $work->getName(),
            $work->getId()
        );
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($parameters);
    }

    function getArrayBySearch($q)
    {
        $sql = "SELECT * FROM price_list_works WHERE name LIKE '%" . $q . "%';";
        $conn = DbWrapper::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();
        return $this->getItemsFromResultSet($result);
    }
}