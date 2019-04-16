<?php

use yii\db\Migration;


class m190325_054516_add_catalog_table_columns extends Migration
{
   
    public function safeUp()
    {
		$this->addColumn('catalog', 'vch3', $this->string());
		$this->addColumn('catalog', 'vch4', $this->string());
    }

   
    public function safeDown()
    {
		$this->dropColumn('catalog', 'vch4');
		$this->dropColumn('catalog', 'vch3');
    }


}
