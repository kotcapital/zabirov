<?php

use yii\db\Migration;


class m190409_113451_add_column_sort_catalog extends Migration
{
    
    public function safeUp()
    {
		$this->addColumn('catalog', 'sort', $this->integer());
    }

    public function safeDown()
    {
		$this->dropColumn('catalog', 'sort');
    }

}
