<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 02.03.17
 * Time: 8:54
 */

namespace DAO;


use Models\CarType;
use Utils\DbWrapper;

class CarTypeDaoImpl implements CarTypeDao
{
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new CarTypeDaoImpl();
        }

        return self::$instance;
    }

    private function getItemsFromResultSet($resultSet)
    {
        $carTypes = array();

        foreach ($resultSet as $value) {
            $carTypes[] = $this->getItemFromResultSet($value);
        }

        return $carTypes;
    }

    private function getItemFromResultSet($resultSet)
    {
        $carType = new CarType(
            $resultSet['id'],
            $resultSet['name']
        );

        return $carType;
    }

    function save(CarType $carType)
    {
        $sql = 'INSERT INTO car_type (id, name) VALUES (?,?);';
        $parameters = array(
            $carType->getId(),
            $carType->getName()
        );
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($parameters);
    }

    function getCarTypeById($id)
    {
        $sql = 'SELECT * FROM car_type WHERE id=? LIMIT 1;';
        $parameters = array(
            $id
        );
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($parameters);

        $resultSet = $stmt->fetch();
        return $this->getItemFromResultSet($resultSet);
    }

    function deleteCarTypeWithId($id)
    {
        $sql = 'DELETE FROM car_type WHERE id=?;';
        $parameters = array(
            $id
        );
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($parameters);
    }

    function updateCarType(CarType $carType)
    {
        $sql = 'UPDATE car_type SET name=? WHERE id=?;';
        $parameters = array(
            $carType->getName(),
            $carType->getId()
        );
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($parameters);
    }

    /**
     * @return CarType[]
     */
    function getAll()
    {
        $sql = 'SELECT * FROM car_type;';
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $resultSet = $stmt->fetchAll();
        return $this->getItemsFromResultSet($resultSet);
    }

    function getArrayBySearch($q)
    {
        $sql = "SELECT * FROM car_type WHERE name LIKE '%" . $q . "%';";
        $conn = DbWrapper::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();
        return $this->getItemsFromResultSet($result);
    }
}