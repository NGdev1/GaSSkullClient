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

    /**
     * @param $id
     * @return Work
     */
    function getById($id);

    /**
     * @return Work[]
     */
    function getAll();
    function deleteWithId($id);
    function update(Work $work);

    /**
     * @param $q
     * @return Work[]
     */
    function getArrayBySearch($q);
}