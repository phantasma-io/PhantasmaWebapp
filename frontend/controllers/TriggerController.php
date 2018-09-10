<?php

namespace frontend\controllers;

use Yii;
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

    public function actionTest()
    {
        $json = json_decode(file_get_contents('C:\xampp\htdocs\SuperbotWebapp\JsonSamples\Triggers.json'), true);

        $triggerGroupArray = [];
        foreach ($json as $triggerName => $triggerGroupInfo) {
            $triggerGroup = new TriggerGroup();
            $triggerGroup->loadTriggerGroup($triggerGroupInfo, $triggerName); //returns valid triggerGroup
            $triggerGroupArray[] = $triggerGroup;

        }

        TriggerGroup::toJson($triggerGroupArray);

    }


    public function actionEditTg(/*param(1)id*/)//look out for hardcoded url @85
    {
        $request = Yii::$app->request;
        $json = json_decode(file_get_contents('C:\xampp\htdocs\SuperbotWebapp\JsonSamples\Triggers.json'), true);

        if ($request->isGet) {
            if (array_key_exists($request->get('id'), $json)) {
                $triggerGroup = new TriggerGroup();
                $triggerGroup->loadTriggerGroup($json[$request->get('id')], $request->get('id'));

                return $this->render('triggerGroupForm', ['model' => $triggerGroup]);
            }
        } else {
            if ($request->isPost) {
                $post = $request->post('TriggerGroup');
                if (array_key_exists($request->get('id'), $json)) {
                    $triggerGroup = new TriggerGroup();
                    $triggerGroup->loadTriggerGroup($json[$request->get('id')], $request->get('id'));

                    $triggerGroup->triggerGroupName = $post['triggerGroupName'];
                    if ($post['privateTrigger'] == 'true') {
                        $triggerGroup->privateTrigger = true;
                    } else {
                        if ($post['privateTrigger'] == 'false') {
                            $triggerGroup->privateTrigger = false;
                        } else {//null
                            $triggerGroup->privateTrigger = null;
                        }
                    }

                    $triggerGroupArray = [];
                    foreach ($json as $triggerName => $triggerGroupInfo) {
                        $triggerGroupOut = new TriggerGroup();
                        if ($triggerName != $request->get('id')) {
                            $triggerGroupOut->loadTriggerGroup($triggerGroupInfo, $triggerName); //returns valid triggerGroup
                            $triggerGroupArray[] = $triggerGroupOut;
                        } else {
                            $triggerGroupArray[] = $triggerGroup;
                        }
                    }
                    file_put_contents('C:\xampp\htdocs\SuperbotWebapp\JsonSamples\Triggers.json', TriggerGroup::toJson($triggerGroupArray));

                    $urlName = str_replace(' ', '+', $triggerGroup->triggerGroupName);
                    return Yii::$app->getResponse()->redirect('/trigger/edit-tg?id=' . $urlName);

                }
            }
        }
        return $this->redirect(['trigger/index']);
    }
}
