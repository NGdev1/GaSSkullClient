<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 22.02.17
 * Time: 8:45
 */

//Sections Edit
require_once "../../../bootstrap.php";

//\Utils\Utils::enableLogging();

use Factory\Factory;
use Models\PriceList\Section;

$sectionDao = Factory::getSectionDao();

function showResult($status, $errors)
{
    $result = array(
        'status' => $status,//ok | error
        'errors' => $errors//['ошибка1','ошибка2']
    );

    echo json_encode($result);
    exit;
}

$action = $_POST['action'];
if (!isset($action)) {
    $errors[] = 'Нет параметров';
    showResult('error', $errors);
}

if ($action == 'edit') {
    $id = $_POST['id'];
    $sectionName = $_POST['SectionName'];
    if (!(isset($id) && isset($sectionName))) {
        showResult('error', ['Нет параметров']);
    }

    try {
        $section = new Section($id, $sectionName);

        $sectionDao->update($section);
    } catch (Exception $e) {
        showResult('error', [$e->getMessage()]);
    }

    showResult('ok', []);
} else if ($action == 'add') {
    $sectionName = $_POST['SectionName'];

    if (!isset($sectionName)) {
        showResult('error', ['Нет параметров']);
    }

    $section = new Section(0, $sectionName);

    try {
        $sectionDao->save($section);
    } catch (Exception $e) {
        showResult('error', [$e->getMessage()]);
    }

    showResult('ok', []);
} else if ($action == 'delete') {
    $id = $_POST['id'];
    if (!isset($id)) {
        showResult('error', ['Нет параметров']);
    }

    try {
        $sectionDao->deleteWithId($id);
    } catch (Exception $e) {
        showResult('error', [$e->getMessage()]);
    }

    showResult('ok', []);
} else {
    showResult('error', ['unknown action']);
}
