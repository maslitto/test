<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "students".
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $second_name
 * @property string $name
 * @property string $third_name
 * @property string $nzk
 * @property integer $starosta
 *
 * @property Group $group
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['group_id','checkLimit'],
            [['group_id'], 'required'],
            [['group_id', 'starosta'], 'integer'],
            [['second_name', 'name', 'third_name', 'nzk'], 'string', 'max' => 255],
            [['nzk'], 'unique'],
            ['starosta', \app\components\StarostaValidator::className()],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Группа',
            'second_name' => 'Фамилия',
            'name' => 'Имя',
            'third_name' => 'Отчество',
            'nzk' => 'Номер зачетки',
            'starosta' => 'Староста',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }


    /**
     * @param $attribute
     * @param $params
     */
    public function checkLimit($attribute, $params)
    {
        $students = Student::find()->where(['group_id' => $this->group_id])->all();
        if(sizeOf($students)>=15){
            $this->addError($attribute, 'Нельзя больше добавлять в эту группу студентов. Достигнут лимит в 15 студентов на группу');
        }
    }
}
