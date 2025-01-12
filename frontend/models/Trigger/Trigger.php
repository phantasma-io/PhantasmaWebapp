<?php
/**
 * Created by PhpStorm.
 * User: JoãoPinho(1130364)
 * Date: 21/08/2018
 * Time: 19:06
 */

namespace frontend\models\Trigger;

use frontend\models\DataModel\Data;
use Yii;
use yii\base\Model;

class Trigger extends Model
{
    public $triggerType;
    public $modifier;
    public $data;
    public $subgroup;
    public $onFailMsg;

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

    public function triggerTypeValidate($attribute, $params)
    {//triggerType
        return in_array($this->$attribute, Trigger::$TRIGGER_TYPES);
    }

    public function dataValidate($attribute, $params)
    {
        return Data::validateData($this);
    }

    public function loadTrigger($array)
    {
        if (isset($array['triggerType']) && isset($array['modifier']) && isset($array['data'])) {
            $this->triggerType = $array['triggerType'];
            $this->modifier = $array['modifier'];
            $this->data = $array['data'];
            $this->subgroup = $array['subgroup'];
            $this->onFailMsg = $array['onFailMsg'];
        }
        return false;
    }

    public function triggerTypeToString()
    {
        switch ($this->triggerType) {
            case "Text":
                return "Text";
                break;
            case "DictionaryVariable":
                return "Per-user variable";
                break;
            case "SingleVariable":
                return "Global variable";
                break;
            case "Image":
                return "Image";
                break;
            default:
                return "Text";
                break;

        }
    }
}