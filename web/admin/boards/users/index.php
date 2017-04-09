<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 28.03.17
 * Time: 10:43
 */

require_once "../../../../bootstrap.php";

use Factory\Factory;

$userDao = Factory::getUserDao();
$carTypeDao = Factory::getCarTypeDao();

//\Utils\Utils::enableLogging();
?>

<div id="table-container">
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Имя</th>
            <th>Номер авто</th>
            <th>Тип авто</th>
        </tr>
        </thead>

        <tbody>

        <?php

        foreach ($userDao->getAllUsers() as $item) {

            $carTypeName = $carTypeDao->getCarTypeById($item->getIdCarType())->getName();
            echo <<<HTML
<tr>
<td>{$item->getId()}</td>
<td>{$item->getName()}</td>
<td>{$item->getCarNumber()}</td>
<td>{$carTypeName}</td>
</tr>
HTML;

        }
        ?>
        </tbody>
    </table>
</div>

<div style="margin: 30px"></div>