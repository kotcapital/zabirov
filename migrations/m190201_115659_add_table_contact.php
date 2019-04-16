<?php

use yii\db\Migration;

/**
 * Class m190201_115659_add_table_contact
 */
class m190201_115659_add_table_contact extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable('contact', [
			'contact_id' => $this->primaryKey(),
			'name' => $this->string(),
			'address' => $this->string(),
			'phone' => $this->string(),
			'email' => $this->string(),
			'longitude' => $this->string(),
			'latitude' => $this->string(),
		]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->dropTable('contact');
    }


}
