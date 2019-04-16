<?php

use yii\db\Migration;

/**
 * Class m190203_234620_add_table_cases
 */
class m190203_234620_add_table_cases extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable('cases',[
			'cases_id' => $this->primaryKey(),
			'title' => $this->string(),
			'img' => $this->string(),
			'before' => $this->string(),
			'after' => $this->string(),
			'description' => $this->text(),
			'difference' => $this->string(),
		]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->dropTable('cases');
    }

}
