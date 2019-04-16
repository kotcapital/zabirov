<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class Subcategory extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'subcategory';
    }

    public function rules()
    {
        return [
            [['description', 'keyword',], 'string'],
            [['category_id', 'middle_id'], 'default', 'value' => null],
            [['category_id', 'middle_id'], 'integer'],
            [['name', 'sys_id', 'title', 'img'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'category_id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Middle::className(), 'targetAttribute' => ['category_id' => 'middle_id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'subcategory_id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'sys_id' => 'Sys ID',
            'title' => 'Заголовок',
            'keyword' => 'Ключевые слова',
            'category_id' => 'Категория',
            'middle_id' => 'Подкатегория',
			'img' => 'Изображение',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'category_id']);
    }

    public function getCategory0()
    {
        return $this->hasOne(Middle::className(), ['middle_id' => 'category_id']);
    }

    public static function getTypeMap()
    {
        return ArrayHelper::map(self::find()->all(), 'subcategory_id', 'name');
    }
 
}
