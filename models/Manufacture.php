<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class Manufacture extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'manufacture';
    }

    public function rules()
    {
        return [
            [['description', 'keyword'], 'string'],
            [['name', 'sys_id', 'title'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'manufacture_id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'sys_id' => 'Sys ID',
            'title' => 'Заголовок',
            'keyword' => 'Ключевые слова',
        ];
    }

    public function getCatalogs()
    {
        return $this->hasMany(Catalog::className(), ['manufacture_id' => 'manufacture_id']);
    }
	
	public static function getTypeMap()
    {
        return ArrayHelper::map(self::find()->orderBy('manufacture_id')->all(), 'manufacture_id', 'name');
    }
	
}
