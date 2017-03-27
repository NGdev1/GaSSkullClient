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

    /**
     * @param $id
     * @return Section
     */
    function getById($id);

    /**
     * @return Section[]
     */
    function getAll();
    function deleteWithId($id);
    function update(Section $section);

    /**
     * @param $q
     * @return Section[]
     */
    function getArrayBySearch($q);
}