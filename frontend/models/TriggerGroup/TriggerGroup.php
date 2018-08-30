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
            [['privateTrigger'], 'privateTriggerValidate']
        ];
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