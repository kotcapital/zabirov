<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class Site extends \yii\db\ActiveRecord
{

	public static function checkDomain($domain, $url)
    {
		if ($domain == 'teploeffekt.com') {
			return null;
		}else{
			return 'http://teploeffekt.com' . $url;
		}
    }
	
}
