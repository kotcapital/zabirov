<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class Contact extends \yii\db\ActiveRecord
{
	const NAME = 'name';
	const ADRESS = 'address';
	const PHONE = 'phone';
	const EMAIL = 'email';

    public static function tableName()
    {
        return 'contact';
    }

    public function rules()
    {
        return [
            [['name', 'address', 'phone', 'email', 'longitude', 'latitude'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'contact_id' => 'Contact ID',
            'name' => 'Название',
            'address' => 'Адрес',
            'phone' => 'Телефон',
            'email' => 'E-mail',
			'longitude' => 'Долгота',
			'latitude' => 'Широта',
        ];
    }
	
	public static function getCurrent()
	{
		$contact = Contact::find()->one();
		return ($contact == null ? new Contact() : $contact);
	}
	
	public static function value($name)
	{
		return self::getCurrent()->$name;
	}
	
}
