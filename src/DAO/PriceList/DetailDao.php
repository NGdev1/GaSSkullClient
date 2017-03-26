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
    function getDetailById($id);
    function getAll();
    function deleteDetailWithId($id);
    function updateDetail(Detail $detail);

    function getArrayBySearch($q);
}