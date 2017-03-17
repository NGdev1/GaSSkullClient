<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 08.02.17
 * Time: 9:13
 */

namespace DAO;

use DAO\Models\User;

interface UserDao
{
    function save(User $user);
    function findById($id);
    function findByName($name);
    function update(User $user);
    function deleteWithId($id);
    function deleteWithDeviceId($deviceId);
    function selectUser($name, $carNumber, $pin);
    function getAllUsers();

    function getArrayBySearch($q);
}