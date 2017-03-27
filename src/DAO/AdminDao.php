<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 27.03.17
 * Time: 6:53
 */

namespace DAO;


use Models\Admin;

interface AdminDao
{
    function save(Admin $user);

    /**
     * @param $id
     * @return Admin
     */
    function findById($id);

    /**
     * @param $name
     * @return Admin
     */
    function findByName($name);
    function update(Admin $user);
    function deleteWithId($id);

    /**
     * @return Admin[]
     */
    function getAllAdmins();

    /**
     * @param $q
     * @return Admin[]
     */
    function getArrayBySearch($q);
}