<?php
/**
 * Created by PhpStorm.
 * User: JoãoPinho(1130364)
 * Date: 01/09/2018
 * Time: 16:56
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

?>
<h1>Trigger Group</h1>

<?php
if (isset($model)) {
    $privateTrigger = (is_null($model->privateTrigger) ? 'null' : (($model->privateTrigger) ? 'true' : 'false'));
}
$form = ActiveForm::begin([
    'id' => 'trigger-group-form',
    'enableClientValidation' => true,
    'options' => [
        'class' => 'form form-horizontal box-raised',
        'validateOnSubmit' => true,
    ],
]) ?>
<div class="form-group">
    <div class="col-sm-4" style="padding-right:10px">
        <?= $form->field($model, 'triggerGroupName') ?>
    </div>

    <div class="col-sm-offset-2 col-sm-4">
        <?= $form->field($model, 'privateTrigger')->dropDownList(['null' => 'For all chat types (null)', 'false' => 'For public chat only (false)', 'true' => 'For private chat only (true)'], ['prompt' => 'Select one', 'value' => $privateTrigger]) ?>
    </div>

    <div class="col-sm-12">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'style' => ';']); ?>
    </div>

</div>
<?php ActiveForm::end() ?>
<br>
<?php
if (isset($model)) {
    ?>

    <h2>Triggers</h2>
    <div class="box-raised" style="display: table-cell; padding: 15px 15px 15px 15px">

        <?php
        foreach ($model->triggers as $trigger) {
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
        ?>
    </div>


    <?php
}
?>
