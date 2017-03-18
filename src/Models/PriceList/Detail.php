<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 02.03.17
 * Time: 9:40
 */

namespace Models\PriceList;


class Detail
{
    private $id;
    private $idSection;
    private $name;

    /**
     * CarType constructor.
     * @param $id
     * @param $idSection
     * @param $name
     */
    public function __construct($id, $idSection, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->idSection = $idSection;
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
    public function getIdSection()
    {
        return $this->idSection;
    }

    /**
     * @param mixed $idSection
     */
    public function setIdSection($idSection)
    {
        $this->idSection = $idSection;
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