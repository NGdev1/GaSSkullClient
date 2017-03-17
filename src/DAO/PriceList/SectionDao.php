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
    function getById($id);
    function getAll();
    function deleteWithId($id);
    function update(Section $section);

    function getArrayBySearch($q);
}