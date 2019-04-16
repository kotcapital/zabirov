<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class Filters extends \yii\db\ActiveRecord
{
	
	const TYPE_COMBO = 10;
	const TYPE_BEFORE = 20;
	const TYPE_RANGE = 30;
	const TYPE_CHECKLIST = 40;
	
    public static function tableName()
    {
        return 'filters';
    }
	
	public static function getTypeArray()
    {
        return [
            self::TYPE_COMBO => 'Комбо',
            self::TYPE_BEFORE => 'От',
            self::TYPE_RANGE => 'Диапазон',
            self::TYPE_CHECKLIST => 'Чеклист',
        ];
    }
	
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['category_id', 'middle_id', 'subcategory_id', 'sort', 'name2'], 'default', 'value' => null],
            [['category_id', 'middle_id', 'subcategory_id', 'sort', 'type'], 'integer'],
            [['name', 'param', 'name2'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'category_id']],
            [['middle_id'], 'exist', 'skipOnError' => true, 'targetClass' => Middle::className(), 'targetAttribute' => ['middle_id' => 'middle_id']],
            [['subcategory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategory::className(), 'targetAttribute' => ['subcategory_id' => 'subcategory_id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'filter_id' => 'ID',
            'name' => 'Название',
            'param' => 'Параметры',
            'category_id' => 'Категория',
            'middle_id' => 'Подкатегория',
            'subcategory_id' => 'Подподкатегория',
            'sort' => 'Сортировка',
            'type' => 'Тип',
            'name2' => 'Название',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'category_id']);
    }

    public function getMiddle()
    {
        return $this->hasOne(Middle::className(), ['middle_id' => 'middle_id']);
    }

    public function getSubcategory()
    {
        return $this->hasOne(Subcategory::className(), ['subcategory_id' => 'subcategory_id']);
    }
	
	
}
