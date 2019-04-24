<?php

use yii\db\Migration;


class m190422_120247_add_category_column_type extends Migration
{
    
    public function safeUp()
    {
		$this->addColumn('category', 'type', $this->integer());
    }

    public function safeDown()
    {
		$this->dropColumn('category', 'type');
    }

   
}
