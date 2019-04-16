<?php

use yii\db\Migration;


class m190304_040758_add_filters_columns extends Migration
{
   
    public function safeUp()
    {
		$this->addColumn('filters', 'name2', $this->string());
		$this->addColumn('filters', 'type', $this->integer());
    }

    
    public function safeDown()
    {
		$this->dropColumn('filters', 'type');
		$this->dropColumn('filters', 'name2');
    }

}
