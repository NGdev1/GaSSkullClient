<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 18.03.17
 * Time: 12:26
 */
require_once "../../../../../bootstrap.php";

use Factory\Factory;

$daoDetails = Factory::getDetailDao();

?>

<div id="table-container">
    <table id="details_table">
        <thead>
        <tr>
            <th>#</th>
            <th>Деталь</th>
        </tr>
        </thead>

        <tbody>

        <?php

        foreach ($daoDetails->getAll() as $item) {
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
</div>

<div style="margin: 30px"></div>

<script type="text/javascript">

    $('#details_table').Tabledit({
        url: 'http://gasskull.ru/api/pricelistedit/DetailsEdit.php',
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
                class: 'button button-restore',
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
            editable: [[1, 'DetailName']]
        }
    })
</script>
