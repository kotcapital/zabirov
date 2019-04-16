<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class Category extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'category';
    }

    public function rules()
    {
        return [
            [['description', 'keyword'], 'string'],
            [['name', 'sys_id', 'title', 'img'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'category_id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'sys_id' => 'Sys ID',
            'title' => 'Заголовок',
            'keyword' => 'Ключевые слова',
			'img' => 'Изображение',
        ];
    }



    public static function getTypeMap()
    {
        return ArrayHelper::map(self::find()->all(), 'category_id', 'name');
    }
}
