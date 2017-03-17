<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 19.01.17
 * Time: 17:01
 * в автошколе
 */

require_once '../../../bootstrap.php';

use DAO\Models\User;
use DAO\UserDaoImpl;
use Utils\FormDataCheck;
use Services\UserServicesImpl;
use Utils\Utils;

function showResult($id, $pin, $errors)
{
    $result = array(
        'id' => $id,
        'pin' => $pin,
        'errors' => $errors
    );

    echo json_encode($result);
}

$errors = array();
$carType = 0;
$name = '';
$carNumber = '';
$image = 'NULL';
$phoneNumber = '';
$deviceId = '';
$devicePlatform = '';
$deviceName = '';

$userDao = UserDaoImpl::getInstance();
$userService = UserServicesImpl::getInstance();

if (empty($_POST)) {
    $errors[] = "Нет параметров";

    showResult(0, 0, $errors);
    exit;
}

$errors[] = FormDataCheck::checkAllFields($carType,
    $name,
    $carNumber,
    $phoneNumber,
    $deviceId,
    $devicePlatform,
    $deviceName);

if (!empty($errors)) {
    showResult(0, 0, $errors);
    exit;
}

$userService->deleteUserWithDeviceId($deviceId);

$user = new User(
    //id:
    0,
    //pin:
    Utils::generatePassword(5),
    $carType,
    $deviceId,
    $devicePlatform,
    $deviceName,
    $phoneNumber,
    $image,
    $carNumber,
    $name,
    //registration date:
    date("Y-m-d"),
    //last activity:
    date("Y-m-d H:i:s")
);

$userDao->save($user);

$user = $userDao->selectUser(
    $user->getName(),
    $user->getCarNumber(),
    $user->getPin()
);

if($user->getId() == null){
    $errors[] = 'Не удалось получить Id, попробуйте снова.';
    showResult(0, 0, $errors);
    exit;
}

showResult($user->getId(), $user->getPin(), $errors);
exit;