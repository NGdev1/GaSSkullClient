<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 03.03.17
 * Time: 6:59
 */

namespace DAO\PriceList;

use Models\PriceList\Detail;
use Utils\DbWrapper;

class DetailDaoImpl implements DetailDao
{
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new DetailDaoImpl();
        }

        return self::$instance;
    }

    private function getItemsFromResultSet($resultSet)
    {
        $details = array();

        foreach ($resultSet as $value) {
            $details[] = $this->getItemFromResultSet($value);
        }

        return $details;
    }

    private function getItemFromResultSet($resultSet)
    {
        $detail = new Detail(
            $resultSet['id'],
            $resultSet['name']
        );

        return $detail;
    }

    function save(Detail $detail)
    {
        $sql = 'INSERT INTO price_list_details (id, name) VALUES (?,?);';
        $parameters = array(
            $detail->getId(),
            $detail->getName()
        );
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($parameters);
    }

    function getDetailById(Int $id)
    {
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare("SELECT * FROM price_list_details WHERE id=? LIMIT 1;");

        $parameters = array(
            $id
        );
        $stmt->execute($parameters);
        $resultSet = $stmt->fetch();
        return $this->getItemFromResultSet($resultSet);
    }

    function getAll()
    {
        $sql = 'SELECT * FROM price_list_details;';
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $resultSet = $stmt->fetchAll();
        return $this->getItemsFromResultSet($resultSet);
    }

    function deleteDetailWithId(Int $id)
    {
        $sql = 'DELETE FROM price_list_details WHERE id=?;';
        $parameters = array(
            $id
        );
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($parameters);
    }

    function updateDetail(Detail $detail)
    {
        $sql = 'UPDATE price_list_details SET name=? WHERE id=?;';
        $parameters = array(
            $detail->getName(),
            $detail->getId()
        );
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($parameters);
    }

    function getArrayBySearch(String $q)
    {
        $sql = "SELECT * FROM price_list_details WHERE name LIKE '%" . $q . "%';";
        $conn = DbWrapper::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();
        return $this->getItemsFromResultSet($result);
    }
}