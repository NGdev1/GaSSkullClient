<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 03.03.17
 * Time: 7:15
 */

namespace DAO\PriceList;

use Models\PriceList\Section;

interface SectionDao
{
    function save(Section $section);
    function getById(Int $id);
    function getAll();
    function deleteWithId(Int $id);
    function update(Section $section);

    function getArrayBySearch(String $q);
}