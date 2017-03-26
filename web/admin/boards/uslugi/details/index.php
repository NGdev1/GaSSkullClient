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
$sectionDao = Factory::getSectionDao();

$currentSection = $_GET['section'];
?>

<script type="text/javascript">
    $(document).ready(function () {
        var sections = JSON.parse('{<?php echo implode(',', $sectionDao->getAll());?>}');
        var sectionSelect = $('#sectionSelect');
        var key;

        for (key in sections) {
            if (sections.hasOwnProperty(key)) {
                var newOption = $('<option/>', {
                    text: sections[key],
                    'value': key
                });

                sectionSelect.append(newOption);
            }
        }

        sectionSelect.change(function () {
            var selectedSection = sectionSelect.find('option:selected');
            var filter = '';
            if (selectedSection.val() != -1) {
                filter = selectedSection.text();
            }

            filterTable($('#sections_table').find('tbody'), filter, 'tabledit-span', 'text-muted');
        })
    })
</script>

<div class="center bold text">Раздел:</div>
<select id="sectionSelect" style="width: 50%;" class="input_green center">
    <option value="-1">Все</option>
</select>

<div id="table-container">
    <table id="sections_table">
        <thead>
        <tr>
            <th>#</th>
            <th>Деталь</th>
            <th>Раздел</th>
        </tr>
        </thead>

        <tbody>

        <?php
        if (isset($currentSection)) {
            $sections = $daoDetails->getDetailsFromSection($currentSection);
        } else {
            $sections = $daoDetails->getAll();
        }

        foreach ($sections as $item) {
            $sectionName = $sectionDao->getById($item->getIdSection())->getName();
            echo <<<HTML
<tr>
<td>{$item->getId()}</td>
<td>{$item->getName()}</td>
<td>{$sectionName}</td>
</tr>
HTML;

        }
        ?>
        </tbody>
    </table>
</div>

<div style="margin: 30px"></div>

<script type="text/javascript">
    var sections = '{<?php echo implode(',', $sectionDao->getAll());?>}';

    $('#sections_table').Tabledit({
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
            editable: [[1, 'DetailName'], [2, 'IdSection', sections]]
        }
    })
</script>
