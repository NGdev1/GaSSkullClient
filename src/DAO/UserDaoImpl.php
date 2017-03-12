<?php

/**
 * Created by PhpStorm.
 * User: apple
 * Date: 08.02.17
 * Time: 8:55
 */

namespace DAO;

use DAO\Models\User;
use Utils\DbWrapper;

class UserDaoImpl implements UserDao
{
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance(){
       if(self::$instance == null){
           self::$instance = new UserDaoImpl();
       }

       return self::$instance;
    }

    private function getUsersFromResultSet($resultSet){
        $users = array();

        foreach ($resultSet as $item) {
            $users[] = $this->getUserFromResultSet($item);
        }

        return $users;
    }

    private function getUserFromResultSet($resultSet)
    {
        $user = new User(
            $resultSet['id'],
            $resultSet['pin'],
            $resultSet['id_car_type'],
            $resultSet['device_id'],
            $resultSet['device_platform'],
            $resultSet['device_name'],
            $resultSet['phone'],
            $resultSet['image'],
            $resultSet['car_number'],
            $resultSet['name'],
            $resultSet['registration_date'],
            $resultSet['last_activity']
        );

        return $user;
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM users;";
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $resultSet = $stmt->fetchAll();

        return $this->getUsersFromResultSet($resultSet);
    }

    public function save(User $user)
    {
        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare("INSERT INTO auto_service.users
(pin, device_id, device_platform, device_name, phone, id_car_type, image, car_number, name, registration_date, last_activity)
 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");

        $parameters = array(
            $user->getPin(),
            $user->getDevceId(),
            $user->getDevcePlatform(),
            $user->getDevceName(),
            $user->getPhone(),
            $user->getIdCarType(),
            $user->getImage(),
            $user->getCarNumber(),
            $user->getName(),
            $user->getRegistrationDate(),
            $user->getLastActivity()
        );

        $stmt->execute($parameters);
    }

    public function findById(Int $id)
    {
        $sql = "SELECT * FROM users WHERE id=?;";
        $parameters = array($id);

        $conn = DbWrapper::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute($parameters);
        $resultSet = $statement->fetch();

        return $this->getUserFromResultSet($resultSet);
    }

    public function findByName(String $name)
    {
        $sql = "SELECT * FROM users WHERE name=? LIMIT 1";
        $conn = DbWrapper::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute(array($name));
        $result = $statement->fetch();

        return $this->getUserFromResultSet($result);
    }

    public function update(User $user)
    {
        $sql = "UPDATE users SET  pin=?, 
                                  id_car_type=?,
                                  device_id=?,
                                  device_platform=?,
                                  device_name=?,
                                  phone=?,
                                  image=?,
                                  car_number=?,
                                  name=?,
                                  registration_date=?,
                                  last_activity=?
                  WHERE id=?;";
        $parameters = array(
            $user->getPin(),
            $user->getIdCarType(),
            $user->getDevceId(),
            $user->getDevcePlatform(),
            $user->getDevceName(),
            $user->getPhone(),
            $user->getImage(),
            $user->getCarNumber(),
            $user->getName(),
            $user->getRegistrationDate(),
            $user->getLastActivity(),
            $user->getId()
        );

        $conn = DbWrapper::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute($parameters);
    }

    public function deleteWithId(Int $id)
    {
        $sql = "DELETE FROM users WHERE id=?;";
        $parameters = array($id);

        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($parameters);
    }

    public function deleteWithDeviceId(Int $deviceId)
    {
        $sql = "DELETE FROM users WHERE device_id=?;";
        $parameters = array($deviceId);

        $conn = DbWrapper::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($parameters);
    }

    function selectUser($name, $carNumber, $pin)
    {
        $conn = DbWrapper::getConnection();
        $statement = $conn->prepare("SELECT * FROM auto_service.users WHERE 
name = ? AND car_number = ? AND pin = ?;");
        $parameters = array(
            $name,
            $carNumber,
            $pin
        );
        $statement->execute($parameters);
        $resultSet = $statement->fetch();

        return $this->getUserFromResultSet($resultSet);
    }

    function getArrayBySearch(String $q)
    {
        $sql = "SELECT * FROM users WHERE name LIKE '%" . $q . "%' OR car_number LIKE '%" . $q . "%';";
        $conn = DbWrapper::getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();
        return $this->getUsersFromResultSet($result);
    }
}

