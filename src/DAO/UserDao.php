<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 08.02.17
 * Time: 9:13
 */

namespace DAO;

use Models\User;

interface UserDao
{
    function save(User $user);

    /**
     * @param $id
     * @return User
     */
    function findById($id);

    /**
     * @param $name
     * @return User
     */
    function findByName($name);
    function update(User $user);
    function deleteWithId($id);
    function deleteWithDeviceId($deviceId);

    /**
     * @param $name
     * @param $carNumber
     * @param $pin
     * @return User
     */
    function selectUser($name, $carNumber, $pin);

    /**
     * @return User[]
     */
    function getAllUsers();

    /**
     * @param $q
     * @return User[]
     */
    function getArrayBySearch($q);
}