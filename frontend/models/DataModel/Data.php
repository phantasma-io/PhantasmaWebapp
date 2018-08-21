<?php
/**
 * Created by PhpStorm.
 * User: JoãoPinho(1130364)
 * Date: 21/08/2018
 * Time: 22:17
 */

namespace frontend\models;

use Yii;
use yii\base\Model;

class Data extends Model
{

    /*
     *
      Trigger
      "triggerType": "SingleVariable",
        "data": {
            "variable": "bot state",
            "value": "idle"
        },

        Config
        'SingleVariable' => [
            'variable' => ['string'],
            'value' => ['string', 'null']
        ],
    */

    public static function validateData($trigger)
    {
        $dataConfig = Yii::$app->params['dataConfig'];

        if (in_array($trigger['TriggerType'], $dataConfig)) {
            foreach ($trigger['data'] as $key => $value) {
                if (in_array($key, $dataConfig[$trigger['TriggerType']])) {
                    Data::validateKey($value, $dataConfig[$trigger['TriggerType']][$key]);
                }
            }
        }

    }

    private static function validateKey($value, $data)
    {
        //check if value is empty
        if ((empty($value) || is_null($value)) && in_array('null', $data)) {
            return true;
        }

        if (in_array('string', $data) && is_string($value)) {
            return true;
        }

        if (in_array('double', $data) && is_double($value)) {
            return true;
        }
        return false;
    }
}