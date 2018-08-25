<?php
/**
 * Created by PhpStorm.
 * User: JoãoPinho(1130364)
 * Date: 21/08/2018
 * Time: 22:17
 */

namespace frontend\models\DataModel;

use frontend\models\Trigger\Trigger;
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

    public static function validateData(Trigger $trigger)
    {
        $dataConfig = Yii::$app->params['dataConfig'];
        $isValid=true;
        if (array_key_exists($trigger->triggerType, $dataConfig)) {
            if (is_array($trigger->data)) {
                foreach ($trigger->data as $key => $value) {
                    if (array_key_exists($key, $dataConfig[$trigger->triggerType])) {

                        if(!Data::validateKey($value, $dataConfig[$trigger->triggerType][$key])){
                            $isValid=false;
                        }
                    }
                }
            }else{
                if(Data::validateKey($trigger->data, $dataConfig[$trigger->triggerType])){
                    $isValid=false;
                }
            }
        }

       return $isValid;
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