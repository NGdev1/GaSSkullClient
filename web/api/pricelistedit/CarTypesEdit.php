<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 22.02.17
 * Time: 8:45
 */

//Car Types Edit
require_once "../../../bootstrap.php";

use Factory\Factory;
use Models\CarType;

$carTypesDao = Factory::getCarTypeDao();

function showResult($status, $errors)
{
    $result = array(
        'status' => $status,//ok | error
        'errors' => $errors//['ошибка1','ошибка2']
    );

    echo json_encode($result);
    exit;
}

$errors = [];
$action = $_POST['action'];
if (!isset($action)) {
    $errors[] = 'Нет параметров';
    showResult('error', $errors);
}

if ($action == 'edit') {
    $id = $_POST['id'];
    $carTypeName = $_POST['CarTypeName'];
    if (!(isset($id) && isset($carTypeName))) {
        $errors[] = 'Нет параметров';
        showResult('error', $errors);
    }

    try {
        $carType = new CarType($id, $carTypeName);

        $carTypesDao->updateCarType($carType);
    } catch (Exception $e) {
        showResult('error', [$e->getMessage()]);
    }

    showResult('ok', []);
} else if ($action == 'add') {
    $carTypeName = $_POST['CarTypeName'];

    if (!isset($carTypeName)) {
        $errors[] = 'Нет параметров';
        showResult('error', $errors);
    }

    $carType = new CarType(0, $carTypeName);

    try {
        $carTypesDao->save($carType);
    } catch (Exception $e) {
        showResult('error', [$e->getMessage()]);
    }

    showResult('ok', []);
} else if ($action == 'delete') {
    $id = $_POST['id'];
    if (!isset($id)) {
        $errors[] = 'Нет параметров';
        showResult('error', $errors);
    }

    try {
        $carTypesDao->deleteCarTypeWithId($id);
    } catch (Exception $e) {
        showResult('error', [$e->getMessage()]);
    }

    showResult('ok', []);
}

//{"id":"1","CarTypeName":"dog","action":"edit"}
//{"id":"10","action":"delete"}