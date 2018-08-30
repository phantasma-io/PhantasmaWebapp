<?php
/* @var $this yii\web\View */
$this->registerCssFile("css/triggers.css");
/*
 * "triggerType": "SingleVariable",
                "modifier": 0,
                "data": {
                    "variable": "bot state",
                    "value": "idle"
                },
                "subgroup": null,
                "onFailMsg": null*/
?>
<h1>Triggers</h1>

<table class="table" style="">
    <thead class="thead-dark">
    <tr>
        <th class="property" scope="col">Trigger Name</th>
        <th class="property" scope="col">Trigger chat type</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    </tr>
    <?php
    $index = 0;
    foreach ($triggerGroups as $triggerGroup) {
        ?>
        <tr data-toggle="collapse" data-target="#<?= "accordion" . $index ?>" class="clickable">
            <td scope="col"><?= $triggerGroup->triggerGroupName ?></td>
            <td scope="col"><?= $triggerGroup->privateTriggerToString() ?></td>
        </tr>
        <tr>
            <td colspan="3">
                <div id="<?= "accordion" . $index ?>" class="collapse"><?php
                    foreach ($triggerGroup->triggers as $trigger) {
                        ?>
                        <div class="col-sm-12 trigger" style="display: inline-block">
                            <div class="col-sm-4">
                                <div class="col-sm-12">
                                    <p><span class="property">Trigger Type: </span> <?= $trigger->triggerTypeToString()?></p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="col-sm-12">
                                    <p> <span class="property">Sub-group: </span> <?= (is_null($trigger->subgroup))?"None":$trigger->subgroup ?></p>
                                </div>
                            </div>
                        </div>


                        <?php
                    }
                    ?></div>
            </td>
        </tr>
        <?php
        $index++;
    }
    ?>

    </tbody>
</table>