<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 19.01.17
 * Time: 17:01
 * в автошколе
 */

//Эти строки позволяют выводить ошибки в браузере
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "../../db/db.php";
include "../../db/functions.php";
include "regular_expressions.php";
$errors = array();
$id = 0;
$pin = 0;
$carType = 0;
$name = '';
$carNumber = '';
$image = 'NULL';
$phoneNumber = '';
$deviceId = '';
$devicePlatform = '';
$deviceName = '';

function show_result($id, $pin, $errors)
{
    $result = array(
        'id' => $id,
        'pin' => $pin,
        'errors' => $errors
    );

    echo json_encode($result);
}

if (empty($_POST)) {
    $errors[] = "Нет параметров";

    show_result($id, $pin, $errors);
    exit;
}

if (!empty($_POST['car_type'])) {
    $carType = $_POST['car_type'];
    if (!preg_match($carTypeRegExp, $carType)) {
        $errors[] = "Неверный тип авто";
    }
} else {
    $errors[] = 'Тип авто не указан';
}


if (!empty($_POST['name'])) {
    $name = $_POST['name'];

    if ($name == '') {
        $errors[] = 'Пустое имя';
    }
} else {
    $errors[] = 'Имя не указано';
}


if (!empty($_POST['car_number'])) {
    $carNumber = $_POST['car_number'];

    if (!preg_match($carNumberRegExp, $carNumber)) {
        $errors[] = "Неверный номер авто";
    }
} else {
    $errors[] = 'Номер авто не указан';
}

if (!empty($_POST['phone_number'])) {
    $phoneNumber = $_POST['phone_number'];

    if (!preg_match($phoneNumberRegExp, $phoneNumber)) {
        $errors[] = "Неверный номер телефона";
    }
} else {
    $errors[] = 'Телефон не указан';
}

if (!empty($_POST['device_id'])) {
    $deviceId = $_POST['device_id'];

    if ($name == '') {
        $errors[] = 'Пустой device_id';
    }
} else {
    $errors[] = 'device_id не указано';
}

if (!empty($_POST['device_platform'])) {
    $devicePlatform = $_POST['device_platform'];

    if ($name == '') {
        $errors[] = 'Пустой device_platform';
    }
} else {
    $errors[] = 'device_platform не указано';
}

if (!empty($_POST['device_name'])) {
    $deviceName = $_POST['device_name'];

    if ($name == '') {
        $errors[] = 'Пустой device_name';
    }
} else {
    $errors[] = 'device_name не указано';
}

if (!empty($errors)) {
    show_result(0, 0, $errors);
    exit;
}

delete_user_with_device($deviceId, $errors);

if (!empty($errors)) {
    show_result(0, 0, $errors);
    exit;
}

if (!$stmt = $db->prepare("INSERT INTO auto_service.users 
(pin, device_id, device_platform, device_name, phone, id_car_type, image, car_number, name, registration_date, last_activity)
 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);")
) {
    $errors[] = "Не удалось подготовить запрос (" . $db->errno . ") " . $db->error;
    show_result(0, 0, $errors);
    exit;
}

$pin = generate_password(5);
$date = date("Y-m-d");
$dateTime = date("Y-m-d H:i:s");

if (!$stmt->bind_param(
    "sssssssssss",
    $pin,
    $deviceId,
    $devicePlatform,
    $deviceName,
    $phoneNumber,
    $carType,
    $image,
    $carNumber,
    $name,
    $date,
    $dateTime
)
) {
    $errors[] = "Не удалось привязать параметры (" . $stmt->errno . ") " . $stmt->error;
    show_result($id, $pin, $errors);
    exit;
}

if (!$stmt->execute()) {
    $errors[] = "Не удалось выполнить запрос (" . $db->errno . ") " . $db->error;
    show_result(0, 0, $errors);
    exit;
}

if (!$stmt = $db->prepare("SELECT * FROM auto_service.users WHERE 
name = ? AND car_number = ? AND pin = ?;")
) {
    $errors[] = "Не удалось подготовить запрос (" . $db->errno . ") " . $db->error;
    show_result(0, 0, $errors);
    exit;
}

if (!$stmt->bind_param(
    "sss",
    $name,
    $carNumber,
    $pin
)
) {
    $errors[] = "Не удалось привязать параметры (" . $stmt->errno . ") " . $stmt->error;
    show_result(0, 0, $errors);
    exit;
}

if (!$stmt->execute()) {
    $errors[] = "Не удалось выполнить запрос (" . $db->errno . ") " . $db->error;
    show_result(0, 0, $errors);
    exit;
}


if (!$result = $stmt->get_result()) {
    $errors = "Не удалось получить результат (" . $db->errno . ") " . $db->error;
    show_result(0, 0, $errors);
    exit;
}

$id = $result->fetch_assoc()['id'];
if($id == null){
    $id = 0;
    $pin = 0;
    $errors[] = 'Не удалось получить Id, попробуйте снова.';
}

show_result($id, $pin, $errors);
exit;