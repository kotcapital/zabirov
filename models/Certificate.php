<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class Certificate extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'certificate';
    }

    public function rules()
    {
        return [
            [['name', 'img'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'certificate_id' => 'ID',
            'name' => 'Название',
            'img' => 'Изображение',
        ];
    }

	public static function map()
    {
        return ArrayHelper::map(self::find()->all(), 'certificate_id', 'name');
    }

}
