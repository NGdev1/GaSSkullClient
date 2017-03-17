<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 14.03.17
 * Time: 10:48
 */


require_once "../../../../../bootstrap.php";

use Factory\Factory;

$daoSections = Factory::getSectionDao();
?>

<table id="sections_table">
    <thead>
    <tr>
        <th>#</th>
        <th>Раздел</th>
    </tr>
    </thead>

    <tbody>

    <?php

    foreach ($daoSections->getAll() as $item) {

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
    $('#sections_table').Tabledit({
        url: 'http:/gasskull.ru/api/pricelistedit/SectionsEdit.php',
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
            editable: [[1, 'SectionName']]
        }
    })
</script>
