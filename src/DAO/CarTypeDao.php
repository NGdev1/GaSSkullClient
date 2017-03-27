<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 02.03.17
 * Time: 8:47
 */

namespace DAO;


use Models\CarType;

interface CarTypeDao
{
    function save(CarType $carType);

    /**
     * @param $id
     * @return CarType
     */
    function getCarTypeById($id);

    /**
     * @return CarType[]
     */
    function getAll();
    function deleteCarTypeWithId($id);
    function updateCarType(CarType $carType);

    /**
     * @param $q
     * @return CarType[]
     */
    function getArrayBySearch($q);
}