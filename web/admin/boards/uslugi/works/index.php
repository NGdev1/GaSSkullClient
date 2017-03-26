<?php
/**
 * Created by PhpStorm.
 * User: Михаил
 * Date: 26.03.2017
 * Time: 20:23
 */

require_once "../../../../../bootstrap.php";

use Factory\Factory;

$daoWorks = Factory::getWorkDao();

?>

<div id="table-container">
    <table id="works_table">
        <thead>
        <tr>
            <th>#</th>
            <th>Работа</th>
        </tr>
        </thead>

        <tbody>

        <?php

        foreach ($daoWorks->getAll() as $item) {
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

    $('#works_table').Tabledit({
        url: 'http://gasskull.ru/api/pricelistedit/WorksEdit.php',
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
            editable: [[1, 'WorkName']]
        }
    })
</script>
