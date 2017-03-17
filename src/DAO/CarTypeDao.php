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
    function getCarTypeById($id);
    function getAll();
    function deleteCarTypeWithId($id);
    function updateCarType(CarType $carType);

    function getArrayBySearch($q);
}