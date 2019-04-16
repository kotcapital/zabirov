<?php

use yii\db\Migration;

/**
 * Class m190204_044544_add_table_tarifs
 */
class m190204_044544_add_table_tarifs extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable('tarifs', [
			'tarif_id' => $this->primaryKey(),
			'name' => $this->string(),
			'amount' => $this->string(),
			'price' => $this->string(),
		]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->dropTable('tarifs');
    }

 
}
