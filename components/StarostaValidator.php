<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 23.09.2017
 * Time: 23:51
 */
namespace app\components;
use yii\validators\Validator;
use app\models\Student;

class StarostaValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        if ($model->starosta == 0) return true;
        $students = Student::find()
            ->with('group')
            ->where([
                'starosta' => 1,
                'group_id' => $model->group_id])
            ->all();

        if (sizeOf($students)>0) {
            $this->addError($model,$attribute, 'В этой группе уже есть староста!');
        }

    }
}
