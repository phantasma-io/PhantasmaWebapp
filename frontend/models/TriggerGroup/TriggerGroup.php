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
            [['triggerType'], 'triggerTypeValidate'],
            [['data'], 'dataValidate'],
            ['modifier', 'integer'],
            [['subgroup', 'onFailMsg'], 'string'],
        ];
    }

    public function loadTriggerGroup($trigger, $name)
    {
        $this->triggerGroupName = $name;
        $this->privateTrigger = $trigger['privateTrigger'];
        foreach ($trigger['triggers'] as $triggerInfo) {
            $triggerModel = new Trigger();
            $triggerModel->loadTrigger($triggerInfo);
            if($triggerModel->validate()){
                $this->triggers[]=$triggerModel;
            }
        }
    }
}