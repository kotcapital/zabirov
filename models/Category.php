<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class Category extends \yii\db\ActiveRecord
{
	const TYPE_DEFAULT = 10;
	const TYPE_SHOW = 20;
	
	

    public static function tableName()
    {
        return 'category';
    }

    public function rules()
    {
        return [
			['type', 'integer'],
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
			'type' => 'Тип отображения',
        ];
    }

	
	public function getTypeArray()
	{
		return [
            self::TYPE_DEFAULT => 'Не выводить на главной',
            self::TYPE_SHOW => 'Вывести на главную',
        ];
	}
	

    public static function getTypeMap()
    {
        return ArrayHelper::map(self::find()->all(), 'category_id', 'name');
    }
}
