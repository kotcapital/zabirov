<?php

use yii\db\Migration;


class m190208_101432_add_catalog_column_type extends Migration
{
   
    public function safeUp()
    {
		$this->addColumn('catalog', 'type', $this->integer());
    }

   
    public function safeDown()
    {
		$this->dropColumn('catalog', 'type');
    }

}
