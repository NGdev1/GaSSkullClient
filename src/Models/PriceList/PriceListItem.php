<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 28.02.17
 * Time: 11:27
 */

namespace Models\PriceList;


class PriceListItem
{
    private $id;
    private $price;
    private $idCarType;
    private $idSection;
    private $idWork;
    private $idDetail;

    public function __construct($id, $price, $idCarType, $idSection, $idWork, $idDetail)
    {
        $this->id = $id;
        $this->price = $price;
        $this->idCarType = $idCarType;
        $this->idSection = $idSection;
        $this->idWork = $idWork;
        $this->idDetail = $idDetail;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getIdCarType()
    {
        return $this->idCarType;
    }

    public function setIdCarType($idCarType)
    {
        $this->idCarType = $idCarType;
    }

    /**
     * @return int
     */
    public function getIdSection()
    {
        return $this->idSection;
    }

    public function setIdSection($idSection)
    {
        $this->idSection = $idSection;
    }

    /**
     * @return int
     */
    public function getIdWork()
    {
        return $this->idWork;
    }

    public function setIdWork($idWork)
    {
        $this->idWork = $idWork;
    }

    /**
     * @return int
     */
    public function getIdDetail()
    {
        return $this->idDetail;
    }

    public function setIdDetail($idDetail)
    {
        $this->idDetail = $idDetail;
    }
}