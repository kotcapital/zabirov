<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class Cases extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'cases';
    }

    public function rules()
    {
        return [
            [['before', 'after'], 'default', 'value' => null],
            [['before', 'after'], 'string'],
            [['description'], 'string'],
            [['title', 'img', 'difference'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'cases_id' => 'ID',
            'title' => 'Заголовок',
            'img' => 'Изображение',
            'before' => 'До',
            'after' => 'После',
            'description' => 'Описание',
            'difference' => 'Разница',
        ];
    }
	
}
