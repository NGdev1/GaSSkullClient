<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 08.02.17
 * Time: 8:59
 */
namespace DAO\Models;

class User {
    private $id;
    private $pin;
    private $idCarType;
    private $devceId;
    private $devcePlatform;
    private $devceName;
    private $phone;
    private $image;
    private $carNumber;
    private $name;
    private $registrationDate;
    private $lastActivity;

    public function __construct($id, $pin, $idCarType, $devceId, $devcePlatform, $devceName, $phone, $image, $carNumber, $name, $registrationDate, $lastActivity)
    {
        $this->id = $id;
        $this->pin = $pin;
        $this->idCarType = $idCarType;
        $this->devceId = $devceId;
        $this->devcePlatform = $devcePlatform;
        $this->devceName = $devceName;
        $this->phone = $phone;
        $this->image = $image;
        $this->carNumber = $carNumber;
        $this->name = $name;
        $this->registrationDate = $registrationDate;
        $this->lastActivity = $lastActivity;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getPin()
    {
        return $this->pin;
    }

    public function setPin($pin)
    {
        $this->pin = $pin;
    }

    public function getIdCarType()
    {
        return $this->idCarType;
    }

    public function setIdCarType($idCarType)
    {
        $this->idCarType = $idCarType;
    }

    public function getDevceId()
    {
        return $this->devceId;
    }

    public function setDevceId($devceId)
    {
        $this->devceId = $devceId;
    }

    public function getDevcePlatform()
    {
        return $this->devcePlatform;
    }

    public function setDevcePlatform($devcePlatform)
    {
        $this->devcePlatform = $devcePlatform;
    }

    public function getDevceName()
    {
        return $this->devceName;
    }

    public function setDevceName($devceName)
    {
        $this->devceName = $devceName;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getCarNumber()
    {
        return $this->carNumber;
    }

    public function setCarNumber($carNumber)
    {
        $this->carNumber = $carNumber;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate($registrationDate)
    {
        $this->registrationDate = $registrationDate;
    }

    public function getLastActivity()
    {
        return $this->lastActivity;
    }

    public function setLastActivity($lastActivity)
    {
        $this->lastActivity = $lastActivity;
    }
}