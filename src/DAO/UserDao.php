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
    function findById(Int $id);
    function findByName(String $name);
    function update(User $user);
    function deleteWithId(Int $id);
    function deleteWithDeviceId(Int $deviceId);
    function selectUser($name, $carNimber, $pin);
    function getAllUsers();

    function getArrayBySearch(String $q);
}