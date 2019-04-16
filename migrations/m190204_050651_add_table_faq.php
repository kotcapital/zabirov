<?php

use yii\db\Migration;

/**
 * Class m190204_050651_add_table_faq
 */
class m190204_050651_add_table_faq extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable('faq', [
			'faq_id' => $this->primaryKey(),
			'question' => $this->string(),
			'answer' => $this->text(),
		]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->dropTable('faq');
    }


}
