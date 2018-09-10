<?php
/**
 * Created by PhpStorm.
 * User: JoãoPinho(1130364)
 * Date: 22/08/2018
 * Time: 19:20
 */

namespace frontend\models\TriggerGroup;

use frontend\models\Trigger\Trigger;
use Yii;
use yii\base\Model;

class TriggerGroup extends Model
{
    public $triggerGroupName;
    public $privateTrigger;
    public $triggers;

    static private $TRIGGER_TYPES = ['Text', 'DictionaryVariable', 'SingleVariable', 'Image'];

    public function rules()
    {
        return [
            [['triggerGroupName'], 'string'],
            [['privateTrigger'], 'privateTriggerValidate'],
            [['triggerGroupName'], 'required'],
            [['privateTrigger'], 'required'],
        ];
    }

    public static function toJson(array $triggerGroupArray)
    {
        //openJson
        $finalJson = '{';
        foreach ($triggerGroupArray as $triggerGroup) {
            //open each Trigger group
            $finalJson .= "\"" . $triggerGroup->triggerGroupName . "\": {";
            //privateTrigger
            $finalJson .= "\"privateTrigger\":" . ((is_null($triggerGroup->privateTrigger)) ? 'null' : (($triggerGroup->privateTrigger) ? "true" : "false")) . ",";
            //open Trigger array
            $finalJson .= "\"triggers\": [";
            foreach ($triggerGroup->triggers as $trigger) {
                //open trigger
                $finalJson .= '{';
                $finalJson .= "\"triggerType\": \"" . $trigger->triggerType . "\",";
                $finalJson .= "\"modifier\":" . $trigger->modifier . ",";

                //open data
                $finalJson .= "\"data\":";

                //data output
                switch ($trigger->triggerType) {
                    case "Text":
                        $finalJson .= "\"" . $trigger->data . "\"";
                        break;
                    case "DictionaryVariable":
                        $finalJson .= "{ \"variable\":" . "\"" . $trigger->data['variable'] . "\",";
                        $finalJson .= " \"value\":" . "\"" . ((is_null($trigger->data['value'])) ? 'null' : $trigger->data['value']) . "\"}";
                        break;
                    case "SingleVariable":
                        $finalJson .= "{ \"variable\":" . "\"" . $trigger->data['variable'] . "\",";
                        $finalJson .= "\"value\":" . "\"" . ((is_null($trigger->data['value'])) ? 'null' : $trigger->data['value']) . "\"}";
                        break;
                    case "Image":
                        $finalJson .= "{ \"minSize\":" . ((is_null($trigger->data['minSize'])) ? 'null' : $trigger->data['minSize']) . ",";
                        $finalJson .= " \"maxSize\":" . ((is_null($trigger->data['maxSize'])) ? 'null' : $trigger->data['maxSize']) . "}";
                        break;

                }
                //data output
                //cloe data
                $finalJson .= ",";
                $finalJson .= "\"subgroup\":" . ((is_null($trigger->subgroup)) ? 'null' : "\"" . $trigger->subgroup . "\"") . ",";
                $finalJson .= "\"onFailMsg\":" . ((is_null($trigger->onFailMsg)) ? 'null' : "\"" . $trigger->onFailMsg . "\"");

                //close trigger
                $finalJson .= '},';
            }
            $finalJson = trim($finalJson, ',');
            //close trigger array
            $finalJson .= ']';
            //close each Trigger group
            $finalJson .= '},';
        }
        $finalJson = trim($finalJson, ',');
        //closeJson
        $finalJson .= '}';

        return $finalJson;

    }

    public function privateTriggerValidate($attribute, $params)
    {
        echo "<pre>";
        var_dump(is_null($this->$attribute));
        echo "</pre>";
        exit;
    }

    public function loadTriggerGroup($trigger, $name)
    {
        $this->triggerGroupName = $name;
        $this->privateTrigger = $trigger['privateTrigger'];
        foreach ($trigger['triggers'] as $triggerInfo) {
            $triggerModel = new Trigger();
            $triggerModel->loadTrigger($triggerInfo);
            if ($triggerModel->validate()) {
                $this->triggers[] = $triggerModel;
            }
        }
    }

    public function privateTriggerToString()
    {
        if (is_null($this->privateTrigger)) {
            return "For all chat types";
        } else {
            if ($this->privateTrigger) {
                return "For public chat only";
            } else {
                return "For private chat only";
            }
        }
    }
}