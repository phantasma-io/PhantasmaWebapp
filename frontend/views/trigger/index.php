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
        <th class="property" scope="col">Trigger Group Name</th>
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
        <tr   class=" trigger-row" style="height: 44px;">
            <td scope="col"><?= $triggerGroup->triggerGroupName ?></td>
            <td scope="col"><?= $triggerGroup->privateTriggerToString() ?></td>
            <td>
                <div style="margin-bottom: -15px; margin-top: -15px;">

                    <a href="<?= \yii\helpers\Url::toRoute(["trigger/edit-tg", 'id'=>$triggerGroup->triggerGroupName]);?>">
                        <button class="btn btn-sm">Edit
                            <div class="ripple-container"></div>
                        </button>
                    </a>
                    <button class="btn btn-sm">Remove
                        <div class="ripple-container"></div>
                    </button>
                    <button data-toggle="collapse" data-target="#<?= "accordion" . $index ?>" class="clickable btn btn-sm">
                        <span  class=" caret"></span>
                    </button>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <div id="<?= "accordion" . $index ?>" class="collapse"><?php
                    foreach ($triggerGroup->triggers as $trigger) {
                        ?>
                        <div class="col-sm-12 trigger" style="  ">
                            <div class="col-sm-4">
                                <div class="col-sm-12" style="margin-right:2%">
                                    <p>
                                        <span class="property">Trigger Type: </span> <?= $trigger->triggerTypeToString() ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="col-sm-12">
                                    <p>
                                        <span class="property">Sub-group: </span> <?= (is_null($trigger->subgroup)) ? "None" : $trigger->subgroup ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <button class="btn btn-sm">Edit
                                    <div class="ripple-container"></div>
                                </button>
                                <button class="btn btn-sm">Remove
                                    <div class="ripple-container"></div>
                                </button>
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