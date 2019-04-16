<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class Middle extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'middle';
    }

    public function rules()
    {
        return [
            [['description', 'keyword'], 'string'],
            [['category_id'], 'default', 'value' => null],
            [['category_id'], 'integer'],
            [['name', 'sys_id', 'title', 'img'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'category_id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'middle_id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'sys_id' => 'Sys ID',
            'title' => 'Заголовок',
            'keyword' => 'Ключевые слова',
            'category_id' => 'Категория',
			'img' => 'Изображение',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'category_id']);
    }
	
	public static function getTypeMap()
    {
        return ArrayHelper::map(self::find()->all(), 'middle_id', 'name');
    }


}
