<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 19.01.17
 * Time: 17:01
 * в автошколе
 */
include "../../temp/db.php";

$carType = $_POST['car_type'];
$year = $_POST['year'];
$deviceId = $_POST['device_id'];
$devicePlatform = $_POST['device_platform'];
$deviceName = $_POST['device_name'];
$phoneNumber = $_POST['phone_number'];
$carNumber = $_POST['car_number'];


$carTypeRegExp = "[1-7]{1}";
$yearRegExp = "[0-9]{4}";
$phoneNumberRegExp = "[0-9]{12}";
$carNumberRegExp = "[А-Я]{1}[0-9]{3}[А-Я]{2}[0-9]{2,3})";
$errors = array();

if(!preg_match($carTypeRegExp, $carType)) {
 $errors[] = "Неверный тип авто";
}
if(!preg_match($yearRegExp, $year)) {

}
if(!preg_match($phoneNumberRegExp, $phoneNumber)) {

}if(!preg_match($carNumberRegExp, $carNumber)) {

}
