<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 03.03.17
 * Time: 7:06
 */

namespace DAO\PriceList;

use Models\PriceList\Work;

interface WorkDao
{
    function save(Work $work);
    function getById(Int $id);
    function getAll();
    function deleteWithId(Int $id);
    function update(Work $work);

    function getArrayBySearch(String $q);
}