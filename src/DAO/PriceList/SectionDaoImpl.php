<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 03.03.17
 * Time: 7:17
 */

namespace DAO\PriceList;

use Models\PriceList\Section;
use Utils\DbWrapper;

class SectionDaoImpl implements SectionDao
{
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new SectionDaoImpl();
        }

        return self::$instance;
    }

    private function getItemsFromResultSet($resultSet)
    {
        $sections = array();

        foreach ($resultSet as $value) {
            $sections[] = $this->getItemFromResultSet($value);
        }

        return $sections;
    }

    private function getItemFromResultSet($resultSet)
    {
        $section = new Section(
            $resultSet['id'],
            $resultSet['name']
        );

        return $section;
    }

    function save(Section $section)
    {
        $sql = 'INSERT INTO price_list_sections (name) VALUES (?);';
        $parameters = array(
            $section->getName()
        );
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($parameters);
    }

    function getById($id)
    {
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare("SELECT * FROM price_list_sections WHERE id=? LIMIT 1;");

        $parameters = array(
            $id
        );
        $stmt->execute($parameters);
        $resultSet = $stmt->fetch();
        return $this->getItemFromResultSet($resultSet);
    }

    /**
     * @return Section[]
     */
    function getAll()
    {
        $sql = 'SELECT * FROM price_list_sections;';
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $resultSet = $stmt->fetchAll();
        return $this->getItemsFromResultSet($resultSet);
    }

    function deleteWithId($id)
    {
        $sql = 'DELETE FROM price_list_sections WHERE id=?;';
        $parameters = array(
            $id
        );
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($parameters);
    }

    function update(Section $section)
    {
        $sql = 'UPDATE price_list_sections SET name=? WHERE id=?;';
        $parameters = array(
            $section->getName(),
            $section->getId()
        );
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($parameters);
    }

    function getArrayBySearch($q)
    {
        $sql = "SELECT * FROM price_list_sections WHERE name LIKE '%" . $q . "%';";
        $conn = DbWrapper::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();
        return $this->getItemsFromResultSet($result);
    }
}