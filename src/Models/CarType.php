<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 01.03.17
 * Time: 12:05
 */

namespace Models;


class CarType
{
    private $id;
    private $name;

    /**
     * CarType constructor.
     * @param $id
     * @param $name
     */
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    function __toString()
    {
        return '"'. $this->getId() . '":"' . $this->getName() . '"';
    }
}