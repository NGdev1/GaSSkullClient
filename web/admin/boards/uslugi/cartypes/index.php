<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 14.03.17
 * Time: 10:48
 */


require_once "../../../../../bootstrap.php";

use Factory\Factory;

$daoCarTypes = Factory::getCarTypeDao();
?>

<table id="car_types_table">
    <thead>
    <tr>
        <th>#</th>
        <th>Тип авто</th>
    </tr>
    </thead>

    <tbody>

    <?php

    foreach ($daoCarTypes->getAll() as $item) {

        echo <<<HTML
<tr>
<td>{$item->getId()}</td>
<td>{$item->getName()}</td>
</tr>
HTML;

    }
    ?>
    </tbody>
</table>

<div style="margin: 30px"></div>

<script type="text/javascript">
    $('#car_types_table').Tabledit({
        url: 'http://gasskull.ru/api/pricelistedit/CarTypesEdit.php',
        inputClass: 'input_green',
        buttons: {
            edit: {
                class: 'button button-edit-table',
                html: '<span class="glyphicon glyphicon-pencil"></span>',
                action: 'edit'
            },
            delete: {
                class: 'button button-edit-table',
                html: '<span class="glyphicon glyphicon-trash"></span>',
                action: 'delete'
            },
            save: {
                class: 'button button-save',
                html: 'Сохранить'
            },
            restore: {
                class: 'button btn-sm btn-warning',
                html: 'Восстановить',
                action: 'restore'
            },
            confirm: {
                class: 'button button-delete',
                html: 'Подтвердить'
            }
        },
        columns: {
            identifier: [0, 'id'],
            editable: [[1, 'CarTypeName']]
        }
    })
</script>