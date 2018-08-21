<?php
/**
 * Created by PhpStorm.
 * User: JoãoPinho(1130364)
 * Date: 21/08/2018
 * Time: 19:06
 */

namespace frontend\models;

use Yii;
use yii\base\Model;

class Trigger extends Model
{
    public $triggerType;
    public $modifier;
    public $data;
    public $subgroup;
    public $onFailMsg;

    static private $TRIGGER_TYPES = ['Text','DictionaryVariable','SingleVariable', 'Image'];


    public function rules()
    {
        return [
            [['triggerType'], 'triggerTypeValidate'],
            [['data'], 'dataValidate'],
            ['modifier', 'integer'],
            [['subgroup', 'onFailMsg'], 'string'],
        ];
    }

    public function triggerTypeValidate($attribute, $params){//triggerType
        return in_array($this->$attribute, Trigger::$TRIGGER_TYPES);
    }

    public function dataValidate($attribute, $params){
        echo "<pre>";
        print_r($this);
        print_r($params);
        echo "</pre>";
        exit;
    }

    public function loadTrigger($array){

        if(isset($array['triggerType']) && isset($array['modifier']) && isset($array['data'])){
            $this->triggerType = $array['triggerType'];
            $this->modifier = $array['modifier'];
            $this->data = $array['data'];
            $this->subgroup = $array['subgroup'];
            $this->onFailMsg = $array['onFailMsg'];
        }
        return false;
    }
}