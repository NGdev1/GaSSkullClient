<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 02.03.17
 * Time: 9:50
 */

namespace DAO\PriceList;

use Models\PriceList\Detail;

interface DetailDao
{
    function save(Detail $detail);

    /**
     * @param $id
     * @return Detail
     */
    function getDetailById($id);

    /**
     * @return Detail[]
     */
    function getAll();
    function deleteDetailWithId($id);
    function updateDetail(Detail $detail);

    /**
     * @param $q
     * @return Detail[]
     */
    function getArrayBySearch($q);
}