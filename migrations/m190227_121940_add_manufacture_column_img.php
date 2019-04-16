<?php

use yii\db\Migration;


class m190227_121940_add_manufacture_column_img extends Migration
{
    
    public function safeUp()
    {
		$this->addColumn('manufacture', 'img', $this->string());
    }

    
    public function safeDown()
    {
		$this->dropColumn('manufacture', 'img');
    }

}
