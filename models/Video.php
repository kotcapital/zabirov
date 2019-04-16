<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class Video extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'video';
    }

    public function rules()
    {
        return [
            [['title', 'link'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'video_id' => 'ID',
            'title' => 'Заголовок',
            'link' => 'Ссылка',
        ];
    }




}
