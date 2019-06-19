<?php

use yii\db\Migration;


class m190426_150047_table_certificate extends Migration
{
 
    public function safeUp()
    {
		$this->createTable('certificate', [
			'certificate_id' => $this->primaryKey(),
			'name' => $this->string(),
			'img' => $this->string(),
		]);
    }

  
    public function safeDown()
    {
        $this->dropTable('certificate');
    }


}
