<?php

namespace frontend\controllers;

use frontend\models\Trigger\Trigger;
use frontend\models\TriggerGroup\TriggerGroup;

class TriggerController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $json = json_decode(file_get_contents('C:\xampp\htdocs\SuperbotWebapp\JsonSamples\Triggers.json'), true);
        $triggerGroupArray = [];
        foreach ($json as $triggerName => $triggerGroupInfo) {
            $triggerGroup = new TriggerGroup();
            $triggerGroup->loadTriggerGroup($triggerGroupInfo, $triggerName); //returns valid triggerGroup
            $triggerGroupArray[] = $triggerGroup;

        }
        return $this->render('index', [
            "triggerGroups" => $triggerGroupArray
        ]);
    }

}
