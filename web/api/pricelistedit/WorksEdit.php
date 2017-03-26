<?php
/**
 * Created by PhpStorm.
 * User: Михаил
 * Date: 26.03.2017
 * Time: 20:17
 */

//Works Edit
require_once "../../../bootstrap.php";

use Factory\Factory;
use Models\PriceList\Work;

//\Utils\Utils::enableLogging();

$workDao = Factory::getWorkDao();

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
    $workName = $_POST['WorkName'];

    if (!isset($id) || !isset($workName)) {
        $errors[] = 'Нет параметров';
        showResult('error', $errors);
    }

    try {
        $work = new Work($id, $workName);

        $workDao->update($work);
    } catch (Exception $e) {
        showResult('error', [$e->getMessage()]);
    }

    showResult('ok', []);
} else if ($action == 'add') {
    $workName = $_POST['WorkName'];

    if (!isset($workName)) {
        $errors[] = 'Нет параметров';
        showResult('error', $errors);
    }

    $work = new Work(0, $workName);

    try {
        $workDao->save($work);
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
        $workDao->deleteWithId($id);
    } catch (Exception $e) {
        showResult('error', [$e->getMessage()]);
    }

    showResult('ok', []);
}