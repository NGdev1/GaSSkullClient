<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 28.02.17
 * Time: 13:35
 */

namespace DAO\PriceList;

use Models\PriceList\PriceListItem;
use Utils\DbWrapper;

class PriceListDaoImpl implements PriceListDao
{
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new PriceListDaoImpl();
        }

        return self::$instance;
    }

    private function getItemsFromResultSet($resultSet){
        $priceList = array();

        foreach ($resultSet as $value){
            $priceList[] = $this->getItemFromResultSet($value);
        }

        return $priceList;
    }

    private function getItemFromResultSet($resultSet){
        $priceListItem = new PriceListItem(
            $resultSet['id'],
            $resultSet['price'],
            $resultSet['id_car_type'],
            $resultSet['id_section'],
            $resultSet['id_work'],
            $resultSet['id_detail']
        );

        return $priceListItem;
    }

    function save(PriceListItem $item)
    {
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare("INSERT INTO price_list (id_car_type, id_work, price, id_section, id_detail) VALUES (?,?,?,?,?);");

        $parameters = array(
            $item->getIdCarType(),
            $item->getIdWork(),
            $item->getPrice(),
            $item->getIdSection(),
            $item->getIdDetail()
        );

        $stmt->execute($parameters);
    }

    /**
     * @param int $id
     * @return PriceListItem
     */
    function findById($id)
    {
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare("SELECT * FROM price_list WHERE id=? LIMIT 1;");

        $parameters = array(
          $id
        );
        $stmt->execute($parameters);
        $resultSet = $stmt->fetch();
        return $this->getItemFromResultSet($resultSet);
    }

    function update(PriceListItem $priceListItem)
    {
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare("UPDATE price_list SET id_car_type=?, id_work=?, id_section=?, price=?, id_detail=? WHERE id=?;");

        $parameters = array(
            $priceListItem->getIdCarType(),
            $priceListItem->getIdWork(),
            $priceListItem->getIdSection(),
            $priceListItem->getPrice(),
            $priceListItem->getIdDetail(),
            $priceListItem->getId()
        );
        $stmt->execute($parameters);
    }

    function deleteWithId($id)
    {
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare("DELETE FROM price_list WHERE id=?;");

        $parameters = array(
            $id
        );
        $stmt->execute($parameters);
    }

    /**
     * @return PriceListItem[]
     */
    function getAllServices()
    {
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare("SELECT * FROM price_list;");
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