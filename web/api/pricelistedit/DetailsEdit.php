<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 22.02.17
 * Time: 8:45
 */

//Detail Edit
require_once "../../../bootstrap.php";

use Factory\Factory;
use Models\PriceList\Detail;

//\Utils\Utils::enableLogging();

$detailDao = Factory::getDetailDao();

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
    $detailName = $_POST['DetailName'];

    if (!isset($id) || !isset($detailName)) {
        $errors[] = 'Нет параметров';
        showResult('error', $errors);
    }

    try {
        $detail = new Detail($id, $detailName);

        $detailDao->updateDetail($detail);
    } catch (Exception $e) {
        showResult('error', [$e->getMessage()]);
    }

    showResult('ok', []);
} else if ($action == 'add') {
    $detailName = $_POST['DetailName'];

    if (!isset($detailName)) {
        $errors[] = 'Нет параметров';
        showResult('error', $errors);
    }

    $detail = new Detail(0, $detailName);

    try {
        $detailDao->save($detail);
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
        $detailDao->deleteDetailWithId($id);
    } catch (Exception $e) {
        showResult('error', [$e->getMessage()]);
    }

    showResult('ok', []);
}