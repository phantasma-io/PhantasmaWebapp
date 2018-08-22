<?php
/**
 * Created by PhpStorm.
 * User: JoãoPinho(1130364)
 * Date: 21/08/2018
 * Time: 22:17
 */

namespace frontend\models\DataModel;

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

        if (array_key_exists($trigger['triggerType'], $dataConfig)) {
            if (is_array($trigger['data'])) {
                foreach ($trigger['data'] as $key => $value) {
                    if (array_key_exists($key, $dataConfig[$trigger['triggerType']])) {

                        var_dump(Data::validateKey($value, $dataConfig[$trigger['triggerType']][$key]));
                        exit;

                    }
                }
            }else{
                var_dump(Data::validateKey($trigger['data'], $dataConfig[$trigger['triggerType']]));
                exit;
            }
        }

        die("morri aqui");

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