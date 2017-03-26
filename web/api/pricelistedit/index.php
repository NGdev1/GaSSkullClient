<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 16.03.17
 * Time: 9:34
 */

//PriceListEdit
require_once "../../../bootstrap.php";

//\Utils\Utils::enableLogging();

use Factory\Factory;
use Models\PriceList\PriceListItem;

$priceListDao = Factory::getPriceListDao();

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
    $idSection = $_POST['SectionId'];
    $idCarType = $_POST['CarTypeId'];
    $idDetail = $_POST['DetailId'];
    $idWork = $_POST['WorkId'];
    $price = $_POST['Price'];

    if (!isset($id) || !isset($idSection) || !isset($idCarType) || !isset($idDetail) || !isset($idWork) || !isset($price)) {
        $errors[] = 'Нет параметров';
        showResult('error', $errors);
    }

    try {
        $priceListItem = $priceListDao->findById($id);

        $priceListItem->setIdSection($idSection);
        $priceListItem->setIdCarType($idCarType);
        $priceListItem->setIdDetail($idDetail);
        $priceListItem->setIdWork($idWork);
        $priceListItem->setPrice($price);

        $priceListDao->update($priceListItem);
    } catch (Exception $e) {
        showResult('error', [$e->getMessage()]);
    }

    showResult('ok', []);
} else if ($action == 'add') {
    $idSection = $_POST['SectionId'];
    $idCarType = $_POST['CarTypeId'];
    $idDetail = $_POST['DetailId'];
    $idWork = $_POST['WorkId'];
    $price = $_POST['Price'];

    if (!isset($id) || !isset($idSection) || !isset($idCarType) || !isset($idDetail) || !isset($idWork) || !isset($price)) {
        $errors[] = 'Нет параметров';
        showResult('error', $errors);
    }

    $priceListItem = new PriceListItem(0, $price, $idCarType, $idSection, $idWork, $idDetail);

    try {
        $priceListDao->save($priceListItem);
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
        $priceListDao->deleteWithId($id);
    } catch (Exception $e) {
        showResult('error', [$e->getMessage()]);
    }

    showResult('ok', []);
}