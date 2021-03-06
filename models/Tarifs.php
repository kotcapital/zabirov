<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class Tarifs extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'tarifs';
    }

    public function rules()
    {
        return [
            [['name', 'amount', 'price'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'tarif_id' => 'ID',
            'name' => 'Название',
            'amount' => 'Количество',
            'price' => 'Цена',
        ];
    }

/**
    const TYPE_A;
    const TYPE_B;

    public static function getTypeArray()
    {
        return [
            self::TYPE_A,
            self::TYPE_B,
        ];
    }

    public static function getTypeMap()
    {
        $map = [
            ['id' => self::TYPE_A, 'name' => 'A'],
            ['id' => self::TYPE_B, 'name' => 'B'],
        ];
        return $map;
    }

    public static function getTipeById($id)
    {
        return ArrayHelper::getValue($id,self::getTypeMap());
    }

    public static function getXXXMap($id)
    {
        return ArrayHelper::map(self::query(), 'id', 'name');
    }

    //rule custom
    ['type', 'in', 'range' => self::getTypeArray()],
    [['a', 'b'], 'required', 'when' => function ($data) {
        if ($data->a == null && $data->b == null && $data->tnved == null) {
            return true;
        }
        return false;
    }, 'whenClient' => "function (attribute, value) {
        return $('#a').val() == '' && $('#b').val() == '';
    }", 'message' => 'Необходимо заполнить хотя бы одно из полей a, b],

*/





}
