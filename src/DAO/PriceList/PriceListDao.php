<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 28.02.17
 * Time: 12:49
 */

namespace DAO\PriceList;

use Models\PriceList\PriceListItem;

interface PriceListDao
{
    //price list
    function save(PriceListItem $item);
    function findById(Int $id);
    function update(PriceListItem $priceListItem);
    function deleteWithId(Int $id);
    function getAllServices();

    function getArrayBySearch(String $q);
}